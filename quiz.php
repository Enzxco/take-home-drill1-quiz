<?php
include "conn.php";

// Step 1: Check if username is passed
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];
} else {
    echo "<h1>Invalid access. Please enter your name first.</h1>";
    echo "<a href='enter.php'>Go Back</a>";
    exit;
}

$quiz_title = "PHP Quiz";
$questions = [
    [
        "question" => "1. Sino ang gumawa ng guild chat (GC) ng grupo?",
        "options" => ["Lawrence", "Vince", "Hidenori", "Lenard"],
        "answer" => 1,
    ],
    [
        "question" => "2. Tamang pangalan ng grupo?",
        "options" => ["Intro Shit", "Intro Gay", "Intro Chill", "None of the Above"],
        "answer" => 2,
    ],
    [
        "question" => "3. Ilan ang member ng grupo sa kasulukuyan?",
        "options" => ["5", "3", "4", "6"],
        "answer" => 0,
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP QUIZ</title>
    <script>
        // JavaScript to track the start time
        let startTime = new Date().getTime();

        // Function to calculate the time spent
        function calculateTimeSpent() {
            let endTime = new Date().getTime();
            let timeSpent = Math.floor((endTime - startTime) / 1000); // Time in seconds
            document.getElementById('time_taken').value = timeSpent;
        }
    </script>
</head>
<body>
    <h1><?php echo $quiz_title; ?></h1>
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>

    <form action="result.php" method="post" onsubmit="calculateTimeSpent()">
        <?php foreach ($questions as $index => $question): ?>
            <fieldset>
                <legend><?php echo $question['question']; ?></legend>
                <?php foreach ($question['options'] as $optionIndex => $option): ?>
                    <label>
                        <input type="radio" name="question<?php echo $index; ?>" value="<?php echo $optionIndex; ?>" required>
                        <?php echo $option; ?>
                    </label><br>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>
        <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
        <input type="hidden" id="time_taken" name="time_taken">
        <button type="submit">Submit</button>
    </form>
</body>
</html>
