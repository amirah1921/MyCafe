<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("location: index.php");
}

$conn = new mysqli("localhost", "root", "", "first_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $time = strftime("%X"); // time
    $date = strftime("%B %d, %Y"); // date
    $decision = "no";

    foreach ($_POST['public'] as $each_check) {
        if ($each_check != null) {
            $decision = "yes";
        }
    }

    $query = "INSERT INTO list (details, date_posted, time_posted, public)
                  VALUES ('$details', '$date', '$time', '$decision')";

    if ($conn->query($query) === TRUE) {
        header("location: home.php");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    header("location: home.php");
}
?>
