<?php

require_once "/opt/src/gameRank/igdb-master/class.igdb.php";

class GameRankController {

    private $db;

    private $errorMessage = "";

    private $gameGetter;

    public function __construct($input) {
        session_start();
        $this->db = new Database();
        $this->input = $input;
        $this->gameGetter = new GameGetter();
    }

    public function run() {
        $command = "";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        switch ($command) {
            case "showHomePage":
                $this->showHomePage();
                break;
            case "showRankGroup":
                $this->showRankGroup();
                break;
            case "login":
                if(isset($_SESSION['user'])) {
                    $this->showHomePage();
                }
                $this->handleLogin();
                break;
            case "showLogin":
                if(isset($_SESSION['user'])) {
                    $this->showHomePage();
                }
                $this->showLogin();
                break;
            case "signup":
                if(isset($_SESSION['user'])) {
                    $this->showHomePage();
                }
                $this->handleSignup();
                break;
            case "showSignup":
                if(isset($_SESSION['user'])) {
                    $this->showHomePage();
                }
                $this->showSignup();
                break;
            case "logout":
                $this->handleLogout();
                break;
            case "search":
                $this->searchGames();
                break;
            case "detail":
                $this->showGameDetails();
                break;
            default:
                include("/opt/src/gameRank/templates/homePage.php");
                break;
        }
    }

    public function handleLogin() {
        if (isset($_POST['userName']) && isset($_POST['password']) && !empty($_POST['userName']) && !empty($_POST['password'])) {
            $userName = $_POST['userName'];
            $password = $_POST['password'];

            $res = $this->db->query("select * from users where userName = $1;", $userName);

            if (empty($res)) {
                $this->errorMessage = "No Username found. Please sign up.";
                $this->showLogin();
                return;
            } else {
                if (password_verify($password, $res[0]["hashedpassword"])) {
                    $_SESSION['user'] = array(
                        'firstName' => $res[0]["firstName"],
                        'lastName' => $res[0]["lastName"],
                        'userName' => $userName,
                        'email' => $res[0]["email"],
                    );
                    header("Location: ?command=showHomePage");
                    return;
                } else {
                    $this->errorMessage = "Password incorrect.";
                    $this->showLogin();
                    return;
                }
            }
        }
        $this->errorMessage = "Error logging in - Username and Password is required";
        $this->showLogin();
    }

    public function verifyEmail($email) {
        return preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email);
    }

    public function verifyPassword($password) {
        return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/', $password);
    }

    public function confirmPasswordMatches($password, $confirmPassword) {
        return $password === $confirmPassword;
    }

    public function handleSignup() {
        if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword']) && !empty($_POST['firstName']) && !empty($_POST['lastName'])&& !empty($_POST['userName'])&& !empty($_POST['email'])&& !empty($_POST['password'])&& !empty($_POST['confirmPassword'])) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $userName = $_POST['userName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            if (!$this->verifyEmail($email)) {
                $this->errorMessage = "Email is not valid.";
                $this->showSignup();
                return;
            }
            if (!$this->verifyPassword($password)) {
                $this->errorMessage = "Password must contain at least one symbol, capital letter, and number";
                $this->showSignup();
                return;
            }
            if (!$this->confirmPasswordMatches($password, $confirmPassword)) {
                $this->errorMessage = "Passwords do not match.";
                $this->showSignup();
                return;
            }

            $res = $this->db->query("select * from users where userName = $1;", $userName);

            if (empty($res)) {
                $this->db->query("insert into users (firstName, lastName, userName, email, hashedpassword) values ($1, $2, $3, $4, $5);",
                    $firstName, $lastName, $userName, $email,
                    password_hash($password, PASSWORD_DEFAULT));
                $_SESSION['user'] = array(
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'userName' => $userName,
                    'email' => $email,
                );
                header("Location: ?command=showHomePage");
                return;
            } else {
                $this->errorMessage = "Username already in use.";
                $this->showSignup();
                return;
            }
        }
        $this->errorMessage = "Error signing up - not all fields filled out.";
        $this->showSignup();
    }

    public function handleLogout() {
        session_destroy();
        session_start();
        header("Location: ?command=showHomePage");
    }

    public function showHomePage() {
        include("/opt/src/gameRank/templates/homePage.php");
    }

    public function showRankGroup() {
        include("/opt/src/gameRank/templates/rankGroup.php");
    }

    public function showLogin() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        include("/opt/src/gameRank/templates/login.php");
    }

    public function showSignup() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        include("/opt/src/gameRank/templates/signup.php");
    }

    /**
     * Returns top 4 game search hits according to IGDB API
     */
    public function searchGames() {
        if (!isset($_GET["page"])) {
            $_GET["page"] = 1;
        }
        include("/opt/src/gameRank/templates/searchGames.php");
    }

    public function showGameDetails() {
        include("/opt/src/gameRank/templates/gameDetail.php");
    }
}
?>