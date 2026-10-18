<?php
// Qingtian Shi | u1377576
// Lab 2B: PHP Functions and Basic Objects
// Run this page separately from user.php; both demonstrate a User class.

echo '<h1>Lab 2B: Functions and Objects</h1>';
echo '<h2>1. Function with Parameters and Return Value</h2>';
function formatName($first, $middle, $last)
{
    $parts = cleanNameParts($first, $middle, $last);
    // An empty middle name should not leave an extra space.
    return trim(preg_replace('/\s+/', ' ', implode(' ', $parts)));
}
echo htmlspecialchars(formatName('  mARIA ', ' aNN ', ' CHEN ')) . '<br>';

echo '<h2>2. Function That Returns an Array</h2>';
function cleanNameParts($first, $middle, $last)
{
    $parts = [$first, $middle, $last];
    foreach ($parts as $index => $part) {
        $part = trim(preg_replace('/\s+/', ' ', $part));
        $parts[$index] = ucwords(strtolower($part));
    }
    return $parts;
}
$nameParts = cleanNameParts('  mARIA ', ' aNN ', ' CHEN ');
echo 'Cleaned first name: ' . htmlspecialchars($nameParts[0]) . '<br>';

echo '<h2>3. Variable Scope</h2>';
$first = 'Maria';
$last = 'Chen';
function buildFullName()
{
    global $first, $last;
    return "$first $last";
}
function buildFullName2($first, $last)
{
    return "$first $last";
}
echo 'Using globals: ' . htmlspecialchars(buildFullName()) . '<br>';
echo 'Using parameters: ' . htmlspecialchars(buildFullName2('John', 'Smith')) . '<br>';
echo "Global variables remain: $first $last<br>";

echo '<h2>4. Static Variable</h2>';
function nextTicketNumber()
{
    static $ticketNumber = 0;
    return ++$ticketNumber;
}
echo 'Ticket: ' . nextTicketNumber() . '<br>';
echo 'Ticket: ' . nextTicketNumber() . '<br>';
echo 'Ticket: ' . nextTicketNumber() . '<br>';

echo '<h2>5. User Class</h2>';
class User
{
    public $name;
    public $email;

    public function display()
    {
        return $this->name;
    }
}
$user = new User();
$user->name = 'Maria Chen';
$user->email = 'maria@example.com';
echo htmlspecialchars($user->display()) . '<br>';

echo '<h2>6. Constructor and Password Hashing</h2>';
class User2
{
    public $name;
    private $passwordHash;

    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
    }
}
// Demonstration data only. Object inspection is required by this lab.
$user2 = new User2('John Smith', 'DemoPassword123!');
echo '<pre>' . htmlspecialchars(print_r($user2, true)) . '</pre>';
