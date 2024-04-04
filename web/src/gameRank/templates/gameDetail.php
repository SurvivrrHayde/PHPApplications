<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Thomas Arnold, Matthew Haid">
    <meta name="description" content="Game Rank">
    <meta name="keywords" content="video games, games">
    <title>Game Rank Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .container {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .card {
            margin-bottom: 20px;
            width: 95%;
            height: 100%;
            padding: 5px;
        }

        .card-title {
            margin-bottom: 10px;
        }

        .card-text {
            margin-bottom: 20px;
        }

        .list-group-item {
            border: none;
            padding: 8px 0;
        }

        .screenshot-img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .company-logo {
            max-width: 100px;
            max-height: 50px;
            margin-right: 10px;
            vertical-align: middle;
        }

        .console-logo {
            max-width: 100px;
            max-height: 50px;
        }

        .game-img {
            height: 25vh;
            object-fit: fill;
        }


    </style>
    <?php
    $gameID = $_GET["id"];
    $gameInfo = $this->gameGetter->getGameDetail($gameID);
    $name = $gameInfo["name"];
    $summary = $gameInfo["summary"];
    $cover = $gameInfo["cover"];
    $screenshots = $gameInfo["screenshots"];
    $genres = $gameInfo["genres"];
    $company = $gameInfo["company"];
    $company_logo = $gameInfo["company_logo"];
    $platforms = $gameInfo["platforms"];
    $platform_logos = $gameInfo["platform_logos"];
    $release_date = $gameInfo["release_date"];
    ?>
</head>
<body>
<?php include "navbar.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card h-100">
                <img src="<?= $cover ?>" alt="<?= $name ?> cover" class="game-img card-img-top"/>
                <div class="card-body">
                    <h2 class="card-title"> <?= $name ?> </h2>
                    <p class="card-text"> <?= $summary ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item">
                    <b> Release Date: </b> <?= $release_date ?>
                </li>
                <li class="list-group-item">
                    <b>Developer: </b> <?= $company ?>
                    <?php
                    if ($company_logo) {
                        echo "<img src='$company_logo' alt='$company logo' class='company-logo' />";
                    }
                    ?>
                </li>
                <li class="list-group-item">
                    <b>Genres: </b>
                    <?php
                    for ($i = 0; $i < count($genres); $i++) {
                        echo $genres[$i] . ", ";
                    }
                    ?>
                </li>
                <li class="list-group-item">
                    <b>Platforms:</b>
                    <?php
                    for ($i = 0; $i < count($platforms); $i++) {
                        echo "<li class='list-group-item'>" . $platforms[$i] . "<img src='$platform_logos[$i]' alt='$platforms[$i] logo' class='console-logo'/>" . "</li>";
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3> Screenshots </h3>
            <div class="row">
                <?php
                for ($i = 0; $i < count($screenshots); $i++) {
                    echo "<div class='col-md-4'>";
                    echo "<img src='$screenshots[$i]' alt='$name screenshot' class='screenshot-img'/>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
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
