<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Include Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
    <link rel="stylesheet" href="styles/styles.css">
    <meta charset="utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1" >
    <meta name="author" content="Thomas Arnold, Matthew Haid" >
    <meta name="description" content="Game Rank" >
    <meta name="keywords" content="video games, games" >
    <title>Game Rank</title>
  </head>
  <body>
    <!-- Signup -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="text-center margins">
            <a href="index.html">
              <img src="images/controllerLogo.png" alt="Logo" style="width: 48px;">
            </a>
          </div>
          <h3 class="login-header text-center">Sign Up</h3>
          <div class="card">
            <div class="card-body">
              <form id="signup-form" method="post" action="?command=signup">
                <div class="row">
                  <div class="col-sm-6 mb-3">
                    <label for="inputFirstName" class="form-label white">First Name</label>
                    <input type="text" class="form-control" id="inputFirstName" name="firstName" required>
                  </div>
                  <div class="col-sm-6 mb-3">
                    <label for="inputLastName" class="form-label white">Last Name</label>
                    <input type="text" class="form-control" id="inputLastName" name="lastName" required>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="inputUsername" class="form-label white">Username</label>
                  <input type="text" class="form-control" id="inputUsername" name="userName" required>
                </div>
                <div class="mb-3">
                  <label for="inputEmail" class="form-label white">Email</label>
                  <input type="email" class="form-control" id="inputEmail" name="email" required>
                </div>
                <div class="mb-3">
                  <label for="inputPassword" class="form-label white">Password</label>
                  <input type="password" class="form-control" id="inputPassword" name="password" required>
                </div>
                <div class="mb-3">
                  <label for="inputConfirmPassword" class="form-label white">Confirm Password</label>
                  <input type="password" class="form-control" id="inputConfirmPassword" name="confirmPassword" required>
                </div>
                <div class="d-grid mb-2">
                  <button class="btn btn-primary mt-1" type="submit">Sign Up</button>
                </div>
              </form>
              <?=$message?>
            </div>
          </div>
          <div class="card account-prompt-card text-center">
            <div class="card-body">
              <p class="d-inline white">Already have an account?</p>
              <a class="sign-up-link d-inline" href="login.html">Sign In</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    

    <!-- Include Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
  </body>
</html>