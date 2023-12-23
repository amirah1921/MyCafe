<?php

session_start();
$conn = new mysqli("localhost", "root", "", "first_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);
$bool = true;

$query = $conn->query("SELECT * FROM users WHERE username='$username'");
$exists = $query->num_rows;

$table_users = "";
$table_password = "";

if ($exists > 0) {
    while ($row = $query->fetch_assoc()) {
        $table_users = $row['username'];
        $table_password = $row['password'];
    }

    if (($username == $table_users) && ($password == $table_password)) {
        if ($password == $table_password) {
            $_SESSION['user'] = $username;
            header("location: home.php");
        }
    } else {
        echo '<script>alert("Incorrect Password!");</script>';
        echo '<script>window.location.assign("login.php");</script>';
    }
} else {
    echo '<script>alert("Incorrect username!");</script>';
    echo '<script>window.location.assign("login.php");</script>';
}

$conn->close();
?>
