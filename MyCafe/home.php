<html>
    <head>
        <title>My Cafe Hunting Website</title>
    </head>
    <?php
    session_start(); // starts the session
    if ($_SESSION['user']) { // checks if the user is logged in
    } else {
        header("location: index.php"); // redirects if the user is not logged in
    }
    $user = $_SESSION['user']; // assigns the user value
    ?>
    <body>
        <h2>Home Page</h2>
        <p>Hello <?php echo "$user"; ?>!</p> <!-- Displays the user's name -->
        <a href="logout.php">Click here to logout</a><br/><br/>
        <form action="add.php" method="POST">
            Add more cafe to the list: <input type="text" name="details" /> <br/><br/>
            Soon Going Cafe? <input type="checkbox" name="public[]" value="yes" /> <br/><br/>
            <input type="submit" value="Add to the list"/>
        </form>
        <h2 align="center">My list</h2>
        <table border="1px" width="100%">
            <tr>
                <th>Id</th>
                <th>Cafe</th>
                <th>Post Time</th>
                <th>Edit Time</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Public Post</th>
            </tr>
            <?php
            $conn = new mysqli("localhost", "root", "", "first_db");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $query = $conn->query("SELECT * FROM list");

            while ($row = $query->fetch_assoc()) {
                echo "<tr>";
                echo "<td align='center'>" . $row['id'] . "</td>";
                echo "<td align='center'>" . $row['details'] . "</td>";
                echo "<td align='center'>" . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
                echo "<td align='center'>" . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
                echo "<td align='center'><a href='edit.php?id=" . $row['id'] . "'>Edit</a></td>";
                echo '<td align="center"><a href="#" onclick="myFunction(' . $row['id'] . ')">delete</a>';
                echo "<td align='center'>" . $row['public'] . "</td>";
                echo "</tr>";
            }

            $conn->close();
            ?>
        </table>
        <script>
            function myFunction(id)
            {
                var r = confirm("Are you sure you want to delete this record?");
                if (r == true)
                {
                    window.location.assign("delete.php?id=" + id);
                }
            }
        </script>
    </body>
</html>
