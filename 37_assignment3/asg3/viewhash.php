<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Hashtag Posts</title>
</head>
<body>
    <h1>View Hashtag Posts</h1>

    <form action="hashpost.php" method="post">
        <label for="hashtag">Select a Hashtag:</label>
        <select name="hashtag" id="hashtag">
            <?php
            // Include database connection file
            include 'connecttodb.php';

            // Retrieve list of hashtags
            $hashtag_query = "SELECT * FROM hashtag";
            $hashtag_result = mysqli_query($connection, $hashtag_query);

            // Display hashtags as options in dropdown
            while ($row = mysqli_fetch_assoc($hashtag_result)) {
                echo "<option value=\"" . $row['hashtagid'] . "\">" . $row['hashtagtext'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="View Posts">
    </form>
</body>
</html>
