<?php
// Enter your database details
$hostname = ""; //Default: localhost
$password = ""; //If not set, leave empty
$username = ""; //Default; root
$database = ""; //Enter your database name

try {
     $conn = mysqli_connect($hostname, $username, $password, $database);
}
catch(mysqli_sql_exception $e) {
     echo "Failed to connect to database";
} 
