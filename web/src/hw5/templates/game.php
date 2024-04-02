<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/game.css">
    <title>Connections Game</title>
</head>
<body>
    <h1>GAME</h1>
    <?php

    if (isset($_SESSION['user'])) {
        $username = $_SESSION['user']['name'];
        $email = $_SESSION['user']['email'];

        echo "<p>Welcome, $username!</p>";
        echo "<p>Your email is: $email</p>";
        if(isset($_SESSION['guessCount'])) {
            $guessCount = $_SESSION['guessCount'];
            echo "<p>Total guess count: $guessCount</p>";
        } else {
            echo "<p>Total guess count: 0</p>";
        }
    } else {
        header("Location: login.php");
        exit();
    }
    echo "<div class='options-container'>";
    foreach ($_SESSION['options'] as $key=>$option) {
        echo "<div class='option-card'><h4 class='option-number'>$key</h4><p class='option-text'>$option</p></div>";
    }
    echo "</div>";
    ?>
    <p>The goal of the game is to find the 4 categories and their 4 words associated with each given category. Enter the number associated with the word in the text box, separated by a space, to submit your guess!</p>
    <form id="guess-form" method="post" action="?command=submitGuess">
		<label for="guess-input">Guess:</label>
		<input id="guess-input" type="text" name="guess" />
		<button type="submit">Guess</button>
	</form>
    <?php

    if (!empty($_SESSION['guessError'])) {
        echo "<p style='color:red;'>" . htmlspecialchars($_SESSION['guessError']) . "</p>";
    }

    // Display the previous guesses here as a list and how many they were away from getting it right.
    if (!empty($_SESSION['guessHistory'])) {
        echo "<h3>Previous Guesses</h3>";
        echo "<ul>";
        foreach ($_SESSION['guessHistory'] as $guessRecord) {
            $guessedWords = implode(', ', $guessRecord['guessedWords']);
            $awayFromCorrect = $guessRecord['awayFromCorrect'];
            if ($awayFromCorrect == 3) {
                echo "<li>Guessed Words: $guessedWords - No words were from the same category</li>";
            } else {
                echo "<li>Guessed Words: $guessedWords - Away from correct: $awayFromCorrect</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "<p>No previous guesses to display.</p>";
    }
    ?>
    <form id="game-over" method="post" action="?command=gameOver">
        <button type="submit">End Game</button>
    </form>

</body>
</html>