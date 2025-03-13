<?php
     session_start();

     if(empty($_SESSION["unique_id"])) {
          header("Location: ../registration.php");
     }

     include_once "../php/get-info.php";
     include_once "../php/get-theme.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Settings</title>
     <link rel="stylesheet" href="../style.css">
     <link rel="stylesheet" href="../dark-style.css">  
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="<?php echo $theme_row["theme"] ?>">
     <div class="container settings-container">
          <aside class="nav-bar">
               <a class="back-btn back-icon"><i class="fa-solid fa-arrow-left"></i></a>
               <ul class="nav-list">
                    <a href="" class="options active"><li>Profile</li></a>
                    <a href="chats.php" class="options"><li>Chats</li></a>
                    <a href="delete.php" class="options"><li>Delete Account</li></a>
               </ul>
          </aside>

          <section class="main-content setting-content profile-content">
               <div class="details">
                    <img src="images/photo.jpg" class="icon" alt="">
                    <img src="../php/images/<?php echo $img ?>" class="active" alt="">
                    <span class="info username"><?php echo $username ?></span>
               </div>

               <br>
               <br>

               <div class="details credentials-details">
                    <div class="info credentials-info email-info">
                         <span class="title">Email:</span>
                         <span><?php echo $row["email"] ?></span>
                    </div>

                    <div class="info credentials-info friends-count">
                         <span class="title">Friends:</span>
                         <span class="sec-icon"><i class="fa-solid fa-user-group">: </i></span>
                         <span><?php echo $row_count["count"] ?></span>
                    </div>
               </div>

               <br>
               <br>

               <div class="appearance-box">
                    <header>
                         <h1 class="title">Theme</h1>
                    </header>
                    <form method="post" class="theme-options">
                         <div class="light theme">
                              <input type="radio" name="options" value="light" required>
                              Light
                         </div>

                         <div class="dark theme">
                              <input type="radio" name="options" value="dark" required>
                              Dark
                         </div>

                         <button type="submit" class="submit-btn">Save</button>
                    </form>
               </div>

               <br>
               <br>


               <button type="submit" class="submit-btn logout-btn">Log out</button>
          </section>
     </div>
     <script src="../js/set-theme.js"></script>
     <script src="../js/logout.js"></script>
     <script src="../js/storageChangeListener.js"></script>

     <script>
          const backBtn = document.querySelector("a.back-btn");
          const img = document.querySelector("img.active");

          img.onclick = () => {
               window.open("picture.php", "_self");
          };

          backBtn.onclick = () => {window.close()};
     </script>
</body>
</html>