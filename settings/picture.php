<?php
     session_start();
     
     include_once "../php/load-user.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Change Profile Picture</title>
     <link rel="stylesheet" href="../style.css">
     <link rel="stylesheet" href="../dark-style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="<?php echo $row["theme"] ?>">
     <div class="container change-pic-container">
          <a href="profile.php"><i class="fa-solid fa-arrow-left"></i></a>

          <header>
               <h1 class="title">Change Profile Picture</h1>
          </header>
          
          <section class="main-content">
               <div class="image-container">
                    <img src="../php/images/<?php echo $img ?>" alt="">
               </div>

               <form method="post" enctype="multipart/form-data">
                    <label class="cover-btn">
                         <input type="file" class="file-chooser" name="image-file" accept="image/*">
                         Change Image
                    </label>
                    <span class="file-name">No file chosen</span>

                    <p class="error-msg" style="display: none;">Error</p>

                    <button type="submit" class="submit-btn">Change</button>
               </form>
          </section>
     </div>

     <script src="../js/profile-picture.js"></script>
     <script src="../js/storageChangeListener.js"></script>
</body>
</html>