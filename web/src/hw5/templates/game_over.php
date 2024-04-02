<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Over</title>
</head>
<body>

    <?php
$guessCount = isset($_SESSION['guessCount']) ? $_SESSION['guessCount'] : 'Not available';
$categoriesAndWords = isset($_SESSION['answers']) ? $_SESSION['answers'] : [];
?>
<h1>Game Over</h1>

<h2>Summary</h2>
<p>Number of guesses: <?= $guessCount ?></p>
<h3>Categories and Words:</h3>
<?php foreach ($categoriesAndWords as $category => $words): ?>
    <p><strong><?= $category ?>:</strong> <?= implode(', ', $words) ?></p>
<?php endforeach; ?>

<form method="post" action="?command=gameOverAction">
    <button name="playAgain" type="submit">Play Again</button>
    <button name="exit" type="submit">Exit</button>
</form>
</body>
</html>
