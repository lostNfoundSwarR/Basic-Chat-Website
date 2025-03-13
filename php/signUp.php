<?php
// This script handles signup

session_start();

include_once "database.php";

//Filtering input for data insertion safety and illegal characters
$username = mysqli_escape_string($conn, 
                                   filter_input(INPUT_POST, "username", 
                                   FILTER_SANITIZE_SPECIAL_CHARS));

$email = mysqli_escape_string($conn, 
filter_input(INPUT_POST, "email", 
FILTER_SANITIZE_EMAIL));

$password = mysqli_escape_string($conn, 
filter_input(INPUT_POST, "password", 
FILTER_SANITIZE_SPECIAL_CHARS));

if(!empty($username) && !empty($email) && !empty($password)) {
     if(strlen($password) >= 8) {
          if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $hash_password = password_hash($password, PASSWORD_BCRYPT);
               // Generates a random unique id
               $unique_id = rand(time(),10000000);

               $status = "Active";

               // Inserts the user information
               $sql_query = "INSERT INTO users(unique_user_id, username, email, pass, stat)
                              VALUES (?, ?, ?, ?, ?)";

               try {
                    $stmt = $conn->prepare($sql_query);
                    $stmt->bind_param("issss", $unique_id, $username, $email, $hash_password, $status);
                    $stmt->execute();

                    // Retrieves the user id to use as a token
                    $sql_query = "SELECT unique_user_id FROM users WHERE email = ?";

                    $stmt = $conn->prepare($sql_query);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();

                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();

                    // Sets the user token
                    $_SESSION["unique_id"] = $row["unique_user_id"];

                    echo "Success";
               }
               catch(mysqli_sql_exception $e) {
                    // 1062 is the code for "Duplicate Entry" in MySQL
                    if(($e->getCode()) == 1062) {
                         $error_message = $e->getMessage();

                         $pos1 = strpos($error_message, "for key '");

                         $start_pos = ($pos1 + (strlen("for key '") - 1)) + 1;

                         $column_name = substr($error_message, $start_pos, strlen($error_message));

                         // There `'` in the output
                         if($column_name == "users.username" . "'") {
                              echo "Username already exists";
                         }
                         else {
                              echo "Email already exists";
                         }
                    }
                    else {
                         echo "Something went wrong..";
                    }
               }
          }
          else {
               echo "$email -  is an invalid email";
          }
     }
     else {
          echo "Password must contain at least 8 characters with no invalid characters!";
     }
}
else {
     echo "Please enter all data!";
}