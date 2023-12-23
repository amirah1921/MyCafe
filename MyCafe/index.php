<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <title>My Cafe Hunting Website</title>
    </head>
    <body>
        <?php
        echo "<p>Hello Sister!</p>";
        ?>
        <a href="login.php"> Click here to login</a><br/><br/>

        <a href="register.php"> Click here to register</a>
    </body>
    <br/>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "first_db") or die(mysqli_connect_error()); // Connect to server
    $query = mysqli_query($conn, "SELECT * FROM list WHERE public='yes'"); // SQL Query
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <title>My Cafe Hunting Websitee</title>
        </head>
        <body>
            <br/>
            <h2 align="center">List</h2>
            <table width="100%" border="1px">
                <tr>
                    <th>Cafe</th>
                    <th>Post Time</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo '<td align="center">' . $row['details'] . "</td>";
                    echo '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
    </html>