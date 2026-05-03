<?php
// Запрещаем прямой доступ без POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Доступ только по POST');
}

// Массив для сбора ошибок
$errors = [];

// Проверка обязательных полей
$required = ['email', 'password', 'fullname', 'age', 'address'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        $errors[] = "Поле «$field» не заполнено";
    }
}

// Если есть ошибки обязательных полей – выводим и завершаем
if (!empty($errors)) {
    echo "<h3>Ошибка регистрации</h3><ul>";
    foreach ($errors as $err) echo "<li>" . htmlspecialchars($err) . "</li>";
    echo "</ul><p><a href='register.html'>Вернуться к форме</a></p>";
    exit;
}

// Получаем данные с экранированием для вывода (сохраняем оригиналы для записи)
$email_raw = trim($_POST['email']);
$password_raw = trim($_POST['password']);
$fullname_raw = trim($_POST['fullname']);
$age_raw = (int)$_POST['age'];
$address_raw = trim($_POST['address']);

// Валидация email
if (!filter_var($email_raw, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Неверный формат email";
}

// Валидация возраста
if ($age_raw < 18 || $age_raw > 120) {
    $errors[] = "Возраст должен быть от 18 до 120 лет";
}

// Проверка, что ФИО и адрес не пустые после trim
if (empty($fullname_raw)) $errors[] = "ФИО не может быть пустым";
if (empty($address_raw)) $errors[] = "Адрес не может быть пустым";

// Загрузка аватарки
if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
    $errors[] = "Ошибка загрузки файла";
} else {
    $avatar = $_FILES['avatar'];
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed_ext)) {
        $errors[] = "Допустимы только изображения (jpg, jpeg, png, gif)";
    }
    if ($avatar['size'] > 2 * 1024 * 1024) {
        $errors[] = "Размер файла не более 2 МБ";
    }
    // Дополнительная проверка на реальное изображение (без нарушения ТЗ – повышает надёжность)
    if (empty($errors) && !getimagesize($avatar['tmp_name'])) {
        $errors[] = "Файл не является корректным изображением";
    }
}

// Если есть ошибки – выводим и выходим
if (!empty($errors)) {
    echo "<h3>Ошибка регистрации</h3><ul>";
    foreach ($errors as $err) echo "<li>" . htmlspecialchars($err) . "</li>";
    echo "</ul><p><a href='register.html'>Вернуться к форме</a></p>";
    exit;
}

// Хэшируем пароль
$password_hash = password_hash($password_raw, PASSWORD_DEFAULT);

// Создаём папку для файлов и аватарок (если нет)
$upload_dir = __DIR__ . '/uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Генерируем уникальное имя файла
$new_filename = 'avatar_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
$destination = $upload_dir . $new_filename;

// Перемещаем загруженный файл
if (!move_uploaded_file($avatar['tmp_name'], $destination)) {
    die('Ошибка при сохранении аватарки на сервере');
}

// Сохраняем данные в текстовый файл
$data_line = implode('|', [
    $email_raw,
    $password_hash,
    $fullname_raw,
    $age_raw,
    $address_raw,
    $new_filename,
    date('Y-m-d H:i:s')
]) . PHP_EOL;

$file = __DIR__ . '/uploads/users.txt';
file_put_contents($file, $data_line, FILE_APPEND | LOCK_EX);

// Успешный вывод (с экранированием)
echo "<h3>Регистрация успешна!</h3>";
echo "<p>Спасибо, " . htmlspecialchars($fullname_raw) . ". Ваши данные сохранены.</p>";
echo "<p>Аватарка загружена: <img src='uploads/" . htmlspecialchars($new_filename) . "' width='100' alt='avatar'></p>";
echo "<p><a href='register.html'>Зарегистрировать ещё одного</a></p>";
echo "<p>Папка uploads: " . realpath($upload_dir) . "</p>";
echo "<p>Файл users.txt: " . realpath($file) . "</p>";
?>