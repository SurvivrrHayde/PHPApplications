<!DOCTYPE html>
<html lang="en">
<!-- Sources used: https://stackoverflow.com/questions/37287153/how-to-get-images-in-bootstraps-card-to-be-the-same-height-width , https://www.w3schools.com/howto/howto_css_style_hr.asp-->

<head>
  <!-- Include Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/styles.css">
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
            margin-top: 10px;
        }

        .col {
            flex: 0 0 auto;
            width: auto;
        }

        h1 {
            text-align: center;
        }

        h3 {
            text-align: center;
        }

        body {
            background-color: #121212;
            color: #fff;
        }

        .card {
            background-color: #333;
            color: #fff;
            height: 400px;
            width: 200px;
        }

        .card-title {
            color: #fff;
        }

        .card-text {
            color: rgba(255, 255, 255, 0.7);
        }

        .btn-primary {
            background-color: #1c7cb8;
            border-color: #1c7cb8;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
  <!-- Navbar -->
  <?php include "/opt/src/gameRank/templates/navbar.php"; ?>
  <!-- Users -->
  <h1 class="d-flex justify-content-center"><?= $_SESSION['currentGroup']['groupName'] ?> (<?= $_SESSION['currentGroup']['creatorName']?>'s Group)</h1>
  <h3 class="d-flex justify-content-center">Deadline: <?= $_SESSION['currentGroup']['deadline'] ?></h3>
  <div class="d-flex justify-content-center">
      <!-- TODO: Use JavaScript to check final deadline -->
    <a href="?command=showRankGroup" tabindex="0" class="btn btn-primary" role="button" id="shutup">
      View Final Rankings
    </a>
  </div>
  <hr class="border">
  <div class="row text-center">
    <h2>Users in this group:</h2>
      <?php foreach ($_SESSION['currentGroup']['groupUsers'] as $username): ?>
        <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $username['username'] ?>
                        </h5>
                    </div>
                </div>
        </div>
    <?php endforeach; ?>
  </div>
  <!-- Your Rankings -->
  <!-- TODO: make all cards float to the left, don't space them out automatically -->
  <div class="row" style="justify-content: left">
      <div class="col-6">
          <h1>Your Rankings:</h1>
      </div>
      <div class="col-6" style="justify-content: right">
          <form action="?command=search&page=1" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="post">
              <input
                      class="form-control"
                      placeholder="Search Games..."
                      aria-label="Search"
                      name="searchText"
              >
              <button type="submit" class="btn btn-primary">Search for a game to add it! </button>
          </form>
      </div>
  </div>
  <hr class="border">
  <?php $rankings = $_SESSION["currentGroup"]["rankings"]; ?>
  <?php if(isset($rankings)): ?>
    <div class="card-group justify-content-start">
    <?php foreach($rankings as $game): ?>
      <?php
      $name = $game["gamename"];
      $rank = $game["ranking"];
      $coverQuery = $this->db->query("SELECT cover FROM Games WHERE name = $1", $name);
      $cover = $coverQuery[0]["cover"];
      ?>
    <div class="col">
        <div class="card h-100">
            <img
                src="<?= $cover ?>"
                class="card-img-top"
                alt="<?= $name ?> cover"
            >
            <div class="card-body">
                <h5 class="card-title">
                    <?= $rank ?>. <?= $name ?>
                </h5>
            </div>
        </div>
    </div>
    <?php endforeach ?>
    </div>
  <?php endif ?>
  <!-- Include Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>