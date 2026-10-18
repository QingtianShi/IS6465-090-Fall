<?php
// Qingtian Shi | u1377576
// Lab 2C: Constructors, Constants, and Inheritance

echo '<h1>Lab 2C: User and Tutor Classes</h1>';
function cleanText($value)
{
    // Trim outer whitespace and collapse repeated whitespace inside the text.
    return trim(preg_replace('/\s+/', ' ', $value));
}
class User
{
    public const STATUS_ACTIVE = 'active';
    public $name;
    public $email;
    public $status;

    public function __construct($name, $email)
    {
        $this->name = cleanText($name);
        $this->email = strtolower(cleanText($email));
        $this->status = self::STATUS_ACTIVE;
    }
}
class Tutor extends User
{
    public $subject;

    public function __construct($name, $email, $subject)
    {
        parent::__construct($name, $email);
        $this->subject = cleanText($subject);
    }

    public function profileSummary()
    {
        return "Name: {$this->name} | Email: {$this->email} | Subject: {$this->subject}";
    }
}
$tutor = new Tutor('  Maria   Chen  ', '  MARIA@EXAMPLE.COM  ', '  PHP   Programming  ');
echo '<p>' . htmlspecialchars($tutor->profileSummary()) . '</p>';
echo '<p>Status: ' . htmlspecialchars($tutor->status) . '</p>';
