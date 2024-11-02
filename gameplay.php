<?php
session_start();

// Check if team count was posted from index.php; if so, set it in the session and reset scores
if (isset($_POST['teamCount'])) {
    $_SESSION['teamCount'] = intval($_POST['teamCount']);
    $_SESSION['scores'] = array_fill(0, $_SESSION['teamCount'], 0); // Reset scores to $0 for each team
}

// Get the team count from the session (default to 1 if not set)
$teamCount = isset($_SESSION['teamCount']) ? $_SESSION['teamCount'] : 1;

// Initialize or retrieve the answered questions
if (!isset($_SESSION['answered'])) {
    $_SESSION['answered'] = [];
}


// Check if a question was answered
if (isset($_POST['category']) && isset($_POST['value'])) {
    $category = intval($_POST['category']);
    $value = intval($_POST['value']);
    $_SESSION['answered'][$category][$value] = true; // Mark question as answered
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
        <h1>Jeopardy!!</h1>

        <!-- Gameboard Table -->
        <div class="gameboard-container">
            <table class="gameboard">
                <tr>
                    <th>Category 1</th>
                    <th>Category 2</th>
                    <th>Category 3</th>
                    <th>Category 4</th>
                    <th>Category 5</th>
                </tr>
                <?php
                for ($row = 1; $row <= 5; $row++): ?>
                    <tr>
                        <?php for ($col = 1; $col <= 5; $col++): ?>
                            <?php 
                            $isAnswered = isset($_SESSION['answered'][$col][$row * 100]) ? 'answered' : ''; // Check if answered
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
