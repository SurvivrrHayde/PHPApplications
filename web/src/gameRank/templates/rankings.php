<!DOCTYPE html>
<!-- Sources used: https://www.w3schools.com/cssref/pr_text_white-space.php-->
<html lang="en">

<head>
  <!-- Include Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="styles/rankings.css">
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
  <div class="d-flex justify-content-left">
    <a tabindex="0" class="btn btn-primary" href="?command=showRankGroup" role="button">
      Back to Group
    </a>
  </div>
  <div class="top-headers">
    <h1>Without further ado... here are Alex's Group's favorite games!</h1>
    <h1>Top 10</h1>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <!-- TODO: MAKE IT SO THAT ON BIG ENOUGH DISPLAYS, VOTERS ARE TO THE RIGHT. ON MOBILE THEY ARE BELOW. S-->
        <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/minecraft.jpg" class="img-fluid rounded-start" alt="Minecraft cover">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">1. Minecraft</h5>
                <p class="card-text">2011, Mojang Studios</p>
                <div class="col-md-5">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/drhouse.png" alt="User1" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      Alex: #1
                    </li>
                    <!-- TODO: #1 colored gold, #2 silver, #3 bronze -->
                    <li class="list-group-item d-flex justify-content-between align-items-center ishmael">
                      <img src="images/mario.png" alt="User2" class="rounded-circle" style="width: 40px; height: 40px">
                      Ishmael: #1
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/dodo.png" alt="User2" class="rounded-circle" style="width: 40px; height: 40px">
                      Vivian: #9
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/mother3.jpg" class="img-fluid rounded-start" alt="Minecraft cover">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">2. Mother 3</h5>
                <p class="card-text">2006, Nintendo</p>
                <div class="col-md-5">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/isabelle.png" alt="User1" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      Margaret: #1
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/dodo.png" alt="User2" class="rounded-circle" style="width: 40px; height: 40px">
                      Vivian: #2
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/undertale.jpg" class="img-fluid rounded-start" alt="Minecraft cover">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">3. Undertale</h5>
                <p class="card-text">2015, Toby Fox</p>
                <div class="col-md-5">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/drhouse.png" alt="User1" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      Alex: #3
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/masterchief.jpg" alt="User2" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      Lucas: #4
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/ultrakill.jpg" class="img-fluid rounded-start" alt="Minecraft cover">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">4. Ultrakill</h5>
                <p class="card-text">2020, New Blood Interactive</p>
                <div class="col-md-5">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/xboxlive.jpg" alt="User1" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      James: #1
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/masterchief.jpg" alt="User2" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      Lucas: #15
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/deltarune.jpg" class="img-fluid rounded-start" alt="Minecraft cover">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">5. Deltarune</h5>
                <p class="card-text">2018, Toby Fox</p>
                <div class="col-md-5">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/isabelle.png" alt="User1" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      Margaret: #3
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/drhouse.png" alt="User1" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      Alex: #8
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/finalfantasyxiv.jpg" class="img-fluid rounded-start" alt="Minecraft cover">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">6. Final Fantasy XIV Onlne</h5>
                <p class="card-text">2013, Square Enix</p>
                <div class="col-md-5">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/dodo.png" alt="User1" class="rounded-circle" style="width: 40px; height: 40px">
                      Vivian: #8
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center ishmael">
                      <img src="images/mario.png" alt="User2" class="rounded-circle" style="width: 40px; height: 40px">
                      Ishmael: #10
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/portal2.jpg" class="img-fluid rounded-start" alt="Minecraft cover">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">7. Portal 2</h5>
                <p class="card-text">2011, Valve</p>
                <div class="col-md-5">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/xboxlive.jpg" alt="User1" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      James: #12
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/dodo.png" alt="User2" class="rounded-circle" style="width: 40px; height: 40px">
                      Vivian: #12
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/isabelle.png" alt="User2" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      Margaret: #13
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/pokemonmysterydungeon.jpg" class="img-fluid rounded-start" alt="Minecraft cover">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">
                  8. Pokemon Mystery Dungeon: Explorers of Sky
                </h5>
                <p class="card-text">2009, Nintendo</p>
                <div class="col-md-5">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/drhouse.png" alt="User1" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      Alex: #6
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/dodo.png" alt="User2" class="rounded-circle" style="width: 40px; height: 40px">
                      Vivian: #20
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/brawl.jpg" class="img-fluid rounded-start" alt="Minecraft cover">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">9. Super Smash Bros. Brawl</h5>
                <p class="card-text">2008, Nintendo</p>
                <div class="col-md-5">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/isabelle.png" alt="User1" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      Margaret: #19
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/xboxlive.jpg" alt="User2" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      James: #20
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/dodo.png" alt="User2" class="rounded-circle" style="width: 40px; height: 40px">
                      Vivian: #21
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/drhouse.png" alt="User2" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      Alex: #24
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="images/sonicmania.jpg" class="img-fluid rounded-start" alt="Minecraft cover">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">10. Sonic Mania</h5>
                <p class="card-text">2017, Sega</p>
                <div class="col-md-5">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center ishmael">
                      <img src="images/mario.png" alt="User1" class="rounded-circle" style="width: 40px; height: 40px">
                      Ishmael: #3
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img src="images/masterchief.jpg" alt="User2" class="rounded-circle"
                        style="width: 40px; height: 40px">
                      Lucas: #28
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="d-flex justify-content-center">
      <a tabindex="1" class="btn btn-primary" href="#" role="button">See More</a>
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