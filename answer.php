<?php
session_start();

// Sample questions and answers for validation
$questions = [
    1 => [
        1 => ['answer' => 'Doge'], //IMPORTANT: MAKE SURE TO UPDATE "answer.php" with question and answer too!!!
        2 => ['answer' => 'Add answer here'],
        3 => ['answer' => 'girl'],
        4 => ['answer' => 'Add answer here'],
        5 => ['answer' => 'Add answer here'],
    ],
    2 => [
        1 => ['answer' => '13'],
        2 => ['answer' => 'parenthesis'],
        3 => ['answer' => 'Integral'],
        4 => ['answer' => '3/8'],
        5 => ['answer' => 'L Hopital'],
    ],
    3 => [
        1 => ['answer' => 'Freddy Krueger'],
        2 => ['answer' => 'Add answer here'],
        3 => ['answer' => 'Add answer here'],
        4 => ['answer' => 'Add answer here'],
        5 => ['answer' => 'Pamela Voorhees'],
    ],
    4 => [
        1 => ['answer' => 'egg'],
        2 => ['answer' => 'Sponge'],
        3 => ['answer' => 'Piano'],
        4 => ['answer' => 'Add answer here'],
        5 => ['answer' => 'Add answer here'],
    ],
    5 => [
        1 => ['answer' => 'Pho'],
        2 => ['answer' => 'Sushi'],
        3 => ['answer' => 'Paella'],
        4 => ['answer' => 'Add answer here'],
        5 => ['answer' => 'Add answer here'],
    ],
];

// Get the category and value from the POST parameters
$category = isset($_POST['category']) ? intval($_POST['category']) : 1;
$value = isset($_POST['value']) ? intval($_POST['value']) : 100;
$userAnswer = isset($_POST['answer']) ? trim($_POST['answer']) : '';

// Check if the answer is correct
$isCorrect = false;
if (isset($questions[$category][$value / 100])) {
    $correctAnswer = $questions[$category][$value / 100]['answer'];
    $isCorrect = strcasecmp($userAnswer, $correctAnswer) === 0; // Case insensitive comparison
}

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
