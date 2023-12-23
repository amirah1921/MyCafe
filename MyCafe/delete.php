<?php

session_start(); // starts the session
if ($_SESSION['user']) { // checks if the user is logged in
} else {
    header("location:index.php"); // redirects if user is not logged in
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $conn = mysqli_connect("localhost", "root", "", "first_db") or die(mysqli_connect_error()); // connect to server
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM list WHERE id='$id'");
    mysqli_close($conn);
    header("location:home.php");
}
?>
