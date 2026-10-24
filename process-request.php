<?php
// Qingtian Shi | u1377576 | Lab 3: Process and validate a tutoring request.
// Use the university's local date rather than the server's UTC date.
date_default_timezone_set('America/Denver');
header('Content-Type: text/html; charset=UTF-8');

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('<h1>Method not allowed</h1><p>Please submit the <a href="request-form.html">tutoring request form</a>.</p>');
}

$course = $_POST['course'] ?? '';
$topic = $_POST['topic'] ?? '';
$preferredDate = $_POST['preferreddate'] ?? '';
$preferredTime = $_POST['preferredtime'] ?? '';

// A modified form can send arrays instead of text. Treat these as missing values.
$course = is_string($course) ? trim($course) : '';
$topic = is_string($topic) ? trim($topic) : '';
$preferredDate = is_string($preferredDate) ? trim($preferredDate) : '';
$preferredTime = is_string($preferredTime) ? trim($preferredTime) : '';

$errors = [];
$allowedCourses = ['IS 6465', 'IS 6495', 'IS 6570'];
$allowedTimes = ['Morning', 'Afternoon', 'Evening'];

if (!in_array($course, $allowedCourses, true)) {
    $errors[] = 'Select a valid course.';
}
if (!in_array($preferredTime, $allowedTimes, true)) {
    $errors[] = 'Select a valid preferred time.';
}

// Count Unicode characters, including when mbstring is not installed.
$topicLength = preg_match_all('/./us', $topic);
if ($topic === '' || $topicLength === false || $topicLength > 120) {
    $errors[] = 'Enter a topic of 1 to 120 characters.';
}

$date = false;
if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/D', $preferredDate)) {
    $date = DateTime::createFromFormat('!Y-m-d', $preferredDate);
}
// Round-trip validation rejects impossible dates such as February 30.
$validDate = $date && $date->format('Y-m-d') === $preferredDate;
if (!$validDate) {
    $errors[] = 'Enter a valid preferred date in YYYY-MM-DD format.';
} elseif ($date < new DateTime('today')) {
    $errors[] = 'The preferred date cannot be in the past.';
}

if ($errors) {
    http_response_code(422);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutoring Request Result</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 680px; margin: 40px auto; padding: 0 20px; line-height: 1.6; color: #202124; }
        dt { font-weight: bold; margin-top: 12px; }
        dd { margin-left: 0; overflow-wrap: anywhere; }
        a { color: #174b85; }
    </style>
</head>
<body>
    <main>
        <?php if ($errors): ?>
            <h1>Please correct your request</h1>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <h1>Request received</h1>
            <dl>
                <dt>Course</dt>
                <dd><?= htmlspecialchars($course, ENT_QUOTES, 'UTF-8') ?></dd>
                <dt>Topic</dt>
                <dd><?= htmlspecialchars($topic, ENT_QUOTES, 'UTF-8') ?></dd>
                <dt>Preferred date</dt>
                <dd><?= htmlspecialchars($preferredDate, ENT_QUOTES, 'UTF-8') ?></dd>
                <dt>Preferred time</dt>
                <dd><?= htmlspecialchars($preferredTime, ENT_QUOTES, 'UTF-8') ?></dd>
                <dt>Status</dt>
                <dd>Pending review</dd>
            </dl>
        <?php endif; ?>
        <p><a href="request-form.html">Return to the request form</a></p>
    </main>
</body>
</html>
