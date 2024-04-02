<?php

class CategoryGameController {

    public function __construct($input) {
        session_start();
        $this->input = $input;

        if (!isset($_SESSION['options'])) {
            $this->setNewOptions();
        }
    }

    public function run() {
        error_log($this->input["command"]);

        $command = "";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        switch ($command) {
            case "login":
                $this->handleLogin();
                break;
            case "game":
                $this->showGame();
                break;
            case "submitGuess":
                $this->submitGuess();
                break;
            case "gameOverAction":
                $this->handleGameOverAction();
                break;
            case "gameOver":
                $this->showGameOver();
                break;
            default:
                include("/opt/src/hw5/templates/login.php");
                break;
        }
    }

    public function handleLogin() {
        $this->error = "Something should be happening";
        if (isset($_POST['name']) && isset($_POST['email']) && !empty($_POST['name']) && !empty($_POST['email'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];

            $_SESSION['user'] = array(
                'name' => $name,
                'email' => $email
            );

            header("Location: ?command=game");
            return;
        }
        $this->error = "Error logging in - name and email is required";
    }

    public function handleLogout() {
        session_destroy();
    }

    public function showGame() {
        include("/opt/src/hw5/templates/game.php");
    }

    public function showGameOver() {

        if (!empty($_SESSION['options'])) {
            $_SESSION["guessCount"] = "game ended early.";
        }

        include("/opt/src/hw5/templates/game_over.php");
    }

    public function loadCategories() {
        $categories = file_get_contents("connections.json");
        $categories = json_decode($categories, true);
        return($categories);
    }

    public function getFourCategories($allCategories) {
        $categories = array_rand($allCategories, 4);
        return $categories;
    }

    public function getFourWordsFromCategory($category) {
        $words = array();
        $keys = array_rand($category, 4);
        foreach ($keys as $key) {
            array_push($words, $category[$key]);
        }
        return $words;
    }

    public function setNewOptions() {
        $_SESSION['answers'] = array();
        $_SESSION['options'] = array();
        $allCategories = $this->loadCategories();
        $selectedCategories = $this->getFourCategories($allCategories);

        foreach ($selectedCategories as $category) {
            $words = $this->getFourWordsFromCategory($allCategories[$category]);
            $_SESSION['answers'][$category] = $words;
            $_SESSION['options'] = array_merge($_SESSION['options'], $words);
        }
        shuffle($_SESSION['options']);
    }

    public function getOptions() {
        if (!isset($_SESSION['options']) || empty($_SESSION['options'])) {
            $this->setNewOptions();
        }
    }

    public function isValidGuessFormat($guess) {
        $optionsCount = count($_SESSION['options']) - 1;
    
        if (preg_match('/^(\d{1,2}) (\d{1,2}) (\d{1,2}) (\d{1,2})$/', $guess, $matches)) {
            array_shift($matches);
    
            foreach ($matches as $number) {
                if ($number < 0 || $number > $optionsCount) {
                    return false;
                }
            }
    
            return true;
        }
    
        return false;
    }
    

    public function submitGuess() {
        if (!isset($_SESSION['guessCount'])) {
            $_SESSION['guessCount'] = 0;
        }

        if (!isset($_SESSION['guessHistory'])) {
            $_SESSION['guessHistory'] = [];
        }

        $guessInput = $_POST['guess'] ?? '';

        if ($this->isValidGuessFormat($guessInput)) {
            $_SESSION['guessError'] = '';
            $_SESSION['guessCount']++;
            $guessString = $_POST['guess'];

            $indices = explode(' ', $guessString);
            $guessedOptions = array_map(function($index) {
                return $_SESSION['options'][$index];
            }, $indices);

            $maxMatches = 0;
            foreach ($_SESSION['answers'] as $category => $answers) {
                $matches = count(array_intersect($guessedOptions, $answers));
                $maxMatches = max($maxMatches, $matches);
            }

            $awayFromCorrect = 4 - $maxMatches;
            $_SESSION['guessHistory'][] = [
            'guessedWords' => $guessedOptions,
            'awayFromCorrect' => $awayFromCorrect
            ];

            if ($maxMatches == 4) {
                $_SESSION['options'] = array_diff($_SESSION['options'], $guessedOptions);
                $_SESSION['options'] = array_values($_SESSION['options']);
            }

            if (empty($_SESSION['options'])) {
                header('Location: ?command=gameOver');
                exit();
            }
        } else {
            $_SESSION['guessError'] = "Input must be in the format '0 1 2 3' with numbers between 0 and " . (count($_SESSION['options']) - 1) . ".";
        }
        header("Location: ?command=game");
    }

    public function handleGameOverAction() {
        if (isset($_POST['playAgain'])) {
            $_SESSION['guessCount'] = 0;
            unset($_SESSION['guessHistory']);
            $this->setNewOptions();
            header("Location: ?command=game");
            exit();
        }

        if (isset($_POST['exit'])) {
            session_destroy();
            header('Location: ?command=');
            exit();
        }
    }
}



?>