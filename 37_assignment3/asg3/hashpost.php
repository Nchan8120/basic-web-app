<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hashtag Posts</title>
</head>
<body>
    <h1>Hashtag Posts</h1>

    <?php
    // Include database connection file
    include 'connecttodb.php';

    // Retrieve selected hashtag ID from form submission
    if (isset($_POST['hashtag'])) {
        $hashtag_id = $_POST['hashtag'];

        // Retrieve posts for the selected hashtag
        $post_query = "SELECT p.posttext, p.postdate, u.firstname, u.lastname 
		FROM post p
		INNER JOIN user u ON p.userid = u.userid
		INNER JOIN hashonpost hp ON p.postid = hp.postid
		WHERE hp.hashtagid = '$hashtag_id';
		";
        $post_result = mysqli_query($connection, $post_query);

 	
        if (mysqli_num_rows($post_result) > 0) {
            // Display posts for the selected hashtag
            echo "<h2>Posts for Selected Hashtag:</h2>";
            while ($post = mysqli_fetch_assoc($post_result)) {
                echo "<p><strong>Post Text:</strong> " . $post['posttext'] . "</p>";
                echo "<p><strong>Date:</strong> " . $post['postdate'] . "</p>";
                echo "<p><strong>Posted by:</strong> " . $post['firstname'] . " " . $post['lastname'] . "</p>";
                echo "<hr>";
            }
        } else {
            echo "<p>No posts found for the selected hashtag.</p>";
        }
    } else {
        echo "<p>Error: Hashtag not provided.</p>";
    }

    // Close database connection
    mysqli_close($connection);
    ?>
</body>
</html>
