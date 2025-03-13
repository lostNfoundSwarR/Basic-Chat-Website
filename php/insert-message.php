<?php
session_start();

include_once "database.php";

$message = mysqli_escape_string($conn, filter_input(
                                 INPUT_POST, "message",
                                FILTER_SANITIZE_SPECIAL_CHARS));

$outgoing_msg_id = mysqli_real_escape_string($conn, $_POST["outgoing-msg-id"]);
$incoming_msg_id = mysqli_real_escape_string($conn, $_POST["incoming-msg-id"]);

// Inserts the message information
$sql_query = "INSERT INTO messages(outgoing_id, incoming_id, msg)
              VALUES(?, ?, ?)";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("iis", $outgoing_msg_id, $incoming_msg_id, $message);
     $stmt->execute();
}
catch(mysqli_sql_exception $e) {
     echo "MySQL error";
}
