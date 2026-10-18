<?php
// Qingtian Shi | u1377576
// Lab 2A: PHP Expressions and Control Structures

echo '<h1>Lab 2A: Expressions and Control Structures</h1>';
echo '<h2>1. Expressions and Operators</h2>';
$x = -5;
$y = 3 * (abs(2 * $x) + 4);
echo "The value of y is: $y<br>";

echo '<h2>2. Comparisons</h2><pre>';
var_dump(2 > 1);
var_dump(2 == 3);
var_dump('5' == 5);  // Equal values after type conversion.
var_dump('5' === 5); // Different types, so not strictly equal.
echo '</pre>';

echo '<h2>3. Unary Operators</h2>';
$c = 5;
$negative = -$c;
$positive = +$c;
$incremented = ++$c;
echo "Unary minus: $negative<br>Unary plus: $positive<br>";
echo "Pre-increment: $incremented; c is now $c<br>";

echo '<h2>4. Operator Precedence</h2>';
$withoutParentheses = 2 + 3 * 4;
$withParentheses = (2 + 3) * 4;
echo "2 + 3 * 4 = $withoutParentheses<br>";
echo "(2 + 3) * 4 = $withParentheses<br>";

echo '<h2>5. Assignment Associativity</h2>';
$level = $score = $time = 0;
echo "Level: $level; Score: $score; Time: $time<br>";

echo '<h2>6. Equality and Assignment</h2><pre>';
$number = 5;
$sameNumber = 5;
$textNumber = '5';
$differentNumber = 6;
var_dump($number == $sameNumber);
var_dump($number === $sameNumber);
var_dump($number == $textNumber);
var_dump($number === $textNumber);
var_dump($number == $differentNumber);
var_dump($number === $differentNumber);
echo '</pre>';

echo '<h2>7. Logical Operators</h2><pre>';
$a = 1;
$b = 0;
var_dump($a && $b);
var_dump($a || $b);
var_dump(!$a);
var_dump(!$b);
echo '</pre>';

echo '<h2>8. Scholarship Decision with if...else</h2>';
$gpa = 3.59;
// For this example, the minimum GPA for a scholarship is 3.5.
if ($gpa >= 3.5) {
    echo "GPA $gpa: The student receives a scholarship.<br>";
} else {
    echo "GPA $gpa: The student does not receive a scholarship.<br>";
}

echo '<h2>9. Scholarship Decision with if...elseif...else</h2>';
if ($gpa >= 3.7) {
    echo 'Full scholarship<br>';
} elseif ($gpa >= 3.5) {
    echo 'Partial scholarship<br>';
} else {
    echo 'No scholarship<br>';
}

echo '<h2>10. Access Status</h2>';
$status = 'pending';
switch ($status) {
    case 'approved':
        echo 'Access approved.<br>';
        break;
    case 'pending':
        echo 'Access is pending approval.<br>';
        break;
    default:
        echo 'Access denied.<br>';
        break;
}

echo '<h2>11. While Loop</h2>';
$fuel = 10;
while ($fuel > 1) {
    echo "There is enough fuel (level: $fuel).<br>";
    $fuel--;
}
echo "Stopped at fuel level: $fuel<br>";

echo '<h2>12. Multiplication Table</h2>';
for ($i = 1; $i <= 12; $i++) {
    $product = 12 * $i;
    echo "12 x $i = $product<br>";
}
