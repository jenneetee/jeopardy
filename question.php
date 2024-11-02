<?php
session_start();

// Sample questions and answers
$questions = [
    1 => [
        1 => ['question' => 'Add question here', 'answer' => 'Add answer here'], //IMPORTANT: MAKE SURE TO UPDATE "answer.php" with question and answer too!!!
        2 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        3 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        4 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
        5 => ['question' => 'Add question here', 'answer' => 'Add answer here'],
    ],
    2 => [
        1 => ['question' => 'Add question here', 'answer' => 'Add answer here'], //IMPORTANT: MAKE SURE TO UPDATE "answer.php" with question and answer too!!!
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

// Get the category and value from the URL parameters
$category = isset($_GET['category']) ? intval($_GET['category']) : 1;
$value = isset($_GET['value']) ? intval($_GET['value']) : 100;

// Determine the question based on category and value
$questionData = $questions[$category][$value / 100] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link rel="stylesheet" href="question.css">
</head>
<body>
    <div class="container">
        <h1>Question for $<?= $value ?></h1>
        <?php if ($questionData): ?>
            <p><strong><?= $questionData['question'] ?></strong></p>
            <form action="answer.php" method="POST">
                <input type="hidden" name="category" value="<?= $category ?>">
                <input type="hidden" name="value" value="<?= $value ?>">
                <input type="text" name="answer" placeholder="Your answer here" required>
                <button type="submit">Submit Answer</button>
            </form>
        <?php else: ?>
            <p>Question not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
