<?php
include_once('./includes/autoLoadClassesMain.inc.php');
$controller = new Controller();

$controller->redirectUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="css/index.css">
  <title>Login</title>
</head>
<body>
  <div class="container-body">
    <div class="left-content">
      <div class="login-details">
        <form action="includes/login.inc.php" method="POST" id="form-login">
          <h2>LOGIN</h2>
          <div class="login-details-content">
            <div class="username">
              <label for="username">Username: </label>
              <input type="text" id="username" name="username" class="elemInput" placeholder="Email">
            </div>
            <div class="password">
              <label for="password">Password: </label>
              <input type="password" id="password" name="password" class="elemInput" placeholder="*********">
            </div>
            <div class="remember-forgot">
              <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember"> Remember</label>
              </div>
              <div class="forgot">
                <label class="forgot-password">Forgot password?</label>
              </div>
            </div>
            <div class="submit">
              <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="validation">
              <label id="validation-message"></label>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="right-content">
      <img src="./images/dancing-robot.gif" alt="robot">
    </div>
    
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="js/index.js"></script>
</body>
</html>