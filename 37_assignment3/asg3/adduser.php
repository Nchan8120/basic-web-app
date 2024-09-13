<?php
//Nathan Chan 251151037
include 'connecttodb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userid = $_POST['userid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $image = $_POST['image'];
    $following = isset($_POST['following']) ? $_POST['following'] : array();

    // Check if the user ID is unique
    $check_query = "SELECT userid FROM user WHERE userid='$userid'";
    $check_result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<p style='color: red;'>Error: User ID already in use. Please choose a different User ID.</p>";
    } else {
        // Insert the new user into the database
        $insert_query = "INSERT INTO user (userid, firstname, lastname, image) VALUES ('$userid', '$firstname', '$lastname', '$image')";
        $insert_result = mysqli_query($connection, $insert_query);

        if ($insert_result) {
            echo "<p>New user added successfully!</p>";
            
            // Insert user's following relationships
            foreach ($following as $followed_user_id) {
                $follow_query = "INSERT INTO follows (follower, following) VALUES ('$userid', '$followed_user_id')";
                mysqli_query($connection, $follow_query);
            }
        } else {
            echo "<p style='color: red;'>Error adding user: " . mysqli_error($connection) . "</p>";
        }
    }

}
?>

<h3>Enter User Details</h3>
<form action="adduser.php" method="post">
    User ID: <input type="text" name="userid" required><br>
    First Name: <input type="text" name="firstname" required><br>
    Last Name: <input type="text" name="lastname" required><br>
    Image URL: <input type="text" name="image"><br>
    Users to Follow (select multiple):<br>
    <?php
    $sql = "SELECT userid, firstname, lastname FROM user";
    $result = mysqli_query($connection, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<input type='checkbox' name='following[]' value='" . $row['userid'] . "'> " . $row['firstname'] . " " . $row['lastname'] . "<br>";
        }
    }
    ?>
    <br>
    <input type="submit" name="submit" value="Add User">
</form>
