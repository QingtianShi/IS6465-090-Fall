<?php
// Qingtian Shi | u1377576 | Lab 3: PHP arrays.
$timeSlots = ['Morning', 'Afternoon', 'Evening'];
$request = [
    'course' => 'IS 6465',
    'topic' => 'PHP arrays',
    'status' => 'Pending review'
];
$requests = [
    ['student' => 'Amina', 'course' => 'IS 6465', 'status' => 'Pending review'],
    ['student' => 'Diego', 'course' => 'IS 6495', 'status' => 'Matched']
];
$courses = ['IS 6465', 'IS 6495', 'IS 6570'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 3 | PHP Arrays</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 760px; margin: 40px auto; padding: 0 20px; line-height: 1.6; color: #202124; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #aaa; padding: 10px; text-align: left; }
        select { padding: 8px; font: inherit; }
        a { color: #174b85; }
    </style>
</head>
<body>
    <main>
        <h1>Lab 3: PHP Arrays</h1>
        <h2>1. Indexed array</h2>
        <p>First time slot: <?= htmlspecialchars($timeSlots[0], ENT_QUOTES, 'UTF-8') ?></p>
        <p>Second time slot: <?= htmlspecialchars($timeSlots[1], ENT_QUOTES, 'UTF-8') ?></p>
        <p>Third time slot: <?= htmlspecialchars($timeSlots[2], ENT_QUOTES, 'UTF-8') ?></p>

        <h2>2. Associative array</h2>
        <p>Topic: <?= htmlspecialchars($request['topic'], ENT_QUOTES, 'UTF-8') ?></p>

        <h2>3. Multidimensional array</h2>
        <table>
            <caption>Sample tutoring requests</caption>
            <thead><tr><th scope="col">Student</th><th scope="col">Course</th><th scope="col">Status</th></tr></thead>
            <tbody>
                <?php foreach ($requests as $record): ?>
                    <tr>
                        <td><?= htmlspecialchars($record['student'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($record['course'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($record['status'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>4. Course options using foreach</h2>
        <label for="courses">Approved courses</label>
        <select id="courses" name="course">
            <?php foreach ($courses as $course): ?>
                <option value="<?= htmlspecialchars($course, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($course, ENT_QUOTES, 'UTF-8') ?></option>
            <?php endforeach; ?>
        </select>
        <p><a href="request-form.html">Request a tutoring session</a></p>
    </main>
</body>
</html>
