<!DOCTYPE html>
<html lang="en">
<!-- Sources used: https://stackoverflow.com/questions/37287153/how-to-get-images-in-bootstraps-card-to-be-the-same-height-width , https://www.w3schools.com/howto/howto_css_style_hr.asp-->

<head>
    <!-- Include Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/rankgroup.css">
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
    <header class="p-3 mb-3 border-bottom navbar-dark bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <a href="?command=showHomepage"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <span class="fs-3 logo">Game Rank</span>
                </a>

                <!-- Assuming you meant to have a visual or structural break here, but in a flex layout, this is managed differently. -->

                <div class="d-flex flex-wrap align-items-center">
                    <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0 mr-1">
                        <li>
                            <a href="?command=showHomepage" class="nav-link px-2 link-body-emphasis">Home</a>
                        </li>
                        <li>
                            <a href="?command=showGroups" class="nav-link px-2 link-body-emphasis" id="fix-me">Your
                                Groups</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-2 link-body-emphasis">Join Group</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-2 link-body-emphasis">Create Group</a>
                        </li>
                    </ul>

                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                        <input type="search" class="form-control" placeholder="Search Games..." aria-label="Search">
                    </form>

                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="images/mario.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu text-small">
                            <li><a class="dropdown-item" href="#">Create Group</a></li>
                            <li>
                                <a class="dropdown-item" href="?command=showGroups">Your Groups</a>
                            </li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="?command=logout">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

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
              <?=$message?>
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