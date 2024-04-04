<!-- https://cs4640.cs.virginia.edu/ybn4aq/Game-Rank/ -->
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Include Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="styles/landingSpecifics.css">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Thomas Arnold, Matthew Haid">
  <meta name="description" content="Game Rank">
  <meta name="keywords" content="video games, games">
  <title>Game Rank - Landing</title>
</head>

<body>
  <!-- Navbar -->
  <div class="bg-image">
    <header class="p-3 mb-3 border-bottom navbar-dark bg-dark">
      <?php if (isset($_SESSION['user'])): ?>
      <div class="col-md-11 offset-md-1">
        <?php else: ?>
          <div class="col-md-10 offset-md-1">
            <?php endif; ?>
        <div class="d-flex flex-wrap align-items-center justify-content-between">
          <a href="?command=showHomepage"
            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="images/controllerLogo.png" alt="Logo" height="30" style="margin-right: 10px; margin-top: -10px;">
            <span class="fs-3 logo">Game Rank</span>
          </a>
          <div class="d-flex flex-wrap align-items-center">
            <?php
            if (isset($_SESSION['user'])) {
              echo '<ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0 mr-1">
            <li>
                <a href="?command=showHomepage" class="nav-link px-2 link-body-emphasis">Home</a>
            </li>
            <li>
                <a href="?command=showGroups" class="nav-link px-2 link-body-emphasis" id="fix-me">Your
                    Groups</a>
            </li>
            <li>
                <a href="?command=showJoinGroup" class="nav-link px-2 link-body-emphasis">Join Group</a>
            </li>
            <li>
                <a href="?command=showCreateGroup" class="nav-link px-2 link-body-emphasis">Create Group</a>
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
                <li><a class="dropdown-item" href="?command=showCreateGroup">Create Group</a></li>
                <li>
                    <a class="dropdown-item" href="?command=showGroups">Your Groups</a>
                </li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="?command=logout">Sign out</a></li>
            </ul>';
            } else {
              echo '<a class="btn btn-outline-primary me-2" href="?command=showLogin">Log In</a>';
              echo '<a class="btn btn-primary" href="?command=showSignup">Register</a>';
            }
            ?>
          </div>
        </div>
      </div>
    </header>



    <!-- Content in the middle but slightly to the left -->
    <div class="container h-100">
      <div class="row h-100 align-items-center text-position-adjust">
        <div class="col-10 col-md-8 col-lg-6"> <!-- Adjust the column sizes as needed -->
          <h1 class="text-whie">Welcome to Game Rank</h1>
          <p class="text-white">Your ultimate destination for video game rankings, reviews, and more.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content starts below the full-page image -->
  <main class="container mt-5 custom-container no-gaps">
    <!-- Section 1: What is Game Rank? -->
    <div class="row">
      <div class="col-12">
        <h2>What is Game Rank?</h2>
        <p>
          Game Rank is your ultimate destination for video game rankings, reviews, and more. Here, you can find in-depth
          analysis and comparison of various video games across different platforms. Game Rank also allows you to see
          specific details for games to get a more comprehensive understanding of them.
        </p>
      </div>
    </div>

    <!-- Section 2: Image on the left, Text on the right -->
    <div class="row align-items-center my-5 g-0">
      <div class="col-md-5">
        <img src="images/controller.jpg" alt="Controller Image" class="img-fluid img-cover">
      </div>
      <div class="col-md-7 p-0">
        <h3>Ranking Games with your Friends!</h3>
        <p>
          Dive into the ultimate gaming showdown with your friends on Game Rank! Our platform revolutionizes how you
          discover and rank your favorite video games in a fun, collaborative environment. Join hands with your gaming
          circle to create personalized game ranks, where each friend contributes their ratings. It's not just about
          listing your favorites; it's a dynamic journey to see which game emerges as the champion among your group.
        </p>
      </div>
    </div>

    <!-- Section 3: Image on the right, Text on the left -->
    <div class="row align-items-center my-5">
      <div class="col-md-5 order-md-2 p-0">
        <img src="images/stardewvalleysqaure.jpg" alt="Stardew Valley" class="img-fluid img-cover">
      </div>
      <div class="col-md-7 order-md-1 p-0">
        <h3>See In-Depth Details about your Favorite Games!</h3>
        <p>
          Unlock a treasure trove of information on Game Rank, where every pixel and storyline of your favorite video
          games is meticulously detailed. Our platform is designed for gamers who crave more than just surface-level
          knowledge. From the intricacies of game mechanics to immersive storylines, we've got you covered with
          comprehensive data, reviews, and general information spanning the entire spectrum of video games.
        </p>
      </div>
    </div>

    <!-- Section 4: Image on the left, Text on the right -->
    <div class="row align-items-center my-5">
      <div class="col-md-5 p-0">
        <img src="images/arcade.jpg" alt="Arcade Image" class="img-fluid img-cover">
      </div>
      <div class="col-md-7 p-0">
        <h3>See the Most Popular Games being Ranked!</h3>
        <p>
          At the heart of Game Rank lies a vibrant feature that taps into the collective wisdom and preferences of
          gaming communities worldwide: seeing the most popular games being ranked. This dynamic showcase isn't just
          about listing bestsellers; it's a real-time reflection of what games are captivating hearts and sparking
          discussions within groups.
        </p>
      </div>
    </div>
  </main>

  <footer class="bg-dark text-white mt-5">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-6">
          <h5>About Game Rank</h5>
          <p>Game Rank is the premier destination for game rankings, reviews, and in-depth game analysis. Discover your
            next favorite game with us.</p>
        </div>
        <div class="col-md-6">
          <ul class="list-unstyled d-flex flex-wrap justify-content-md-end">
            <li><a href="#" class="text-white">Home</a></li>
            <li><a href="#" class="text-white">About</a></li>
            <li><a href="#" class="text-white">Contact</a></li>
            <li><a href="#" class="text-white">Privacy Policy</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Include Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>