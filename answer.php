<?php
session_start();

// Questions array with image paths for answers that have associated images
$questions = [
    1 => [
        1 => ['answer' => 'Doge', 'image' =>'media/doge.png'],
        2 => ['answer' => 'Meme'],
        3 => ['answer' => 'girl', 'image' => 'media/girl.png'],
        4 => ['answer' => 'Kermit', 'image' => 'media/kermit.png'],
        5 => ['answer' => 'Grumpy Cat', 'image' => 'media/grumpy-cat.png'],
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
        1 => ['answer' => 'Pho','image' => 'media/pho.png'],
        2 => ['answer' => 'Sushi','image' => 'media/sushi.png'],
        3 => ['answer' => 'Paella','image' => 'media/paella.png'],
        4 => ['answer' => 'Carbonara','image' => 'media/carbonara.png'],
        5 => ['answer' => 'Escargot','image' => 'media/escargot.png'],
    ],
];

// Retrieve category, value, and user-provided answer
$category = $_POST['category'] ?? 1;
$value = $_POST['value'] ?? 100;
$userAnswer = $_POST['answer'] ?? '';
$teamIndex = $_POST['team'] ?? 0;

// Validate answer and set correct/incorrect status
$isCorrect = false;
$questionIndex = $value / 100;
if (isset($questions[$category][$questionIndex])) {
    $correctAnswer = $questions[$category][$questionIndex]['answer'];
    $correctImage = $questions[$category][$questionIndex]['image'] ?? null;
    $isCorrect = strcasecmp($userAnswer, $correctAnswer) === 0;
}

if ($isCorrect) {
    $_SESSION['scores'][$teamIndex] += $value;
    $_SESSION['answered'][$category][$value] = true;
    $resultClass = 'correct';
} else {
    $_SESSION['scores'][$teamIndex] -= $value;
    $resultClass = 'incorrect';
    if ($_SESSION['scores'][$teamIndex] < 0) {
        $_SESSION['scores'][$teamIndex] = 0;
    }
}

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
<body class="<?= $resultClass ?>">
    <div class="container">
        <h1>Answer Result</h1>
        <?php if ($isCorrect): ?>
            <p>Correct! 🎉</p>
        <?php else: ?>
            <p>Incorrect. The correct answer was: <strong><?= htmlspecialchars($correctAnswer) ?></strong></p>
        <?php endif; ?>
        
        <?php if (isset($correctImage)): ?>
            <img src="<?= $correctImage ?>" alt="Image for <?= htmlspecialchars($correctAnswer) ?>" width="200">
        <?php endif; ?>
        
        <br>
        <a href="gameplay.php">Return to Game</a>
    </div>
</body>
</html>
