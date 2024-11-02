<?php
session_start();

// Sample questions and answers for validation
$questions = [
    1 => [
        1 => ['question' => 'Add question here', 'answer' => 'Add answer here'], //IMPORTANT: MAKE SURE TO UPDATE "answer.php" with question and answer too!!!
        2 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        3 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        4 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        5 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
    ],
    2 => [
        1 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        2 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        3 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        4 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        5 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
    ],
    3 => [
        1 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        2 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        3 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        4 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        5 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
    ],
    4 => [
        1 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        2 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        3 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        4 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        5 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
    ],
    5 => [
        1 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        2 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        3 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        4 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        5 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
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
