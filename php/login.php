<?php
// This script handles the login

session_start();

include_once "database.php";


// Sanitizes input
$email = mysqli_escape_string($conn, 
                              filter_input(INPUT_POST, "email",
                              FILTER_SANITIZE_EMAIL));

$password = mysqli_escape_string($conn, 
                                   filter_input(INPUT_POST, "password",
                                   FILTER_SANITIZE_SPECIAL_CHARS));

if(!empty($email) && !empty($password)) {
     if(strlen($password) >= 8) {
          if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
               // Queries the password based on the input email
               $sql_query = "SELECT pass FROM users WHERE email = ?";

               try {
                    $stmt = $conn->prepare($sql_query);
                    $stmt->bind_param("s", $email);
                    
                    $stmt->execute();
                    
                    $result = $stmt->get_Result();

                    if($result->num_rows > 0 && password_verify($password,
                                             ($result->fetch_assoc())["pass"]))
                    {
                         // Selects the unique id of the user to use as a token
                         $sql_query = "SELECT unique_user_id FROM users WHERE email = ?";

                         $stmt = $conn->prepare($sql_query);
                         $stmt->bind_param("s", $email);
                         $stmt->execute();

                         $result = $stmt->get_result();
                         $row = $result->fetch_assoc();

                         $_SESSION["unique_id"] = $row["unique_user_id"];

                         echo "Success";
                    }
                    else {
                         echo "Invalid email or password";
                    }
               }
               catch(mysqli_sql_exception $e) {
                    echo "Something went wrong";
               }
          }
          else {
               echo "Invalid email!";
          }
     }
     else {
          echo "Password must be at least 8 characters";
     }
}
else {
     echo "Please fill in all the data";
}