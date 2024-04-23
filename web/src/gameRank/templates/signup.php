<!DOCTYPE html>
<html lang="en">

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
                    <form id="signup-form" method="post" action="?command=signup" onsubmit="return validateForm()">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="inputFirstName" class="form-label white">First Name</label>
                                <input type="text" class="form-control" id="inputFirstName" name="firstName">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="inputLastName" class="form-label white">Last Name</label>
                                <input type="text" class="form-control" id="inputLastName" name="lastName">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="inputUsername" class="form-label white">Username</label>
                            <input type="text" class="form-control" id="inputUsername" name="userName">
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label white">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label white">Password</label>
                            <input type="password" class="form-control" id="inputPassword" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="inputConfirmPassword" class="form-label white">Confirm Password</label>
                            <input type="password" class="form-control" id="inputConfirmPassword" name="confirmPassword">
                        </div>
                        <div class="d-grid mb-2">
                            <button class="btn btn-primary mt-1" type="submit">Sign Up</button>
                        </div>
                        <div id="error-message" style="color: red;"></div>
                    </form>
                    <?=$message?>
                </div>
            </div>
            <div class="card account-prompt-card text-center">
                <div class="card-body">
                    <p class="d-inline white">Already have an account?</p>
                    <a class="sign-up-link d-inline" href="?command=showLogin">Sign In</a>
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
  <script>
    function validateForm() {
      var firstName = document.getElementById("inputFirstName").value;
      var lastName = document.getElementById("inputLastName").value;
      var userName = document.getElementById("inputUsername").value;
      var email = document.getElementById("inputEmail").value;
      var password = document.getElementById("inputPassword").value;
      var confirmPassword = document.getElementById("inputConfirmPassword").value;
      var formData = {
        firstName: firstName,
        lastName: lastName,
        userName: userName,
        email: email,
        password: password,
        confirmPassword: confirmPassword
      };

      if (firstName.trim() === "" || lastName.trim() === "" || userName.trim() === "" || email.trim() === "" || password.trim() === "" || confirmPassword.trim() === ""){
        document.getElementById("error-message").textContent = "Please fill out all the fields.";
        return false;
      }

      if (!verifyEmail(email)) {
        document.getElementById("error-message").textContent = "The email input was not valid.";
        return false;
      }

      if (!verifyPassword(password)) {
        document.getElementById("error-message").textContent = "The password needs to be at least 5 characters and contain a capital letter, a symbol, and a number.";
        return false;
      }

      if (!confirmPasswordMatches(password, confirmPassword)) {
        document.getElementById("error-message").textContent = "Passwords do not match.";
        return false;
      }

      document.getElementById("error-message").textContent = "";
      return true;
    }

    function verifyEmail(email) {
      var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      return emailPattern.test(email);
    }

    function verifyPassword(password) {
      var passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*\W).{5,}$/;
      return passwordPattern.test(password);
    }

    function confirmPasswordMatches(password, confirmPassword) {
      return password === confirmPassword;
    }
  </script>
</body>

</html>