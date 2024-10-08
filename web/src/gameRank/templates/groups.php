<!DOCTYPE html>
<html lang="en">
<!-- Sources used: https://stackoverflow.com/questions/37287153/how-to-get-images-in-bootstraps-card-to-be-the-same-height-width ,
https://www.w3schools.com/howto/howto_css_style_hr.asp, https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/localeCompare-->

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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(() => {
            let groups = <?= json_encode($_SESSION['groups']); ?>;
            let sortByDeadline = $("#sortByDeadline");
            let sortByName = $("#sortByName");
            sortByDeadline.click(() => {
                groups.sort((x, y) => new Date(x.deadline) - new Date(y.deadline));
                displayGroups(groups);
            });

            sortByName.click(() => {
                groups.sort((x, y) => x.name.localeCompare(y.name));
                displayGroups(groups);
            });

            function displayGroups(groups) {
                $(".groupStart").empty();
                groups.forEach(group => {
                    $(".groupStart").append(`
                <div class="col-md-4 mb-4">
                    <form action="?command=groupClicked" method="POST" style="height: 100%;">
                        <div class="card" id="${group.groupid}" style="position: relative;">
                            <div class="card-body">
                                <h5 class="card-title">${group.name}</h5>
                                <p class="card-text">Creator's Username: ${group.creatorname}</p>
                                <p class="card-text">Deadline: ${group.deadline}</p>
                                <input type="hidden" name="command" value="groupClicked">
                                <input type="hidden" name="groupName" value="${group.name}">
                                <button type="submit" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0"></button>
                            </div>
                        </div>
                    </form>
                </div>
            `);
                });
            }
            displayGroups(groups);
        })


    </script>
</head>

<body>
<!-- Navbar -->
<?php include "/opt/src/gameRank/templates/navbar.php"; ?>
<div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                Sort By...
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" id="sortByDeadline">Deadline</a></li>
                <li><a class="dropdown-item" id="sortByName"> Name </a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container py-5">
    <div class="row groupStart">
        <?php if (isset($_SESSION['groups']) && count($_SESSION['groups']) > 0): ?>
            <?php foreach ($_SESSION['groups'] as $group): ?>
                <div class="col-md-4 mb-4">
                    <form action="?command=groupClicked" method="POST" style="height: 100%;">
                        <div class="card" id="<?= $group['groupid'] ?>" style="position; relative;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= $group['name'] ?>
                                </h5>
                                <p class="card-text">Creator's Username:
                                    <?= $group['creatorname'] ?>
                                </p>
                                <p class="card-text">Deadline:
                                    <?= $group['deadline'] ?>
                                </p>
                                <input type="hidden" name="command" value="groupClicked">
                                <input type="hidden" name="groupName" value="<?= $group['name'] ?>">
                                <button type="submit"
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0"></button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Join or create a group!</p>
        <?php endif; ?>
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