<?php

class GameRankController {

    private $db;

    // An error message to display on the welcome page
    private $errorMessage = "";

    public function __construct($input) {
        session_start();
        $this->db = new Database();
        $this->input = $input;
    }

    public function run() {
        $command = "";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        switch ($command) {
            case "showHomePage":
                $this->showHomePage();
                break;
            case "login":
                $this->handleLogin();
                break;
            case "showLogin":
                $this->showLogin();
                break;
            case "signup":
                $this->handleSignup();
                break;
            case "showSignup":
                $this->showSignup();
                break;
            case "logout":
                $this->handleLogout();
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
                if (password_verify($password, $res[0]["password"])) {
                    $_SESSION['user'] = array(
                        'firstName' => $res[0]["firstName"],
                        'lastName' => $res[0]["lastName"],
                        'userName' => $userName,
                        'email' => $res[0]["email"],
                    );
                    header("Location: ?command=homePage");
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

            if (!verifyEmail($email)) {
                $this->errorMessage = "Email is not valid.";
                $this->showSignup();
                return;
            }
            if (!verifyPassword($password)) {
                $this->errorMessage = "Password must contain at least one symbol, capital letter, and number";
                $this->showSignup();
                return;
            }
            if (!confirmPasswordMatches($password, $confirmPassword)) {
                $this->errorMessage = "Passwords do not match.";
                $this->showSignup();
                return;
            }

            $res = $this->db->query("select * from users where userName = $1;", $userName);

            if (empty($res)) {
                $this->db->query("insert into users (firstName, lastName, userName, email, password) values ($1, $2, $3, $4, $5);",
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
                // User was in the database, verify password is correct
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
        header("Location: ?command=showHomePage");
    }

    public function showHomePage() {
        include("/opt/src/gameRank/templates/homePage.php");
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
}
?>