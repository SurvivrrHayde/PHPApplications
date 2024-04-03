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
    <title>Game Rank Game Search</title>
    <link rel="stylesheet" href="styles\rankgroup.css">
</head>
<body>
<?php
include "navbar.php";
echo "<h1> Showing the top 10 results... </h1>";
$searchText = $_POST["searchText"];
$searchResult = $this->gameGetter->searchForGamesAndCovers($searchText);
$numResults = count($searchResult);
echo "<div class='card-group justify-content-start'>";
for ($i = 0; $i < $numResults; $i++) {
    $game_name = $searchResult[$i][1];
    $game_id = $searchResult[$i][0];
    $img_src = $searchResult[$i][2];
    echo "<div class='col'>";
        echo "<div class='card h-100'>";
        echo "<a href='/gamerank/?command=detail&id=$game_id'>";
        echo "<img alt='$game_name Cover' src='$img_src' />";
        echo "</a>";
        echo "<div class='card-body'>";
            echo "<h5 class='card-title'> $game_name </h5>";
        echo "</div> </div> </div>";
}
// TODO: Handle bad returns / no results
// TODO: add pagination
echo "</div>";
?>


<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>
</html>