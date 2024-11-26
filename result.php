<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $score = 0;

    // Ensure time_taken is treated as an integer
    $time_taken = isset($_POST['time_taken']) ? (int)$_POST['time_taken'] : 0;

    // Quiz questions and answers
    $answers = [1, 2, 0]; // Correct answers for the quiz
    foreach ($answers as $index => $correctAnswer) {
        if (isset($_POST['question' . $index])) {
            $userAnswer = (int)$_POST['question' . $index]; // Ensure user answer is treated as integer
            if ($userAnswer === $correctAnswer) {
                $score++;
            }
        }
    }

    // Insert the result into the database (ensuring the values are the correct types)
    $stmt = $conn->prepare("INSERT INTO quiz_results (username, score, time_taken, has_taken_test) VALUES (?, ?, ?, 1)");
    $stmt->bind_param("sii", $username, $score, $time_taken);  // Ensure $time_taken is an integer
    $stmt->execute();
    $stmt->close();

    // Redirect to ranking.php with username and score
    header("Location: ranking.php?username=$username&score=$score");
    exit;
} else {
    echo "<h1>Invalid access. Please finish the quiz first.</h1>";
    echo "<a href='enter.php'>Go Back</a>";
    exit;
}
?>
