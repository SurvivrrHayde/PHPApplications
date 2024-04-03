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
</head>
<body>
<?php
$searchText = $_POST["searchText"];
// $games = $this->gameGetter->searchGame($searchText);
// var_dump($games[0]);
$searchResult = $this->gameGetter->searchForGamesAndCovers($searchText);
 var_dump($searchResult);
//echo "<ul>";
//for ($i = 0; $i < 4; $i++) {
//    $query_result = $this->gameGetter->getGameAndCover($games[$i]);
//    echo "<li>";
//        $img_src = $query_result["img_url"];
//        echo "<img alt='Game Cover' src='$img_src' />";
//        echo $query_result["game"];
//    echo "</li>";
//}
//echo "</ul>";


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