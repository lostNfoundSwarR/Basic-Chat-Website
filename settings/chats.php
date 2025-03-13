<?php
     session_start();

     if(empty($_SESSION["unique_id"])) {
          header("Location: ../registration.php");
     }

     include_once "../php/get-theme.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Chats</title>
     <link rel="stylesheet" href="../style.css">
     <link rel="stylesheet" href="../dark-style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="<?php echo $theme_row["theme"] ?>">
     <div class="container settings-container">
          <aside class="nav-bar">
               <a class="back-btn back-icon"><i class="fa-solid fa-arrow-left"></i></a>
               <ul class="nav-list">
                    <a href="profile.php" class="options"><li>Profile</li></a>
                    <a href="" class="options active"><li>Chats</li></a>
                    <a href="delete.php" class="options"><li>Delete Account</li></a>
               </ul>
          </aside>

          <section class="main-content setting-content chats-content">
               <div class="archive-chats">
                    <header>
                         <h1 class="title">Archive Chat</h1>
                    </header>

                    <form action="" method="post">
                         <input type="text" class="text-field" name="username" placeholder="Username" maxlength="20" required>
                         <br>
                         <button type="submit" class="submit-btn">Archive</button>
                    </form>
               </div>

               <br>
               <hr>
               <br>

               <div class="remove-archive">
                    <header>
                         <h1 class="title">Remove Archive</h1>
                    </header>

                    <form method="post">
                         <input type="text" class="text-field" name="username" placeholder="Username" maxlength="20" required>
                         <br>
                         <button type="submit" class="submit-btn">Remove</button>
                    </form>
                    <br>
                    <div class="remove-all">
                         <button type="submit" class="submit-btn">Remove All</button>
                    </div>
               </div>

               <br>
               <hr>
               <br>

               <div class="delete-chats single">
                    <header>
                         <h1 class="title">Delete Chat</h1>
                    </header>

                    <form action="" method="post">
                         <input type="text" class="text-field" name="username" placeholder="Username" maxlength="20" required>
                         <br>
                         <button type="submit" class="submit-btn">Delete</button>
                    </form>
               </div>

               <br>
               <hr>
               <br>

               <div class="delete-chats all">
                    <header>
                         <h1 class="title">Delete all Chats</h1>
                    </header>

                    <button type="submit" class="submit-btn">Delete</button>
               </div>
          </section>
     </div>

     <script src="../js/archive-user.js"></script>
     <script src="../js/delete-chat.js"></script>
     <script src="../js/storageChangeListener.js"></script>

     <script>
          const backBtn = document.querySelector("a.back-btn");

          backBtn.onclick = () => {window.close()};
     </script>
</body>
</html>