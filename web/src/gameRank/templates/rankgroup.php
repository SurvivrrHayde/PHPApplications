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
  <?php include "/opt/src/gameRank/templates/navbar.php"; ?>
  <!-- Users -->
  <h1>Alex's Rank Group</h1>
  <h3>The final rankings are ready!</h3>
  <div class="d-flex justify-content-center">
    <a href="?command=showRankGroup" tabindex="0" class="btn btn-primary" role="button" id="shutup">
      View Final Rankings
    </a>
  </div>
  <hr class="border">
  <div class="container text-center">
    <h2>Users in this group:</h2>
    <ul class="user-list">
      <li>
        <img src="images/drhouse.png" alt="Alex's profile picture" class="rounded-circle" width="30" height="30">
        Alex (creator)
      </li>
      <li>
        <img src="images/xboxlive.jpg" alt="James's profile picture" class="rounded-circle" width="30" height="30">
        James (admin)
      </li>
      <li>
        <img src="images/isabelle.png" alt="Margaret's profile picture" class="rounded-circle" width="30" height="30">
        Margaret
      </li>
      <li>
        <img src="images/mario.png" alt="Ishmael's profile picture" class="rounded-circle" width="30" height="30">
        Ishmael
      </li>
      <li>
        <img src="images/masterchief.jpg" alt="Lucas's profile picture" class="rounded-circle" width="30" height="30">
        Lucas
      </li>
      <li>
        <img src="images/dodo.png" alt="Vivian's profile picture" class="rounded-circle" width="30" height="30">
        Vivian
      </li>
    </ul>
  </div>
  <!-- Your Rankings -->
  <!-- TODO: make all cards float to the left, don't space them out automatically -->
  <h1>Your Rankings:</h1>
  <hr class="border">
  <div class="card-group justify-content-start">
    <div class="col">
      <div class="card h-100">
        <img src="images/minecraft.jpg" class="card-img-top" alt="Minecraft cover">
        <div class="card-body">
          <h5 class="card-title">1. Minecraft</h5>
          <p class="card-text">2011, Mojang Studios</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="images/dayz.jpg" class="card-img-top" alt="DayZ cover">
        <div class="card-body">
          <h5 class="card-title">2. DayZ</h5>
          <p class="card-text">2018, Bohemia Interactive Studios</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="images/sonicmania.jpg" class="card-img-top" alt="Sonic Mania cover">
        <div class="card-body">
          <h5 class="card-title">3. Sonic Mania</h5>
          <p class="card-text">2017, Sega</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="images/stardewvalley.jpg" class="card-img-top" alt="Stardew Valley cover">
        <div class="card-body">
          <h5 class="card-title">4. Stardew Valley</h5>
          <p class="card-text">2016, Concerned Ape</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="images/persona3reload.jpg" class="card-img-top" alt="Persona 3 Reload cover">
        <div class="card-body">
          <h5 class="card-title">5. Persona 3 Reload</h5>
          <p class="card-text">2024, Atlus</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="images/eldenring.jpg" class="card-img-top" alt="Elden Ring cover">
        <div class="card-body">
          <h5 class="card-title">6. Elden Ring</h5>
          <p class="card-text">2022, From Software</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="images/hogwartslegacy.jpg" class="card-img-top" alt="Hogwarts Legacy cover">
        <div class="card-body">
          <h5 class="card-title">7. Hogwarts Legacy</h5>
          <p class="card-text">2023, Avalanche Software</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="images/katamaridamacy.jpg" class="card-img-top" alt="Katamari Damacy cover">
        <div class="card-body">
          <h5 class="card-title">8. Katamari Damacy</h5>
          <p class="card-text">2004, Namco</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="images/supermariobros3.jpg" class="card-img-top" alt="Super Mario Bros. 3 cover">
        <div class="card-body">
          <h5 class="card-title">9. Super Mario Bros. 3</h5>
          <p class="card-text">1988, Nintendo</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="images/finalfantasyxiv.jpg" class="card-img-top" alt="Celeste cover">
        <div class="card-body">
          <h5 class="card-title">10. Final Fantasy XIV Online</h5>
          <p class="card-text">2013, Square Enix</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="images/baldursgate3.jpg" class="card-img-top" alt="Baldur's Gate 3 cover">
        <div class="card-body">
          <h5 class="card-title">11. Baldur's Gate 3</h5>
          <p class="card-text">2020, Larian Studios</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="images/hollowknight.jpg" class="card-img-top" alt="Hollow Knight cover">
        <div class="card-body">
          <h5 class="card-title">12. Hollow Knight</h5>
          <p class="card-text">2017, Team Cherry</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Change Rankings -->
  <div class="d-flex justify-content-center">
    <button type="button" class="btn btn-primary">
      Change Rankings
    </button>
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