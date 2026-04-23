<h3>Task 3: HTML color table (with arbitrary step)</h3>

<?php
// Helper function: returns contrasting background color
function getContrastBackground($hexColor) {
    $hex = ltrim($hexColor, '#');
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b);
    return ($luminance > 186) ? '#333333' : '#ffffff';
}

// Predefined colors from the task
$colors = [
    "#000000", "#0000ff", "#00ff00", "#00ffff", "#f8f8f8"
];

// Generate additional colors with arbitrary step (85)
for ($r = 0; $r <= 255; $r += 85) {
    for ($g = 0; $g <= 255; $g += 85) {
        for ($b = 0; $b <= 255; $b += 85) {
            if (($r == 0 && $g == 0 && $b == 0) || ($r == 255 && $g == 255 && $b == 255)) {
                continue;
            }
            $color = sprintf("#%02x%02x%02x", $r, $g, $b);
            $colors[] = $color;
        }
    }
}

// Remove possible duplicates (e.g., #0000ff may appear from loop)
$colors = array_unique($colors);

// Define number of columns per row (for better viewing)
$cols = 6;

echo "<table border='1' cellpadding='10' cellspacing='0'>";

// Output colors in grid
$i = 0;
foreach ($colors as $color) {
    if ($i % $cols == 0) {
        echo "<tr>";
    }
    $bg = getContrastBackground($color);
    echo "<td style='background-color: $bg; text-align: center;'>";
    echo "<span style='color: $color; font-family: monospace; font-weight: bold;'>$color</span>";
    echo "</td>";
    $i++;
    if ($i % $cols == 0) {
        echo "</tr>";
    }
}
// Close last row if not full
if ($i % $cols != 0) {
    echo "</tr>";
}
echo "<tr>";
?>