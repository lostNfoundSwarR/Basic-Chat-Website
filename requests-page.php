<?php
     session_start();

     include_once "php/get-theme.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Requests Page</title>
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="dark-style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="<?php echo $theme_row["theme"] ?>">
     <div class="container requests-container">
          <section class="page-info">
               <a class="back-btn" href=""><i class="fa-solid fa-arrow-left"></i></a>
               
               <div class="info-text">
                    <h2>Friend Requests</h2>
               </div>
          </section>

          <section class="requests-list">
          </section>
     </div>
     <script src="js/loads.js"></script>
     <script src="js/storageChangeListener.js"></script>
     <script type="module" src="js/requests.js"></script>

     <script>
          const backBtn = document.querySelector("a.back-btn");

          backBtn.onclick = () => {window.close()};
     </script>
</body>
</html>