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
</head>

<body>
    <!-- Navbar -->
    <?php include "/opt/src/gameRank/templates/navbar.php"; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <h3 class="login-header text-center">Create Group</h3>
                <div class="card">
                    <div class="card-body">
                        <form id="login-form" method="post" action="?command=createGroup">
                            <div class="mb-3">
                                <label for="inputGroupName" class="form-label white">Group Name</label>
                                <input type="text" class="form-control" id="inputGroupName" name="groupName" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="inputDeadline" class="form-label white">Deadline</label>
                                <input type="date" class="form-control" id="inputDeadline" name="deadline">
                            </div>
                            <div class="d-grid mb-2">
                                <button class="btn btn-primary mt-1" type="submit">Create Group</button>
                            </div>
                        </form>
                        <?= $message ?>
                    </div>
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