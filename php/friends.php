<?php
session_start();

$outgoing_msg_id = $_SESSION["unique_id"];

if(empty($_SESSION["unique_id"])) {
     echo "empty";
     exit();
}
else {
     include_once "database.php";

     // Stores the html output
     $output_html = "";

     /*
          Queries for the users the their public data who have same friend-id and
          unique-user-id / vice-versa, and are not part of any archived chats
     */
     $sql_query = "SELECT * FROM friends
                   LEFT JOIN users
                   ON friends.friend_id = users.unique_user_id
                   OR friends.unique_id = users.unique_user_id
                   WHERE (friend_id AND unique_id) NOT IN
                   (SELECT archived_unique_id FROM archives WHERE unique_user_id = ?) AND
                   (unique_id = ? AND users.unique_user_id != ?) OR
                   (friend_id = ? AND users.unique_user_id != ?)";

     try {
          $stmt = $conn->prepare($sql_query);
          
          $stmt->bind_param("iiiii",$outgoing_msg_id,$outgoing_msg_id,$outgoing_msg_id,$outgoing_msg_id,$outgoing_msg_id);

          $stmt->execute();

          $result = $stmt->get_result();

          if($result->num_rows == 0) {
               $output_html .= "<center>No one is online</center>";
          }
          else if($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                    $img = (is_null($row["img"])) ? "default.jpg" : $row["img"];
                    $status_class = ($row["stat"] == "Active") ? "active" : "offline";

                    // Queries the latest message
                    $sql_query = "SELECT msg, msg_type FROM messages WHERE
                                  (incoming_id = ? OR outgoing_id = ?)
                                  AND
                                  (incoming_id = ? OR outgoing_id = ?)
                                  ORDER BY message_id DESC LIMIT 1";

                    $stmt = $conn->prepare($sql_query);
                    $stmt->bind_param("iiii", $row["friend_id"],$row["friend_id"], $row["unique_id"], $row["unique_id"]);
                    $stmt->execute();

                    $result2 = $stmt->get_result();

                    $row2 = $result2->fetch_assoc();

                    $last_msg = (is_null($row2) || is_null($row2["msg"])) ? "No messages" : $row2["msg"];

                    $msg_type = $row2["msg_type"] ?? "text";

                    // Checks the type of message and shows the detail
                    if($msg_type == "text") {
                         $last_msg = (strlen($last_msg) > 20) ? substr($last_msg, 0, 20) . "..." : $last_msg;
                    }
                    else if($msg_type == "image") {
                         $last_msg = "Image";
                    }

                    $output_html .= '<a href="chat.php?user_id=' . $row["unique_user_id"] . '" class="user">
                                        <header class="details other">
                                             <img src="php/images/' . $img . '" alt="">
                                             <div class="new-info">
                                                  <span class="info username">' . htmlspecialchars($row["username"]) . '</span>
                                                  <span class="last-msg">' . $last_msg . '</span>
                                             </div>
                                             <div class="content">
                                                  <i class="fa-solid fa-circle ' . $status_class . '"></i>
                                             </div>
                                        </header>
                                     </a>';
               }
          }

          echo $output_html;
     }
     catch(mysqli_sql_exception $e) {
          echo $e->getMessage();
     }
}