<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);
    $time_taken = isset($_POST['time_taken']) ? (int)$_POST['time_taken'] : 0;

    $questions = [
        [
            "answer" => 0
        ],
        [
            "answer" => 1
        ],
        [
            "answer" => 0
        ],
        [
            "answer" => 1
        ],
        [
            "answer" => 0
        ]
    ];

    $score = 0;
    foreach ($questions as $index => $question) {
        $user_answer = isset($_POST["question$index"]) ? (int)$_POST["question$index"] : -1;
        if ($user_answer === $question['answer']) {
            $score++;
        }
    }

    $stmt = $conn->prepare("INSERT INTO quiz_results (username, score, time_taken) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $username, $score, $time_taken);

    if ($stmt->execute()) {
        header("Location: ranking.php?username=$username&score=$score");
        exit;
    } else {
        echo "Error saving your result. Please try again.";
    }
} else {
    echo "<h1>Invalid access. Please complete the quiz first.</h1>";
    exit;
}
?>
