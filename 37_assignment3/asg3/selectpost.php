<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Post</title>
</head>
<body>
    <h1>Select Post</h1>

    <form action="viewcomments.php" method="get">
        <label for="postid">Select a Post:</label>
        <select name="postid" id="postid">
            <?php
            // Include database connection file
            include 'connecttodb.php';

            // Retrieve list of posts
            $post_query = "SELECT * FROM post";
            $post_result = mysqli_query($connection, $post_query);

            // Display posts as options in dropdown
            while ($row = mysqli_fetch_assoc($post_result)) {
                echo "<option value=\"" . $row['postid'] . "\">" . $row['postid'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="View Comments">
    </form>
</body>
</html>
