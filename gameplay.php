<?php
session_start();

// Initialize teams and scores if this is a new game
if (isset($_POST['teamCount'])) {
    $_SESSION['teamCount'] = intval($_POST['teamCount']);
    $_SESSION['scores'] = array_fill(0, $_SESSION['teamCount'], 0);
    $_SESSION['currentTeam'] = 0;
    $_SESSION['answered'] = []; // Reset answered questions
    $_SESSION['isGameOver'] = false; // Reset the game over flag
}

// Get team count and initialize answered questions tracking if not set
$teamCount = $_SESSION['teamCount'] ?? 1;
if (!isset($_SESSION['answered'])) {
    $_SESSION['answered'] = [];
}

// Check if all questions have been answered
$totalQuestions = 25; // 5 categories * 5 values
$answeredQuestions = count(array_filter(array_merge(...$_SESSION['answered']), fn($a) => $a));
$isGameOver = $answeredQuestions >= $totalQuestions;

// Handle end of game and update leaderboard if not already done
if ($isGameOver && !$_SESSION['isGameOver']) {
    $winningTeam = null;
    $highestScore = 0;

    foreach ($_SESSION['scores'] as $teamIndex => $score) {
        if ($score > $highestScore) {
            $highestScore = $score;
            $winningTeam = $teamIndex + 1; // Teams are 1-indexed
        }
    }

    // Update leaderboard in session
    if (!isset($_SESSION['leaderboard'])) {
        $_SESSION['leaderboard'] = [];
    }

    if ($winningTeam !== null) {
        if (!isset($_SESSION['leaderboard'][$winningTeam])) {
            $_SESSION['leaderboard'][$winningTeam] = 0;
        }
        $_SESSION['leaderboard'][$winningTeam]++;
    }

    $_SESSION['isGameOver'] = true; // Mark game as over
    header("Location: leaderboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeopardy Gameboard</title>
    <link rel="stylesheet" href="gameplay.css">
</head>
<body>
    <div class="container">
        <h1>Jeopardy Gameboard</h1>

        <!-- Display team scores and current team -->
        <div class="team-scores">
            <ul class="team-scores-list">
                <?php for ($i = 0; $i < $teamCount; $i++): ?>
                    <li>Team <?= $i + 1 ?>: $<?= $_SESSION['scores'][$i] ?></li>
                <?php endfor; ?>
            </ul>
            <p><strong>Current Team to Answer: Team <?= $_SESSION['currentTeam'] + 1 ?></strong></p>
        </div>

        <!-- Gameboard Table -->
        <div class="gameboard-container">
            <table class="gameboard">
                <tr>
                    <th>Memes</th>
                    <th>Math</th>
                    <th>Fictional Killers</th>
                    <th>Riddles</th>
                    <th>International Foods</th>
                </tr>
                <?php for ($row = 1; $row <= 5; $row++): ?>
                    <tr>
                        <?php for ($col = 1; $col <= 5; $col++): ?>
                            <?php 
                            $isAnswered = isset($_SESSION['answered'][$col][$row * 100]) ? 'answered' : ''; 
                            ?>
                            <td class="<?= $isAnswered ?>">
                                <a href="question.php?category=<?= $col ?>&value=<?= $row * 100 ?>" <?= $isAnswered ? 'style="pointer-events: none; opacity: 0.5;"' : '' ?>>$<?= $row * 100 ?></a>
                            </td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>
    </div>
</body>
</html>
