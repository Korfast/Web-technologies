<h3>Task 2: Function that outputs text with different font size</h3>

<?php
// Function name in camelCase
function printWithFontSize($text, $size) {
    echo "<font size=\"$size\">$text</font><br>";
}

echo "<h4>Examples:</h4>";
printWithFontSize("This is size 1 (small)", 1);
printWithFontSize("This is size 3 (normal)", 3);
printWithFontSize("This is size 5 (large)", 5);
printWithFontSize("This is size 7 (extra large)", 7);
?>