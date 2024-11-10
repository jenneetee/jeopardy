<?php
session_start();

// Clear session variables to reset the game if a new game is started
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['teamCount'])) {
    $_SESSION['teamCount'] = intval($_POST['teamCount']);
    $_SESSION['scores'] = array_fill(0, $_SESSION['teamCount'], 0);
    $_SESSION['currentTeam'] = 0;
    $_SESSION['answered'] = [];
    $_SESSION['isGameOver'] = false; // Reset the game over flag
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeopardy</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to Jeopardy!</h1>

        <form action="gameplay.php" method="POST">
            <h2>Choose how many teams there are:</h2>
            <div class="team-buttons">
                <button type="submit" name="teamCount" value="1">1 Team</button>
                <button type="submit" name="teamCount" value="2">2 Teams</button>
                <button type="submit" name="teamCount" value="3">3 Teams</button>
                <button type="submit" name="teamCount" value="4">4 Teams</button>
            </div>
        </form>
    </div>
</body>
</html>
