<?php
session_start();

// Sample questions and answers
$questions = [
    1 => [
        1 => ['question' => 'Name of Shiba Inu meme'], //IMPORTANT: MAKE SURE TO UPDATE "answer.php" with answer too!!!
        2 => ['question' => 'Add question here'],
        3 => ['question' => 'Mama a ___ behind you💜.'],
        4 => ['question' => 'Add question here'],
        5 => ['question' => 'Add question here'],
    ],
    2 => [
        1 => ['question' => '6 + 7 ='], //IMPORTANT: MAKE SURE TO UPDATE "answer.php" with answer too!!!
        2 => ['question' => 'What is the first step PEMDAS'],
        3 => ['question' => 'How do you find an area under a curve?'],
        4 => ['question' => 'If you have 3/4 of a pizza and eat 1/2 of what you have, how much of the whole pizza do you have left?'],
        5 => ['question' => 'What rule do you use in the case where direct substitution yields an indeterminate form, meaning 0/0 or ±∞/±∞ while doing a limit.'],
    ],
    3 => [
        1 => ['question' => 'He is a scary character who shows up in nightmares with a burned face, a striped sweater, a hat, and a glove with sharp claws. He attacks people in their dreams.'],
        2 => ['question' => 'Add question here'],
        3 => ['question' => 'Add question here'],
        4 => ['question' => 'Add question here'],
        5 => ['question' => 'Who is the killer in the 1980 horror film Friday 13th where the killer seeks revenge and kills camp counselors'],
    ],
    4 => [
        1 => ['question' => 'What has to be broken before you can eat it?'],
        2 => ['question' => 'What is full of holes but still holds water?'],
        3 => ['question' => 'What has 88 keys, but cannot open a single door?'],
        4 => ['question' => 'Add question here'],
        5 => ['question' => 'Add question here'],
    ],
    5 => [
        1 => ['question' => 'A popular Vietnamese noodle dish known for its aromatic flavors and health benefits'],
        2 => ['question' => 'A Japanese dish consisting of small balls or rolls of vinegar-flavored cold cooked rice served with a garnish of raw fish, vegetables, or egg.'],
        3 => ['question' => 'A Spanish dish of rice, saffron, chicken, seafood, etc., cooked and served in a large shallow pan.'],
        4 => ['question' => 'Add question here'],
        5 => ['question' => 'Add question here'],
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
