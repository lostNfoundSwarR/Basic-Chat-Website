<?php
session_start();

include_once "database.php";

$search_term = mysqli_real_escape_string($conn, filter_input(
                                                  INPUT_POST, "search-term",
                                                  FILTER_SANITIZE_SPECIAL_CHARS
));

$search_factor = "%" . $search_term . "%";

/* 
     Queries for the users the their public data who have same friend-id and
     unique-user-id / vice-versa, and are not part of any archived chats
     and their username is similar to the input text
*/
$sql_query = "SELECT * FROM friends
              LEFT JOIN users
              ON friends.friend_id = users.unique_user_id
              OR friends.unique_id = users.unique_user_id
              WHERE users.username LIKE ? AND
              (friend_id AND unique_id) NOT IN
              (SELECT archived_unique_id FROM archives WHERE unique_user_id = ?) AND
              (unique_id = ? OR friend_id = ?) AND
              users.unique_user_id != ?";

// Stores the html output
$output_html = "";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("siiii", $search_factor,  $_SESSION["unique_id"], $_SESSION["unique_id"], $_SESSION["unique_id"], $_SESSION["unique_id"]);
     $stmt->execute();

     $result = $stmt->get_result();

     if($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
               $img = (is_null($row["img"])) ? "default.jpg" : $row["img"];
               $status_class = ($row["stat"] == "Active") ? "active" : "offline";

               $output_html .= '<a href="chat.php?user_id=' . $row["unique_user_id"] . '" class="user">
                                   <header class="details other">
                                        <img src="php/images/' . $img . '" alt="">
                                        <div class="new-info">
                                             <span class="info username">' . htmlspecialchars($row["username"]) . '</span>
                                        </div>
                                        <div class="content">
                                             <i class="fa-solid fa-circle ' . $status_class . '"></i>
                                        </div>
                                   </header>
                                   </a>';
          }
     }
     else {
          $output_html = "<center>No users found</center>";
     }

     echo $output_html;
}
catch(mysqli_sql_exception $e) {
     echo $e->getMessage();
}