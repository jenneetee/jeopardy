<?php
session_start();

// Sample questions and answers
$questions = [
    1 => [
        1 => ['question' => 'What is the name of the Shiba Inu dog meme that became popular on the internet?'],
        2 => ['question' => 'What is the term for humorous images or videos shared widely on the internet?'],
        3 => ['question' => 'Complete the phrase: "Mama a ___ behind you💜."'],
        4 => ['question' => 'What popular meme involves a frog sipping tea, captioned with "But that’s none of my business"?'],
        5 => ['question' => 'What meme involves a cat sitting at a dinner table looking angry?'],
    ],
    2 => [
        1 => ['question' => 'What is the sum of 6 + 7?'],
        2 => ['question' => 'What is the first step in the order of operations (PEMDAS)?'],
        3 => ['question' => 'What calculus operation is used to find the area under a curve?'],
        4 => ['question' => 'If you have 3/4 of a pizza and eat 1/2 of what you have, how much of the whole pizza do you have left?'],
        5 => ['question' => 'What rule is used in limits to resolve 0/0 indeterminate forms?'],
    ],
    3 => [
        1 => ['question' => 'Who is the fictional killer who attacks people in their dreams, has a burned face, a striped sweater, and a glove with claws?'],
        2 => ['question' => 'What movie features a killer named Jason who wears a hockey mask?'],
        3 => ['question' => 'What is the name of the killer doll in the "Child’s Play" horror movie series?'],
        4 => ['question' => 'In what movie does the character Ghostface appear?'],
        5 => ['question' => 'Who is the killer in the 1980 horror film "Friday the 13th"?'],
    ],
    4 => [
        1 => ['question' => 'What has to be broken before you can use it?'],
        2 => ['question' => 'What is full of holes but still holds water?'],
        3 => ['question' => 'What has 88 keys but cannot open a single door?'],
        4 => ['question' => 'What question can you never answer "yes" to?'],
        5 => ['question' => 'What has a face, two hands, but no arms or legs?'],
    ],
    5 => [
        1 => ['question' => 'What is the name of the popular Vietnamese noodle soup made with beef or chicken?'],
        2 => ['question' => 'What is the Japanese dish consisting of small rolls of vinegar-flavored rice with raw fish, vegetables, or egg?'],
        3 => ['question' => 'What is the traditional Spanish rice dish made with saffron, chicken, and seafood, served in a large shallow pan?'],
        4 => ['question' => 'What is the Italian pasta dish with eggs, cheese, pancetta, and black pepper?'],
        5 => ['question' => 'What is the French dish of snails cooked with garlic butter, parsley, and herbs?'],
    ],
];

// Get the category and value from the URL parameters
$category = isset($_GET['category']) ? intval($_GET['category']) : 1;
$value = isset($_GET['value']) ? intval($_GET['value']) : 100;

// Calculate question index by dividing value by 100 (e.g., 100 -> 1, 200 -> 2, etc.)
$questionIndex = $value / 100;

// Fetch the question based on category and question index
$questionData = $questions[$category][$questionIndex] ?? null;

// Debugging output to help trace the issue
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
                <input type="hidden" name="team" value="<?= $_SESSION['currentTeam'] ?>">
                <input type="text" name="answer" placeholder="Your answer here" required>
                <button type="submit">Submit Answer</button>
            </form>
        <?php else: ?>
            <p>Question not found.</p>
            <p><strong>Debugging Info:</strong></p>
            <p>Category: <?= htmlspecialchars($category) ?></p>
            <p>Value: <?= htmlspecialchars($value) ?></p>
            <p>Question Index: <?= htmlspecialchars($questionIndex) ?></p>
            <p>Array Check: <?= isset($questions[$category][$questionIndex]) ? 'Question exists' : 'Question does not exist' ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
