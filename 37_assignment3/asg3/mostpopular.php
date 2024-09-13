<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Popular Users</title>
</head>
<body>
    <h1>Most Popular Users</h1>

    <?php
    // Include database connection file
    include 'connecttodb.php';

    // Query to get the top 3 users with the highest number of followers
    $query = "SELECT u.userid, u.firstname, u.lastname, u.image, COUNT(f.follower) AS num_followers
              FROM user u
              LEFT JOIN follows f ON u.userid = f.following
              GROUP BY u.userid
              ORDER BY num_followers DESC
              LIMIT 3";
    $result = mysqli_query($connection, $query);

    // Check if any users are found
    if (mysqli_num_rows($result) > 0) {
        // Display each user's information
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>";
            echo "<p>User ID: " . $row['userid'] . "</p>";
            echo "<p>Name: " . $row['firstname'] . " " . $row['lastname'] . "</p>";
            echo "<p>Number of Followers: " . $row['num_followers'] . "</p>";
            if (!empty($row['image'])) {
                echo "<img src='" . $row['image'] . "' alt='User Image'>";
            } else {
                echo "<p>No image available</p>";
            }
            echo "</div>";
        }
    } else {
        echo "<p>No users found.</p>";
    }

    // Close database connection
    mysqli_close($connection);
    ?>
</body>
</html>
