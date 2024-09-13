<?php
// Nathan Chan 251151037
include 'connecttodb.php';
$userid = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Check if user ID is provided
    if (isset($_POST['userid'])) {
        $userid = $_POST['userid'];

        // Retrieve user information based on user ID
        $user_query = "SELECT * FROM user WHERE userid='$userid'";
        $user_result = mysqli_query($connection, $user_query);

        if (mysqli_num_rows($user_result) == 1) {
            $user = mysqli_fetch_assoc($user_result);
        } else {
            echo "<p style='color: red;'>Error: User not found.</p>";
            exit; // Stop further execution if user not found
        }
    } else {
        echo "<p style='color: red;'>Error: User ID not provided.</p>";
        exit; // Stop further execution if user ID not provided
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modify'])) {
       
// Process form submission to modify user
    // Retrieve form data
    $new_image = $_POST['new_image'];

    // Update the 'image' attribute for the user
    $update_query = "UPDATE user SET image='$new_image' WHERE userid='$userid'";
    $update_result = mysqli_query($connection, $update_query);

    if ($update_result) {
        echo "<p>Image updated successfully!</p>";
        // You can also refresh the page or redirect the user after successful modification
    } else {
        echo "<p style='color: red;'>Error updating image: " . mysqli_error($connection) . "</p>";
    }
}

mysqli_close($connection);
?>

<form action="modifyuser.php" method="post">
    <label for="userid">User ID:</label>
    <input type="text" id="userid" name="userid" required>
    <input type="submit" name="submit" value="Fetch User">
</form>

<?php if (isset($user)): ?>
    <!-- Display user information and modification form -->
    <h3>User Information</h3>
    <p>User ID: <?php echo $user['userid']; ?></p>
    <p>First Name: <?php echo $user['firstname']; ?></p>
    <p>Last Name: <?php echo $user['lastname']; ?></p>

    <?php
    // Check if the 'image' column is not empty
    if (!empty($user['image'])) {
        // Display the image
        echo "<img src='" . $user['image'] . "' alt='User Image'>";
    } else {
        // If 'image' column is empty, display a placeholder image or text
        echo "<p>No image available</p>";
    }
    ?>

    <!-- Modification form -->
    <h3>Modify User</h3>
    <form action="modifyuser.php" method="post">
        <label for="new_image">New Image URL:</label>
        <input type="text" id="new_image" name="new_image">
        <input type="submit" name="modify" value="Modify User">
    </form>
<?php endif; ?>
