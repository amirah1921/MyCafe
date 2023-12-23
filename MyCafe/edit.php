<?php
session_start(); // starts the session
if ($_SESSION['user']) { // checks if the user is logged in
    $user = $_SESSION['user']; // assigns user value
    $id_exists = false;

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $_SESSION['id'] = $id;
        $id_exists = true;
        $conn = mysqli_connect("localhost", "root", "", "first_db") or die(mysqli_error($conn)); // Connect to server
        $query = mysqli_query($conn, "SELECT * FROM list WHERE id='$id'"); // SQL Query
        $count = mysqli_num_rows($query);
        if ($count > 0) {
            ?>
            <html>
                <head>
                    <title>My Cafe Hunting Website</title>
                </head>
                <body>
                    <h2>Home Page</h2>
                    <p>Hello <?php echo $user; ?>!</p> <!-- Displays user's name -->
                    <a href="logout.php">Click here to logout</a><br/><br/>
                    <a href="home.php">Return to Home page</a>
                    <h2 align="center">Currently Selected</h2>
                    <table border="1px" width="100%">
                        <tr>
                            <th>Id</th>
                            <th>Cafe</th>
                            <th>Post Time</th>
                            <th>Edit Time</th>
                            <th>Public Post</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td align='center'>" . $row['id'] . "</td>";
                            echo "<td align='center'>" . $row['details'] . "</td>";
                            echo "<td align='center'>" . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
                            echo "<td align='center'>" . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
                            echo "<td align='center'>" . $row['public'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                    <br/>
                    <?php
                    if ($id_exists) {
                        echo '
                <form action="edit.php" method="POST">
                    Enter new detail: <input type="text" name="details"/><br/>
                    Public post? <input type="checkbox" name="public[]" value="yes"/><br/>
                    <input type="submit" value="Update List"/>
                </form>
                ';
                    } else {
                        echo '<h2 align="center">There is no data to be edited.</h2>';
                    }
                    ?>
                </body>
            </html>
            <?php
        } else {
            $id_exists = false;
        }
    }
} else {
    header("location:index.php"); // redirects if user is not logged in
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "first_db") or die(mysqli_error($conn)); // Connect to server
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $public = "no";
    $id = $_SESSION['id'];
    $time = strftime("%X"); // time
    $date = strftime("%B %d, %Y"); // date

    foreach ($_POST['public'] as $list) {
        if ($list != null) {
            $public = "yes";
        }
    }
    mysqli_query($conn, "UPDATE list SET details='$details', public='$public', date_edited='$date', time_edited='$time' WHERE id='$id'");

    header("location: home.php");
}
?>
