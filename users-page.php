<?php
     session_start();
     
     include_once "php/load-user.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Users Page</title>
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="dark-style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="<?php echo $row["theme"] ?>">
     <div class="external-btn-container">
          <button class="external-btn settings-btn"><i class="fa-solid fa-gear"></i></button>
          <button class="external-btn notifications-btn"><i class="fa-solid fa-user-group"></i></button>
     </div>

     <div class="option-container">
          <ul class="option-list settings-option">
               <li class="option"><a href="settings/profile.php" target="_blank">Profile</a></li>
               <li class="option"><a href="settings/chats.php" target="_blank">Chats</a></li>
               <li class="option"><a href="settings/delete.php" target="_blank">Delete Account</a></li>
          </ul>
     </div>

     <div class="container user-container">
          <section class="user-info">
               <!-- Loads the image using the received image path -->
               <img src="php/images/<?php echo $img; ?>" alt="" id="user-img">
               <header class="details self">
                    <span class="info username"><?php echo $username; ?></span>
                    <span class="info status">Active</span>
               </header>
               <aside class="btn-options">
                    <button class="internal-btn settings-btn"><i class="fa-solid fa-gear"></i></button>
                    <button class="internal-btn notifications-btn"><i class="fa-solid fa-user-group"></i></button>
               </aside>
          </section>

          <form method="post" class="searchBar">
               <input type="text" name="search-term" placeholder="Search User" class="text-field search-field">
               <i class="fa-solid fa-search"></i>
          </form>

          <section class="option-bar">
               <p class="option" id="friends">Friends</p>
               <p class="option open" id="users">Users</p>
          </section>
          
          <section class="users-list" style="display: block;">
          </section>

          <section class="users-list friend-list" style="display: none;">
          </section>
     </div>

     <script type="module" src="js/users.js"></script>
     <script src="js/loads.js"></script>
     <script src="js/storageChangeListener.js"></script>
</body>
</html>