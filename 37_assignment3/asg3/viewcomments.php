<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Comments</title>
</head>
<body>
    <h1>View Comments</h1>

    <?php
    // Include database connection file
    include 'connecttodb.php';

    // Retrieve selected post ID from URL parameter
    if (isset($_GET['postid'])) {
        $postid = $_GET['postid'];

        // Retrieve comments for the selected post
        $comment_query = "SELECT c.commentdate, c.commenttext, u.firstname, u.lastname 
                          FROM comments c
                          INNER JOIN user u ON c.userid = u.userid
                          WHERE c.postid = '$postid'";
        $comment_result = mysqli_query($connection, $comment_query);

        // Display comments
        if (mysqli_num_rows($comment_result) > 0) {
            echo "<h2>Comments for Post ID: $postid</h2>";
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($comment_result)) {
                echo "<li>";
                echo "User: " . $row['firstname'] . " " . $row['lastname'] . "<br>";
                echo "Date: " . $row['commentdate'] . "<br>";
                echo "Comment: " . $row['commenttext'];
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No comments found for Post ID: $postid</p>";
        }
    } else {
        echo "<p>Error: Post ID not provided.</p>";
    }

    // Close database connection
    mysqli_close($connection);
    ?>
</body>
</html>
