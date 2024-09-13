<?php
// Nathan Chan 251151037
include 'connecttodb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_by = $_POST['order_by'];
    $order_type = $_POST['order_type'];

    $sql = "SELECT userid, firstname, lastname FROM user ORDER BY $order_by $order_type";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>User ID</th><th>First Name</th><th>Last Name</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["userid"] . "</td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td><form action='userdetails.php' method='get'>
                        <input type='hidden' name='userid' value='" . $row["userid"] . "'>
                        <input type='submit' value='Details'>
                      </form></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
        mysqli_free_result($result);
    } else {
        echo "Error executing query: " . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>

