<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];
} else {
    echo "<h1>Invalid access. Please enter your name first.</h1>";
    echo "<a href='enter.php'>Go Back</a>";
    exit;
}

$quiz_title = "PHP & HTML Quiz";
$questions = [
    [
        "question" => "1. What does HTML stand for?",
        "options" => [
            "Hyper Text Markup Language",
            "Home Tool Markup Language",
            "Hyperlinks and Text Markup Language",
            "Hyper Text Makeup Language"
        ],
        "answer" => 0,
    ],
    [
        "question" => "2. What does PHP stand for?",
        "options" => [
            "Personal Home Page",
            "PHP: Hypertext Preprocessor",
            "Private Hosting Protocol",
            "Programmed Hypertext Processor"
        ],
        "answer" => 1,
    ],
    [
        "question" => "3. Which HTML tag is used to create a hyperlink?",
        "options" => [
            htmlspecialchars("<a>"),
            htmlspecialchars("<link>"),
            htmlspecialchars("<href>"),
            htmlspecialchars("<hyperlink>")
        ],
        "answer" => 0,
    ],
    [
        "question" => "4. Which PHP function is used to print output?",
        "options" => [
            "print()",
            "echo()",
            "output()",
            "write()"
        ],
        "answer" => 1,
    ],
    [
        "question" => "5. Which is the correct way to declare a PHP variable?",
        "options" => [
            '$variable',
            "var variable",
            "@variable",
            "#variable"
        ],
        "answer" => 0,
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & HTML QUIZ</title>
    <link rel="stylesheet" href="quiz_styles.css">
    <script>
        let startTime = new Date().getTime();

        function calculateTimeSpent() {
            let endTime = new Date().getTime();
            let timeSpent = Math.floor((endTime - startTime) / 1000);
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
