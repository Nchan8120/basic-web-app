<?php
include 'connecttodb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    $userid = $_POST['userid'];

    // If confirmation is received, proceed with deletion
    $delete_query = "DELETE FROM user WHERE userid='$userid'";
    $delete_result = mysqli_query($connection, $delete_query);

    if ($delete_result) {
        echo "<p>User deleted successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error deleting user: " . mysqli_error($connection) . "</p>";
    }
} elseif (isset($_POST['cancel'])) {
    echo "<p>Deletion cancelled.</p>";
}

mysqli_close($connection);
?>
