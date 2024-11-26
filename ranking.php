<?php

include "conn.php";

if (isset($_GET['username']) && isset($_GET['score'])) {
    $username = $_GET['username'];
    $score = (int)$_GET['score'];

    $rank_result = $conn->query("SELECT COUNT(*) + 1 AS `rank` FROM quiz_results WHERE score > $score");
    $user_rank = $rank_result->fetch_assoc()['rank'];

    $leaderboard_result = $conn->query("SELECT id, username, score, time_taken FROM quiz_results ORDER BY score DESC, time_taken ASC LIMIT 10");


    if (isset($_GET['delete_user'])) {
        $delete_user = htmlspecialchars($_GET['delete_user']);

        $conn->query("DELETE FROM quiz_results WHERE username = '$delete_user' LIMIT 1");

        header("Location: ranking.php?username=$username&score=$score");
        exit;
    }
} else {
    echo "<h1>Invalid access.</h1>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Leaderboard</title>
</head>

<body>
    <center>
    <h1>Congratulations, <?php echo $username; ?>!</h1>

    <p>Your Score: <?php echo $score; ?></p>
    <p>Your Rank: <?php echo $user_rank; ?></p>

    <h2>Leaderboard</h2>

    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>Rank</th>
            <th>Username</th>
            <th>Score</th>
            <th>Time Taken</th>
            <th>Action</th>
        </tr>

        <?php
        if ($leaderboard_result->num_rows > 0) {

            $rank = 1;

            while ($row = $leaderboard_result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>$rank</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['score'] . "</td>";
                    echo "<td>" . $row['time_taken'] . " seconds</td>";
                    echo "<td><a href='?username=$username&score=$score&delete_user=" . $row['username'] . "'>Delete</a></td>"; // Delete link for specific row
                echo "</tr>";
                $rank++;
            }
        } else {
            echo "<tr><td colspan='5'>No leaderboard data available.</td></tr>";
        }
        ?>
    </table>

    <br>

    <a href="enter.php">Try Again</a>

    </center>
</body>
</html>
