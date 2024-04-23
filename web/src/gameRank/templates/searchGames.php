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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        #pagination-numbers {
            display: flex;
            flex-wrap: wrap;
        }
    </style>
    <script>
        $(document).ready(() => {
            let checkButton = $("#checkButton");
            $(".showGameGroups").submit(function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "?command=getGameGroupsSearch",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            for (let gameId in response.matches) {
                                for (let groupName in response.matches[gameId]) {
                                    let ranking = response.matches[gameId][groupName];
                                    // console.log(gameId, groupName, ranking);
                                    let paraBuild = ranking + ". " + groupName;
                                    let idSelector = "#"+gameId;
                                    let toAdd = $("<p>").text(paraBuild);
                                    $(idSelector).append(toAdd);
                                    checkButton.addClass("disabled");
                                }
                            }
                        }
                        checkButton.text(response.message);
                        setTimeout(() => {
                            checkButton.text("Show Games in Groups");
                        }, 2000);
                    },
                    error: (response) => {
                        console.log(response);
                    }
                });
            });
        });
    </script>
</head>
<body>
<?php include "navbar.php"; ?>
<?php
if (!isset($_GET["searchText"])) {
    $_GET["searchText"] = $_POST["searchText"];
}
$searchText = $_GET["searchText"];
$searchResult = $this->gameGetter->searchForGamesAndCovers($searchText, $_GET["page"] - 1);
$_SESSION["searchResult"] = $searchResult;
$numResults = count($searchResult);
$overallResults = $this->gameGetter->getNumberOfSearchResults($searchText);
echo "<h1> Got " . $overallResults . " Results </h1>";
echo "<div class='card-group justify-content-start gameGroup'>";
for ($i = 0; $i < $numResults; $i++) {
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
        echo "<div class='card-body' id='$game_id'>";
            echo "<h5 class='card-title'> $game_name </h5>";
            echo "<a href='/gamerank/?command=detail&id=$game_id'> Details </a>";
        echo "</div> </div> </div>";
}
echo "</div>";
$pages = intdiv($overallResults, 16);
?>
<div class="row">
    <div class="col-12 text-lg-center">
        <form class="showGameGroups">
            <input type="hidden" name="searchResult" value="<?= $searchResult ?>">
            <button type="submit" id="checkButton" class="btn btn-primary"> Show Games in Groups </button>
        </form>
    </div>
</div>
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