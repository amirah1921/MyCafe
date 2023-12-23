<html>
    <head>
        <title>My Cafe Hunting Website</title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="index.php">Click here to go back<br/><br/></a>
        <form action="register.php" method="post">
            Enter Username: <input type="text" name="username" required="required" /> <br/>
            Enter Password: <input type="password" name="password" required="required" /> <br/>
            <input type="submit" value="Register"/>
        </form>
    </body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "first_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $bool = true;

    $query = $conn->query("SELECT * FROM users");
    while ($row = $query->fetch_assoc()) {
        $table_users = $row['username'];
        if ($username == $table_users) {
            $bool = false;
            echo '<script>alert("Username has been taken!");</script>';
            echo '<script>window.location.assign("register.php");</script>';
        }
    }

    if ($bool) {
        $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
        echo '<script>alert("Successfully Registered!");</script>';
        echo '<script>window.location.assign("register.php");</script>';
    }

    $conn->close();
}
?>
