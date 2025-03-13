<?php
     session_start();

     include_once "php/get-chat-user.php";
     include_once "php/get-theme.php";

     // Gets the sender and receiver user id
     $sender_unique_id = $_SESSION["unique_id"];
     $receiver_unique_id = $_GET["user_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Chat</title>
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="dark-style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="<?php echo $theme_row["theme"] ?>">
     <div class="container chat-container user-container">
          <section class="user-info">
               <a href="users-page.php"><i class="fa-solid fa-arrow-left"></i></a>
               <img src="php/images/<?php echo $img ?>" alt="">
               <header class="details self"> <!-- "self" doesn't mean "you" here, it means "them" -->
                    <span class="info username"><?php echo $row["username"] ?></span>
                    <span class="info status"><?php echo $row["stat"] ?></span>
               </header>
          </section>

          <section class="message-box">
          </section>

          <form action="" method="post" class="form send-msg">
               <!-- Stores the receiving and sending user id in hidden input fields for easy access -->
               <input type="text" name="incoming-msg-id" value="<?php echo $receiver_unique_id ?>" hidden>
               <input type="text" name="outgoing-msg-id" value="<?php echo $sender_unique_id ?>" hidden>
               <div class="msg-input">
                    <label class="image cover-btn">
                         <i class="fa-solid fa-image"></i>
                         <input type="file" class="file-chooser" name="img">
                    </label>

                    <input type="text" placeholder="Enter a message.." class="text-field" name="message">
                    <button type="submit" class="submit-btn send-btn"><i class="fa-duotone fa-solid fa-paper-plane"></i></button>
               </div>
          </form>
     </div>

     <script src="js/chat.js"></script>
     <script src="js/loads.js"></script>
     <script src="js/storageChangeListener.js"></script>
</body>
</html>