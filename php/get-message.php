<?php
session_start();

include_once "database.php";

$outgoing_msg_id = mysqli_real_escape_string($conn, $_POST["outgoing-msg-id"]);
$incoming_msg_id = mysqli_real_escape_string($conn, $_POST["incoming-msg-id"]);

//Stores the output html
$output_html = "";

// Queries the messages based on similar message id/s
$sql_query = "SELECT * FROM messages
              LEFT JOIN users
              ON messages.outgoing_id = users.unique_user_id
              WHERE
              (outgoing_id = ? AND incoming_id = ?) OR
              (outgoing_id = ? AND incoming_id = ?) ORDER BY message_id";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("iiii", $outgoing_msg_id, $incoming_msg_id, $incoming_msg_id, $outgoing_msg_id);
     $stmt->execute();

     $result = $stmt->get_result();

     if($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
               $_SESSION["outgoing_id"] = $row["outgoing_id"];

               $img = (is_null($row["img"])) ? "default.jpg" : $row["img"];
               $type = $row["msg_type"];

               if($row["outgoing_id"] == $outgoing_msg_id) {
                    // Outputs different format of messages based on its type
                    if($type == "text") {
                         $output_html .= '<div class="message outgoing-msg">
                                             <div>' . $row["msg"] . '</div>
                                          </div>';
                    }
                    else {
                         $output_html .= '<a href="php/images/' . $row["msg"] . '" class="message outgoing-msg img">
                                             <img src="php/images/' . $row["msg"] . '" class="msg-img" alt="">
                                          </a>';
                    }
               }
               else {
                    if($type == "text") {
                         $output_html .= '<div class="message incoming-msg">
                                             <img src="php/images/' . $img . '" alt="">
                                             <div>' . $row["msg"] . '</div>
                                          </div>';
                    }
                    else {
                         $output_html .= '<a href="php/images/' . $row["msg"] . '" class="message incoming-msg img">
                                             <img src="php/images/' . $img . '" class="icon">
                                             <img src="php/images/' . $row["msg"] . '" class="msg-img" alt="">
                                          </a>';
                    }
               }
          }
     }
     else {
          $output_html = "<center>No messages</center>";
     }

     echo $output_html;
}
catch(mysqli_sql_exception $e) {
     echo "MySQL error";
}
