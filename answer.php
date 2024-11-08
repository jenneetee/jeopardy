<?php
session_start();

// Sample answers for validation
$questions = [
    1 => [
        1 => ['answer' => 'Doge'],
        2 => ['answer' => 'Meme'],
        3 => ['answer' => 'Mistake'],
        4 => ['answer' => 'Kermit'],
        5 => ['answer' => 'Grumpy Cat'],
    ],
    2 => [
        1 => ['answer' => '13'],
        2 => ['answer' => 'Parentheses'],
        3 => ['answer' => 'Integral'],
        4 => ['answer' => 'Three-eighths'],
        5 => ['answer' => 'L Hopital’s Rule'],
    ],
    3 => [
        1 => ['answer' => 'Freddy Krueger'],
        2 => ['answer' => 'Jason Voorhees'],
        3 => ['answer' => 'Chucky'],
        4 => ['answer' => 'Scream'],
        5 => ['answer' => 'Pamela Voorhees'],
    ],
    4 => [
        1 => ['answer' => 'Egg'],
        2 => ['answer' => 'Sponge'],
        3 => ['answer' => 'Piano'],
        4 => ['answer' => 'Are you asleep?'],
        5 => ['answer' => 'Clock'],
    ],
    5 => [
        1 => ['answer' => 'Pho'],
        2 => ['answer' => 'Sushi'],
        3 => ['answer' => 'Paella'],
        4 => ['answer' => 'Carbonara'],
        5 => ['answer' => 'Escargot'],
    ],
];

$category = $_POST['category'] ?? 1;
$value = $_POST['value'] ?? 100;
$userAnswer = $_POST['answer'] ?? '';
$teamIndex = $_POST['team'] ?? 0;

$isCorrect = false;
if (isset($questions[$category][$value / 100])) {
    $correctAnswer = $questions[$category][$value / 100]['answer'];
    $isCorrect = strcasecmp($userAnswer, $correctAnswer) === 0;
}

// Update score based on correctness
if ($isCorrect) {
    $_SESSION['scores'][$teamIndex] += $value;
    $_SESSION['answered'][$category][$value] = true;
} else {
    $_SESSION['scores'][$teamIndex] -= $value;
    // Prevent negative score
    if ($_SESSION['scores'][$teamIndex] < 0) {
        $_SESSION['scores'][$teamIndex] = 0;
    }
}

// Rotate to the next team
$_SESSION['currentTeam'] = ($_SESSION['currentTeam'] + 1) % $_SESSION['teamCount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Answer Result</title>
    <link rel="stylesheet" href="answer.css">
</head>
<body>
    <div class="container">
        <h1>Answer Result</h1>
        <?php if ($isCorrect): ?>
            <p>Correct! 🎉</p>
        <?php else: ?>
            <p>Incorrect. The correct answer was: <strong><?= htmlspecialchars($correctAnswer) ?></strong></p>
        <?php endif; ?>
        <a href="gameplay.php">Return to Game</a>
    </div>
</body>
</html>
