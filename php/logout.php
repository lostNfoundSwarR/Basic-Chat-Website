<?php
include_once "unload.php";

// Un-sets/removes the user token from the session
unset($_SESSION["unique_id"]);

echo "close";