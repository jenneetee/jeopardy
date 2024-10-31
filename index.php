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

        <?php
        $teamCount = 0;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['teamCount'])) {
            $teamCount = intval($_POST['teamCount']);
        }
        ?>

        <form action="" method="POST">
            <h2>Choose how many teams there are:</h2>
            <div class="team-buttons">
                <button type="submit" name="teamCount" value="1">1 Team</button>
                <button type="submit" name="teamCount" value="2">2 Teams</button>
                <button type="submit" name="teamCount" value="3">3 Teams</button>
                <button type="submit" name="teamCount" value="4">4 Teams</button>
            </div>
        </form>

        <?php if ($teamCount > 0): ?>
            <h2>Teams:</h2>
            <ul>
                <?php for ($i = 1; $i <= $teamCount; $i++): ?>
                    <li>Team <?php echo $i; ?></li>
                <?php endfor; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
