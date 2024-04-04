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
    <style>
        #page {
        }

        #pagination-numbers {
            display: flex;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
<?php
include "navbar.php";
//$curPage = $_GET["page"];
// TODO: make this post instead
if (!isset($_GET["searchText"])) {
    $_GET["searchText"] = $_POST["searchText"];
}
$searchText = $_GET["searchText"];
$searchResult = $this->gameGetter->searchForGamesAndCovers($searchText, $_GET["page"] * 16);
$numResults = count($searchResult);
$overallResults = $this->gameGetter->getNumberOfSearchResults($searchText);
echo "<h1> Got " . $overallResults . " Results </h1>";
echo "<div class='card-group justify-content-start'>";
for ($i = 0; $i < $numResults; $i++) {
    // TODO: actually handle null query case
    if (!isset($searchResult[$i])) {
        continue;
    }
    $game_name = $searchResult[$i][1];
    $game_id = $searchResult[$i][0];
    $img_src = $searchResult[$i][2];
    echo "<div class='col'>";
        echo "<div class='card h-100'>";
        if ($img_src) {
            echo "<a href='/gamerank/?command=detail&id=$game_id'>";
            echo "<img alt='$game_name Cover' src='$img_src' class='card-img-top'/>";
            echo "</a>";
        }
        echo "<div class='card-body'>";
            echo "<h5 class='card-title'> $game_name </h5>";
            echo "<a href='/gamerank/?command=detail&id=$game_id'> Details </a>";
        echo "</div> </div> </div>";
}
echo "</div>";
$pages = intdiv($overallResults, 16);
?>
<nav aria-label="..." id="page">
    <ul class="pagination pagination-lg" id="pagination-numbers">
        <?php
        for ($i = 1; $i <= $pages; $i++) {
            if ($_GET["page"] == $i) {
                echo "<li class='page-item active' aria-current='page'>";
                echo "<span class='page-link'>$i</span></li>";
            }
            else {
                echo "<li class='page-item'> <a class='page-link' href='?command=search&page=$i&searchText=$searchText'> $i </a></li>";
            }
        }
        ?>
    </ul>
</nav>


<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>
</html>