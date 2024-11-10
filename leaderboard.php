<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="leaderboard.css">
</head>
<body>
    <div class="container">
        <h1>Jeopardy Leaderboard</h1>
        <p><a href="index.php">Start a New Game</a></p>

        <?php if (!empty($_SESSION['leaderboard'])): ?>
            <table>
                <tr>
                    <th>Team</th>
                    <th>Wins</th>
                </tr>
                <?php foreach ($_SESSION['leaderboard'] as $team => $wins): ?>
                    <tr>
                        <td>Team <?= $team ?></td>
                        <td><?= $wins ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No wins recorded yet. Play a game to see the leaderboard!</p>
        <?php endif; ?>
    </div>
</body>
</html>
