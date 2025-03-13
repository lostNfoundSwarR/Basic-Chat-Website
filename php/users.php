<?php
session_start();
include_once "database.php";

/* 
     Queries all of the users and their information
     who are not in your friend list
*/
$sql_query = "SELECT * FROM users
              WHERE unique_user_id NOT IN
              (SELECT friend_id FROM friends WHERE unique_id = ? OR friend_id = ?
              UNION
              SELECT unique_id FROM friends WHERE unique_id = ? OR friend_id = ?)
              AND unique_user_id != ?";

$output_html = "";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("iiiii", $_SESSION["unique_id"], $_SESSION["unique_id"], $_SESSION["unique_id"], $_SESSION["unique_id"], $_SESSION["unique_id"]);
     $stmt->execute();

     $result = $stmt->get_result();

     if($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
               $img = (is_null(value: $row["img"])) ? "default.jpg" : $row["img"];

               $sql_query = "SELECT COUNT(request_id) AS 'count' FROM requests
                             WHERE sender_id = ? AND receiver_id = ?";

               $stmt = $conn->prepare($sql_query);
               $stmt->bind_param("ii", $_SESSION["unique_id"], $row["unique_user_id"]);
               $stmt->execute();

               $count_result = $stmt->get_result();

               $count_row = $count_result->fetch_assoc();

               $class1 = ($count_row["count"] > 0) ? "hidden" : "main";
               $class2 = ($class1 == "hidden") ? "main" : "hidden";

               $output_html .= '<a class="user">
                                   <header class="details other">
                                        <img src="php/images/' . $img . '" alt="">
                                        <div class="new-info non-friend">
                                             <span class="info username">' . htmlspecialchars($row["username"]) . '</span>
                                        </div>

                                        <div class="content">
                                             <form method="post">
                                                  <input name="user-id" value="' . $row["unique_user_id"] . '" hidden>
                                                  <button class="submit-btn friend-btn ' . $class1 . '" name="friend-btn"><i class="fa-solid fa-plus"></i></button>
                                                  <button class="submit-btn cancel-btn ' . $class2 . '" name="cancel-btn"><i class="fa-solid fa-xmark"></i></button>
                                             </form>
                                        </div>
                                   </header>      
                                </a>';
          }
     }
     else {
          $output_html .= "<center>No users found</center>";
     }

     echo $output_html;
}
catch(mysqli_sql_exception $e) {
     echo $e;
}