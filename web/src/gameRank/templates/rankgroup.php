<!DOCTYPE html>
<html lang="en">
<!-- Sources used: https://stackoverflow.com/questions/37287153/how-to-get-images-in-bootstraps-card-to-be-the-same-height-width ,
https://www.w3schools.com/howto/howto_css_style_hr.asp , https://stackoverflow.com/questions/16475198/jquery-scrolltop-animation -->

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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
    <script>
        $(document).ready(() => {
            $("#updateMessage").hide();
            $(document).on('click', '.removeGameButton', function(event) {
                event.preventDefault();
                let form = $(this).closest('form');
                let formData = form.serialize();
                $.ajax({
                    type: "POST",
                    url: "?command=removeGame",
                    data: formData,
                    dataType: "json",
                    success: (response) => {
                        console.log(response);
                        let updateMessage = $("#updateMessage");
                        updateMessage.text(response.message);
                        if (response.success) {
                            updateMessage.removeClass("alert-danger");
                            updateMessage.addClass("alert-success");
                        } else {
                            updateMessage.removeClass("alert-success");
                            updateMessage.addClass("alert-danger");
                        }
                        updateMessage.show();
                        $('html, body').scrollTop(updateMessage.offset().top);
                        setTimeout( () => {
                            window.location.reload();
                        }, 1500)
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
<!-- Navbar -->
<?php include "/opt/src/gameRank/templates/navbar.php"; ?>
<!-- JS Remove / Update Order Alert Message -->
<div class="row">
    <div class="col-12">
        <div id="updateMessage" class="alert" role="alert"></div>
    </div>
</div>
<!-- Users -->
<h1 class="d-flex justify-content-center"><?= $_SESSION['currentGroup']['groupName'] ?>
    (<?= $_SESSION['currentGroup']['creatorName'] ?>'s Group)</h1>
<?php
$deadline = $_SESSION['currentGroup']['deadline'];
$deadlineDateTime = new DateTime($deadline);
$currentDateTime = new DateTime();
// var_dump($_SESSION);
?>
<h3 class="d-flex justify-content-center">Deadline: <?= $deadline ?></h3>
<?php if ($currentDateTime >= $deadlineDateTime): ?>
<div class="d-flex justify-content-center">
    <a href="?command=showRankGroup" tabindex="0" class="btn btn-primary" role="button" id="shutup">
        View Final Rankings
    </a>
</div>
<?php endif ?>
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
<!-- TODO: Maybe use JS to see if final rankings are available -->
<!-- TODO: JS "You have unsaved changes" message when drag and dropping rankings before save -->
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
            <button type="submit" class="btn btn-primary">Search for a game to add it!</button>
        </form>
    </div>
</div>
<hr class="border">
<?php $rankings = $_SESSION["currentGroup"]["rankings"]; ?>
<?php if (isset($rankings)): ?>
    <div class="card-group justify-content-start">
        <?php foreach ($rankings as $game): ?>
            <?php
            $name = $game["gamename"];
            $rank = $game["ranking"];
            $coverQuery = $this->db->query("SELECT cover FROM Games WHERE name = $1", $name);
            $cover = $coverQuery[0]["cover"];
            $gameidQuery = $this->db->query("SELECT gameid FROM Games WHERE name = $1", $name);
            $gameid = $gameidQuery[0]["gameid"];
            ?>
            <div class="col" id="<?= $gameid ?>">
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
                        <a style="color: #1c7cb8" href="/gamerank/?command=detail&id=<?= $gameid ?>"> Learn More </a>
                        <div>
                            <form class="removeGameForm">
                                <input type="hidden" name="gameId" value="<?= $gameid ?>">
                                <input type="hidden" name="groupId" value="<?= $_SESSION['currentGroup']['groupId'] ?>">
                                <input type="hidden" name="userId" value="<?= $_SESSION['user']['userId'] ?>">
                                <input type="hidden" name="ranking" value="<?= $rank ?>">
                                <button type="submit" class="btn btn-sm btn-danger removeGameButton"> Remove Game</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>
<?php if ($currentDateTime < $deadlineDateTime): ?>
<button id="saveOrder">Save Order</button>
<?php endif ?>
<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<?php if ($currentDateTime < $deadlineDateTime): ?>
<script>
    var sortable;
    document.addEventListener('DOMContentLoaded', (event) => {
        var el = document.querySelector('.card-group');
        sortable = Sortable.create(el, {
            animation: 150,
            ghostClass: 'blue-background-class',
            dataIdAttr: 'id',
            onEnd: function (evt) {
                var itemEl = evt.item;
            }
        });
    });
    document.getElementById('saveOrder').addEventListener('click', function () {
        var order = sortable.toArray();
        console.log(order);
        fetch('?command=saveOrder', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({order: order})
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                console.log('Success:', data);
                if (data.status === 'success') {
                    window.location.reload();
                } else {
                    alert('Failed to save order: ' + data.message);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });
</script>
<?php endif ?>
</body>

</html>