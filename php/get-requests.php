<?php
session_start();

include_once "database.php";

$receiver_id = $_SESSION["unique_id"];

// Retrieves the requests and the sender information
$sql_query = "SELECT * FROM requests
              LEFT JOIN users
              ON requests.sender_id = users.unique_user_id
              WHERE receiver_id = ?";

$output_html = "";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("i", $receiver_id);
     $stmt->execute();

     $result = $stmt->get_result();

     if($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
               $img = (is_null($row["img"])) ? "default.jpg" : $row["img"];

               $output_html .= '<div class="request">
                                   <div class="details">
                                        <img src="php/images/' . $img . '" alt="">
                                        <span class="request-name">' . $row["username"] . '</span>
                                   </div>
                                   <form method="post" class="btn-container">
                                        <input type="text" name="user-id" value="' . $row["unique_user_id"] . '" hidden>
                                        <button class="deny-request submit-btn"><i class="fa-solid fa-x"></i></button>
                                        <button class="accept-request submit-btn"><i class="fa-solid fa-check"></i></button>
                                   </form>
                                </div>';
          }
     }
     else {
          $output_html = "<center>No requests</center>";
     }

     echo $output_html;
}
catch(mysqli_sql_exception $e) {
     echo $e;
}