<?php
// Nathan Chan 251151037
include 'connecttodb.php';

// Check if user ID is provided in the URL
if(isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    // Query to fetch user details
    $user_query = "SELECT * FROM user WHERE userid='$userid'";
    $user_result = mysqli_query($connection, $user_query);

    // Check if user exists
    if(mysqli_num_rows($user_result) == 1) {
        $user = mysqli_fetch_assoc($user_result);

        // Display user details
        echo "<h1>User Details</h1>";
        echo "<p>User ID: " . $user['userid'] . "</p>";
        echo "<p>First Name: " . $user['firstname'] . "</p>";
        echo "<p>Last Name: " . $user['lastname'] . "</p>";
        // Display user image if available
        if (!empty($user['image'])) {
            echo "<img src='" . $user['image'] . "' alt='User Image'>";
        } else {
            echo "<img src='https://www.seekpng.com/png/detail/365-3651600_default-portrait-image-generic-profile.png' alt='User Image'>"; 
       }

        // Query to fetch users followed by the selected user
        $following_query = "SELECT u.userid, u.firstname, u.lastname FROM follows f JOIN user u ON f.following = u.userid WHERE f.follower='$userid'";
        $following_result = mysqli_query($connection, $following_query);
        
        // Display users followed by the selected user
        echo "<h2>Following</h2>";
        if(mysqli_num_rows($following_result) > 0) {
            echo "<ul>";
            while($following = mysqli_fetch_assoc($following_result)) {
                echo "<li>" . $following['userid'] . " - " . $following['firstname'] . " " . $following['lastname'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>This user is not following anyone.</p>";
        }

        // Query to fetch users following the selected user
        $followers_query = "SELECT u.userid, u.firstname, u.lastname FROM follows f JOIN user u ON f.follower = u.userid WHERE f.following='$userid'";
        $followers_result = mysqli_query($connection, $followers_query);
        
        // Display users following the selected user
        echo "<h2>Followers</h2>";
        if(mysqli_num_rows($followers_result) > 0) {
            echo "<ul>";
            while($follower = mysqli_fetch_assoc($followers_result)) {
                echo "<li>" . $follower['userid'] . " - " . $follower['firstname'] . " " . $follower['lastname'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>This user has no followers.</p>";
        }
    } else {
        echo "<p>User not found.</p>";
    }
} else {
    echo "<p>User ID not provided.</p>";
}

mysqli_close($connection);
?>

