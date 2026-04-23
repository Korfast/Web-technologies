<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 1: Basics of PHP Syntax</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        .info { background: #f0f0f0; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; }
        button { font-size: 1.2rem; margin: 0.5rem; padding: 0.5rem 1.5rem; cursor: pointer; }
        .task-area { margin-top: 2rem; border-top: 2px solid #ccc; padding-top: 1rem; }
        pre { background: #eee; padding: 1rem; border-radius: 5px; }
    </style>
</head>
<body>

<div class="info">
    <h2>Student Information</h2>
    <p><strong>Full name:</strong> Фаст Корней Михайлович</p>
    <p><strong>Group:</strong> 574-2</p>
    <p><strong>Variant:</strong> 1 (13)</p>
</div>

<form method="get" action="">
    <button type="submit" name="task" value="1">Task 1: Variables & comparison</button>
    <button type="submit" name="task" value="2">Task 2: Font size function</button>
    <button type="submit" name="task" value="3">Task 3: HTML color table</button>
</form>

<div class="task-area">
    <?php
        if (isset($_GET['task'])) {
            $task = $_GET['task'];
            switch ($task) {
                case '1':
                    include 'lab1Task1.php';
                    break;
                case '2':
                    include 'lab1Task2.php';
                    break;
                case '3':
                    include 'lab1Task3.php';
                    break;
                default:
                    echo "<p>Unknown task.</p>";
            }
        } else {
            echo "<p>Click a button to see the result.</p>";
        }
    ?>
</div>

</body>
</html>