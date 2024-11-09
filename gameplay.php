<?php
session_start();

// Initialize teams and scores
if (isset($_POST['teamCount'])) {
    $_SESSION['teamCount'] = intval($_POST['teamCount']);
    $_SESSION['scores'] = array_fill(0, $_SESSION['teamCount'], 0);
    $_SESSION['currentTeam'] = 0;
}

// Get team count and answered questions
$teamCount = $_SESSION['teamCount'] ?? 1;
if (!isset($_SESSION['answered'])) {
    $_SESSION['answered'] = [];
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
