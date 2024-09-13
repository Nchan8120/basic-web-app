<?php
// Nathan Chan 251151037
include 'connecttodb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userid = $_POST['userid'];

    // Check if the user exists
    $check_query = "SELECT * FROM user WHERE userid='$userid'";
    $check_result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($check_result) == 0) {
        echo "<p style='color: red;'>Error: User does not exist.</p>";
    } else {
        $follow_check_query = "SELECT * FROM follows WHERE follower='$userid' OR following='$userid'";
        $follow_check_result = mysqli_query($connection, $follow_check_query);

        if (mysqli_num_rows($follow_check_result) > 0) {
            echo "<p style='color: red;'>Error: Cannot delete user. This user is followed by or following other users.</p>";
        } else {
            // Display confirmation message and form for deletion
            echo "<p>Are you sure you want to delete this user?</p>";
            echo "<form action='confirmdelete.php' method='post'>";
            echo "<input type='hidden' name='userid' value='".$userid."'>";
            echo "<input type='submit' name='confirm' value='Yes'>";
            echo "<input type='submit' name='cancel' value='No'>";
            echo "</form>";

	   
       }
    }
}

mysqli_close($connection);
?>

<form action="deleteuser.php" method="post">
    <label for="userid">User ID:</label>
    <input type="text" id="userid" name="userid" required>
    <input type="submit" name="submit" value="Delete User">
</form>
