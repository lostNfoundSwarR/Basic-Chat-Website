<?php
// Enter your database details
$hostname = "localhost"; //Default: localhost
$password = "tender_feeling"; //If not set, leave empty
$username = "root"; //Default; root
$database = "chatDataBase"; //Enter your database name

try {
     $conn = mysqli_connect($hostname, $username, $password, $database);
}
catch(mysqli_sql_exception $e) {
     echo "Failed to connect to database";
} 