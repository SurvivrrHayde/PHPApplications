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
            case "saveOrder":
                $this->handleSaveOrder();
                break;
            case "returnGroupJson":
                $this->handleJsonGroup();
                break;
            case "changeGameRanking":
                $this->handleChangeGameRanking();
                break;
            case "showHomePage":
                $this->showHomePage();
                break;
            case "showRankGroup":
                $this->showRankGroup();
                break;
            case "showFinalRankings":
                $this->showFinalRankings();
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
                if (!isset($_GET["searchText"])) {
                    header("Location: ?command=search&page=1&searchText=" . ($_POST["searchText"]));
                }
                else {
                    $this->searchGames();
                }
                break;
            case "detail":
                $this->showGameDetails();
                break;
            case "showGroups":
                $this->showGroups();
                break;
            case "showCreateGroup":
                $this->showCreateGroup();
                break;
            case "createGroup":
                $this->handleCreateGroup();
                break;
            case "showJoinGroup":
                $this->showJoinGroup();
                break;
            case "joinGroup":
                $this->handleJoinGroup();
                break;
            case "groupClicked":
                $this->handleGroupClick();
                break;
            case "addGame":
                $this->addGame();
                break;
            case "removeGame":
                $this->removeGame();
                break;
            case "showRankings":
                $this->showRankings();
                break;
            default:
                include("/opt/src/gameRank/templates/homePage.php");
                break;
        }
    }

    public function handleSaveOrder() {
        error_log("hello");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['userId'];
            $groupId = $_SESSION['currentGroup']['groupId'];
            $data = json_decode(file_get_contents("php://input"), true);
            $gameRankings = $data['order'];

            foreach ($gameRankings as $index => $gameId) {
                $ranking = $index + 1;

                $res = $this->db->query("update UserGameRankings set ranking = $1 where groupId = $2 and userId = $3 and gameId = $4", $ranking, $groupId, $userId, $gameId);
            }
            echo json_encode(['status' => 'success']);
            exit;
        }
    }

    public function handleLogin() {
        if (isset($_POST['userName']) && isset($_POST['password'])) {
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
                        'userId' => $res[0]['userid'],
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
        if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $userName = $_POST['userName'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $res = $this->db->query("select * from users where userName = $1;", $userName);

            if (empty($res)) {
                $userId = $this->db->insertQuery("insert into users (firstName, lastName, userName, email, hashedpassword) values ($1, $2, $3, $4, $5) returning userid;",
                    $firstName, $lastName, $userName, $email,
                    password_hash($password, PASSWORD_DEFAULT));
                $_SESSION['user'] = array(
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'userName' => $userName,
                    'email' => $email,
                    'userId' => $userId,
                );
                header("Location: ?command=showHomePage");
                return;
            } else {
                $this->errorMessage = "Username already in use.";
                $this->showSignup();
                return;
            }
        }
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
        $groupId = $_SESSION['currentGroup']['groupId'];
        $userId = $_SESSION['user']['userId'];
        $res = $this->db->query("select g.name as gameName, ugr.ranking from UserGameRankings ugr join Games g on ugr.gameID = g.gameID where ugr.userID = $1 and ugr.groupID = $2 order by ugr.ranking asc", $userId, $groupId);
        $_SESSION['currentGroup']['rankings'] = $res;
        include("/opt/src/gameRank/templates/rankGroup.php");
    }

    public function showGroups() {
        $userName = $_SESSION['user']['userName'];
        $res = $this->db->query("select g.groupID, g.name, g.creatorname, g.deadline from Groups g join GroupMembers gm on g.groupID = gm.groupID join Users u on gm.userID = u.userID where u.userName = $1", $userName);
        $_SESSION['groups'] = $res;
        include("/opt/src/gameRank/templates/groups.php");
    }

    public function showCreateGroup() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        include("/opt/src/gameRank/templates/createGroup.php");
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
    public function handleCreateGroup() {
        if (isset($_POST['groupName']) && isset($_POST['deadline']) && !empty($_POST['groupName']) && !empty($_POST['deadline'])) {
            $groupName = $_POST['groupName'];
            $userName = $_SESSION['user']['userName'];
            $deadline = $_POST['deadline'];

            $res = $this->db->query("select * from Groups where name = $1;", $groupName);

            if (empty($res)) {
                $userId = $_SESSION['user']['userId'];
                $groupId = $this->db->insertQuery("insert into Groups (name, creatorName, deadline) values ($1, $2, $3) returning groupID;",
                    $groupName, $userName, $deadline);
                $_SESSION['debug'] = $userId;
                $this->db->query("insert into GroupMembers (groupId, userId) values ($1, $2);",
                    $groupId, $userId);
                header("Location: ?command=showGroups");
                return;
            } else {
                $this->errorMessage = "Group name already in use.";
                $this->showCreateGroup();
                return;
            }
        }
        $this->errorMessage = "Error creating group - group name and deadline is required";
        $this->showCreateGroup();
    }

    public function showJoinGroup() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        include("/opt/src/gameRank/templates/joinGroup.php");
    }

    public function handleJoinGroup() {
        if (isset($_POST['groupName']) && !empty($_POST['groupName'])) {
            $groupName = $_POST['groupName'];
            $userId = $_SESSION['user']['userId'];

            $res = $this->db->query("select * from Groups where name = $1;", $groupName);
            if (!empty($res)) {
                $groupId = $res[0]['groupid'];
                $this->db->query("insert into GroupMembers (groupId, userId) values ($1, $2);",
                    $groupId, $userId);
                header("Location: ?command=showGroups");
                return;
            } else {
                $this->errorMessage = "Group name doesn't exist.";
                $this->showJoinGroup();
                return;
            }
        }
    }
    public function handleJsonGroup() {
        $userName = $_SESSION['user']['userName'];
        $res = $this->db->query("select g.groupID, g.name, g.creatorname, g.deadline from Groups g join GroupMembers gm on g.groupID = gm.groupID join Users u on gm.userID = u.userID where u.userName = $1", $userName);
        header('Content-Type: application/json');
        echo json_encode($res, JSON_PRETTY_PRINT);
        exit;
    }

    public function handleGroupClick() {
        $groupName = $_POST['groupName'];
        $res = $this->db->query("select * from Groups where name = $1;", $groupName);
        $groupId = $res[0]["groupid"];
        $deadline = $res[0]["deadline"];
        $creatorName = $res[0]["creatorname"];
        $res = $this->db->query("select u.username from Users u join GroupMembers gm on u.userID = gm.userID where gm.groupID = $1", $groupId);
        $groupUsers = $res;
        $userId = $_SESSION['user']['userId'];
        $res = $this->db->query("select g.name as gameName, ugr.ranking from UserGameRankings ugr join Games g on ugr.gameID = g.gameID where ugr.userID = $1 and ugr.groupID = $2 order by ugr.ranking asc", $userId, $groupId);
        $_SESSION['currentGroup'] = array(
            'groupName' => $groupName,
            'groupId' => $groupId,
            'deadline' => $deadline,
            'creatorName' => $creatorName,
            'groupUsers' => $groupUsers,
            'rankings' => $res,
        );
        header("Location: ?command=showRankGroup");
    }

    public function handleChangeGameRanking() {
        $gameName = $_POST['gameName'];
        error_log($gameName);
        $ranking = $_POST['ranking'];
        error_log($ranking);
        $userId = $_SESSION['user']['userId'];
        error_log($userId);
        $groupId = $_SESSION['currentGroup']['groupId'];
        error_log($groupId);
        $res = $this->db->query("select * from Games where name = $1;", $gameName);
        $gameId = $res[0]['gameid'];
        $res = $this->db->query("insert into UserGameRankings (gameID, userId, groupId, ranking) values ($1, $2, $3, $4) on conflict (userId, groupId, ranking) do update set gameID = excluded.gameID", $gameId, $userId, $groupId, $ranking);
        header("Location: ?command=showRankGroup");
    }

    public function addGame() {
        $userID = $_SESSION["user"]["userId"];
        $group = $_POST["groupName"];
        $gameID = $_POST["gameId"];
        $gameName = $_POST["gameName"];
        $gameImage = $_POST["gameImage"];
        // Check if the game already exists in the Games table
        $gameAlreadyExists = $this->db->query("SELECT COUNT(*) AS count FROM Games WHERE gameid = $1", $gameID);
        $gameCount = $gameAlreadyExists[0]["count"];
        if ($gameCount == 0) {
            $this->db->query("INSERT INTO Games (gameid, name, cover) VALUES ($1, $2, $3)", $gameID, $gameName, $gameImage);
        }
        // Check if the game already exists in the group
        $gameExistsInThisGroup = $this->db->query("SELECT COUNT(*) AS count FROM UserGameRankings WHERE groupid = (SELECT groupid FROM Groups WHERE name = $1) AND gameid = $2 AND userid = $3", $group, $gameID, $userID);
        $existingCount = $gameExistsInThisGroup[0]["count"];
        if ($existingCount > 0) {
            echo json_encode(array("success" => false, "message" => "You've already added this game to $group!"));
            exit;
        }
        // Check if the deadline has passed
        $deadlineQuery = $this->db->query("SELECT deadline FROM Groups WHERE name = $1", $group);
        $deadline = $deadlineQuery[0]["deadline"];
        $deadlineDateTime = new DateTime($deadline);
        $currentDateTime = new DateTime();
        if ($currentDateTime >= $deadlineDateTime) {
            echo json_encode(array("success" => false, "message" => "The deadline for this group has passed!"));
            exit;
        }
        // Proceed to add game
        $groupID = $this->db->query("SELECT groupid AS groupid FROM Groups WHERE name = $1", $group);
        $groupID = $groupID[0]["groupid"];
        $nextRanking = $this->db->query("SELECT MAX(ranking) + 1 AS next_ranking FROM UserGameRankings WHERE groupid = $1", $groupID);
        $nextRanking = $nextRanking[0]["next_ranking"];
        if (empty($nextRanking)) {
            $nextRanking = 1;
        }
        $this->db->query("INSERT INTO UserGameRankings (groupid, userid, gameid, ranking) VALUES ($1, $2, $3, $4)", $groupID, $userID, $gameID, $nextRanking);
        echo json_encode(array("success" => true, "message" => "Game successfully added to $group!"));
        exit;
    }

    public function removeGame() {
        if (!isset($_POST["gameId"]) || !isset($_POST["groupId"]) || !isset($_POST["userId"]) || !isset($_POST["ranking"])) {
            echo json_encode(array("success" => false, "message" => "One or more required parameters are not set."));
            exit;
        }
        $gameId = (int)$_POST["gameId"];
        $groupId = (int)$_POST["groupId"];
        $userId = (int)$_POST["userId"];
        $ranking = (int)$_POST["ranking"];
        // decrement all games ranked higher than the game about to be deleted
        $gamesToUpdate = $this->db->query("SELECT gameid FROM UserGameRankings WHERE groupid = $1 AND userid = $2 AND ranking > $3", $groupId, $userId, $ranking);
        foreach ($gamesToUpdate as $game) {
            $curId = $game["gameid"];
            $rankingQuery = $this->db->query("SELECT ranking FROM UserGameRankings WHERE groupid = $1 AND userid = $2 AND gameid = $3", $groupId, $userId, $curId);
            $rankingToBe = $rankingQuery[0]["ranking"] - 1;
            $updateQuery = $this->db->query("UPDATE UserGameRankings SET ranking = $1 WHERE groupid = $2 AND userid = $3 AND gameid = $4", $rankingToBe, $groupId, $userId, $curId);
        }
        // remove game from rankings
        $removeQuery = $this->db->query("DELETE FROM UserGameRankings WHERE gameid = $1 AND userid = $2 AND groupid = $3 AND ranking = $4", $gameId, $userId, $groupId, $ranking);
        echo json_encode(array("success" => true, "message" => "Successfully removed game from ranking."));
        exit;
    }

    public function showRankings() {
        if (!isset($_SESSION["currentGroup"]["groupId"]))  {
            echo json_encode(array("success" => false, "message" => "Unable to find group."));
            exit;
        }
        $groupId = $_SESSION["currentGroup"]["groupId"];
        $ranking = []; // In form of "gameid" => (int) points
        // Get all rankings in the group
        $rankingQuery = $this->db->query("SELECT * FROM UserGameRankings WHERE groupid = $1", $groupId);
        // TODO: Specify that users can submit up to 40 games (?)
        foreach ($rankingQuery as $rank) {
            $curGame = $rank["gameid"];
            $curRank = $rank["ranking"];
            if (array_key_exists($curGame, $ranking)) {
                $ranking[$curGame] += $this->convertRankingToPoints($curRank);
            }
            else {
                $ranking[$curGame] = $this->convertRankingToPoints($curRank);
            }
        }
        arsort($ranking); // Sort an associative array in descending order while preserving keys
        $_SESSION["finalRankings"] = $ranking;
        header("Location: ?command=showFinalRankings");
    }

    public function showFinalRankings() {
        include("/opt/src/gameRank/templates/rankings.php");
    }

    public function convertRankingToPoints($ranking): int {
        $ranking = (int) $ranking;
        if ($ranking == 1) {
            return 18;
        }
        else if ($ranking == 2 || $ranking == 3) {
            return 17;
        }
        else if ($ranking == 4 || $ranking == 5) {
            return 16;
        }
        else if ($ranking >= 6 && $ranking <= 10) {
            return 15;
        }
        else if ($ranking >= 11 && $ranking <= 15) {
            return 14;
        }
        else if ($ranking >= 16 && $ranking <= 20) {
            return 13;
        }
        else if ($ranking >= 21 && $ranking <= 25) {
            return 12;
        }
        else if ($ranking >= 26 && $ranking <= 30) {
            return 11;
        }
        else if ($ranking >= 31 && $ranking <= 40) {
            return 10;
        }
        else {
            return 0;
        }
    }
}
?>