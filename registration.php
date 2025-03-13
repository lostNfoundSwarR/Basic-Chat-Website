<?php
     session_start();

     // If already logged in, redirect to the users page
     if(isset($_SESSION["unique_id"])) {
          header("Location: users-page.php");
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Registration Form</title>
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
     <!-- Main container -->
     <div class="container registration-container">
          <div class="form-container">
               <!-- Sign-up form -->
               <form action="" method="post" class="form signUp" id="sign-up-form">
                    <h1 class="header">Sign-up</h1>

                    <input type="text" class="text-field username" placeholder="Username" name="username" maxlength="20" required>

                    <input type="text" class="text-field email" placeholder="Email" name="email" id="email" maxlength="225" required>
                    <i class="fa-solid fa-user"></i> 

                    <input type="text" class="text-field password" placeholder="Password" name="password" id="password" maxlength="15" required>
                    <i class="fa-solid fa-lock"></i>

                    <p class="text error-msg" id="error-msg-signup"></p>

                    <input type="submit" class="submit-btn" value="Sign-up" id="sign-up-btn">
               </form>

               |<!-- Login form -->
               <form action="" method="post" class="form login" id="login-form">
                    <h1 class="header">Login</h1>

                    <input type="text" class="text-field email" placeholder="Email" name="email" maxlength="225" required>
                    <i class="fa-solid fa-user"></i>

                    <input type="text" class="text-field password" placeholder="Password" name="password" maxlength="15" required>
                    <i class="fa-solid fa-lock"></i>

                    <p class="text error-msg" id="loginErrorMsg"></p>
                    <a href="#" id="forgotPass">Forgot Password?</a>

                    <input type="submit" class="submit-btn" value="Login" id="login-btn">
               </form>
          </div>

          <!-- Toggle container to toggle between the forms -->
          <div class="toggle-container">
               <div class="toggle-box right-toggle" id="login-toggle">
                    <h2>Already have an account?</h2>
                    <p>Login to your account</p>
                    <button class="toggle-btn" id="login-toggle-btn">Login</button>
               </div>

               <div class="toggle-box left-toggle" id="sign-up-toggle">
                    <h2>Don't have an account?</h2>
                    <p>Create a new account</p>
                    <button class="toggle-btn" id="sign-up-toggle-btn">Sign-up</button>
              </div>
          </div>
     </div>

     <script src="js/login.js"></script> <!-- For handling Login -->
     <script src="js/signUp.js"></script> <!-- For handling Sign-Up -->
     <script src="js/style-script.js"></script> <!-- For handling animations -->
</body>
</html>