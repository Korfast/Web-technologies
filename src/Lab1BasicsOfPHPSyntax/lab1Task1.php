<h3>Task 1: Variables of different types and comparison</h3>

<?php
// Variables in camelCase
$integerVar = 42;
$floatVar = 3.1415;
$stringVar = "Hello, PHP!";
$boolVar = true;
$nullVar = null;
$arrayVar = [1, 2, 3];

echo "<pre>";
echo "\$integerVar = $integerVar  --> type: " . gettype($integerVar) . "\n";
echo "\$floatVar = $floatVar      --> type: " . gettype($floatVar) . "\n";
echo "\$stringVar = $stringVar    --> type: " . gettype($stringVar) . "\n";
echo "\$boolVar = " . ($boolVar ? "true" : "false") . "            --> type: " . gettype($boolVar) . "\n";
echo "\$nullVar = null            --> type: " . gettype($nullVar) . "\n";
echo "\$arrayVar = [1,2,3]        --> type: " . gettype($arrayVar) . "\n";
echo "</pre>";

// Two variables for comparison
$a = 100;
$b = 50;

echo "<h4>Comparison of \$a = $a and \$b = $b</h4>";
echo "<ul>";
echo "<li>\$a == \$b ? " . (($a == $b) ? "true" : "false") . "</li>";
echo "<li>\$a < \$b ? " . (($a < $b) ? "true" : "false") . "</li>";
echo "<li>\$a <= \$b ? " . (($a <= $b) ? "true" : "false") . "</li>";
echo "<li>\$a > \$b ? " . (($a > $b) ? "true" : "false") . "</li>";
echo "</ul>";
?>