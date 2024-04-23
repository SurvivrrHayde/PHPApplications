<!DOCTYPE html>
<!-- Sources used: https://www.w3schools.com/cssref/pr_text_white-space.php-->
<html lang="en">

<head>
  <!-- Include Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="styles/rankings.css">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Thomas Arnold, Matthew Haid">
  <meta name="description" content="Game Rank">
  <meta name="keywords" content="video games, games">
  <title>Game Rank</title>
    <style>
        .card-img-top {
            width: 100%;
            height: 25vh;
            object-fit: cover;
        }

        .card-group {
            justify-content: start;
            margin-bottom: 20px;
            margin-left: 25px;
            margin-top: 10px;
        }

        .col {
            flex: 0 0 auto;
            width: auto;
        }

        .card {
            background-color: #333;
            color: #fff;
            height: 400px;
            width: 200px;
        }

    </style>
</head>

<body>
  <!-- Navbar -->
  <?php include "/opt/src/gameRank/templates/navbar.php"; ?>
  <?php
  // TODO: Null checking on these values
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  $groupName = $_SESSION["currentGroup"]["groupName"];
  $groupId = $_SESSION["currentGroup"]["groupId"];
  $finalRankings = $_SESSION["finalRankings"];
  $iterator = 1;
  ?>
  <div class="d-flex justify-content-left">
    <a tabindex="0" class="btn btn-primary" href="?command=showRankGroup" role="button">
      Back to Group
    </a>
  </div>
  <div class="top-headers">
    <h1>Without further ado... here are the favorite games of <?= $groupName ?>!</h1>
  </div>
  <div class="card-group justify-content-start">
    <?php foreach($finalRankings as $gameId => $points): ?>
        <?php
        $curCoverQuery = $this->db->query("SELECT cover FROM Games WHERE gameid = $1", $gameId);
        $curCover = $curCoverQuery[0]["cover"];
        $curGameNameQuery = $this->db->query("SELECT name FROM Games WHERE gameid = $1", $gameId);
        $curGameName = $curGameNameQuery[0]["name"];
        $curRanking = $iterator;
        $iterator++;
        $usersThatVotedForQuery = $this->db->query("SELECT userid FROM UserGameRankings WHERE gameid = $1 AND groupid = $2", $gameId, $groupId);
        $userIds = [];
        for ($i = 0; $i < count($usersThatVotedForQuery); $i++) {
            $userIds[] = $usersThatVotedForQuery[$i]["userid"];
        }
        ?>
        <div class="col">
            <div class="card h-100 rankCard">
                <img alt="<?= $curGameName ?> cover" class="card-img-top" src="<?= $curCover ?>">
                <div class="card-body">
                    <h5 class="card-title"> <?= $curRanking ?>. <?= $curGameName ?> </h5>
                    <?php foreach($userIds as $curUserId): ?>
                        <?php
                        $username = $this->db->query("SELECT username FROM Users WHERE userid = $1", $curUserId)[0]["username"];
                        $usersRanking = $this->db->query("SELECT ranking FROM UserGameRankings WHERE userid = $1 AND groupid = $2 AND gameid = $3", $curUserId, $groupId, $gameId)[0]["ranking"];
                        ?>
                        <div class="whoRanked">
                            <p class="card-text">
                                <?= $username ?>: #<?= $usersRanking ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                    <a style="color: #1c7cb8" href="/gamerank/?command=detail&id=<?= $gameId ?>"> Learn More </a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
  </div>
  <!-- Include Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>