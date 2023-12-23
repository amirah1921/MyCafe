<?php

session_start(); // Start the PHP session
session_destroy(); // Destroy all data registered to a session
header("location: index.php"); // Redirect the user to the index.php page
?>
