<?php
include 'connecttodb.php';

// Test if the connection is successful
if ($connection) {
    echo "Database connection successful!<br>";

    // Perform a test query
    $query = "SELECT * FROM user LIMIT 5"; // Replace "users" with the name of your table
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            // Output the data
            echo "Data retrieved successfully:<br>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "User ID: " . $row['userid'] . ", First Name: " . $row['firstname'] . ", Last Name: " . $row['lastname'] . "<br>";
            }
        } else {
            echo "No data found in the table.<br>";
        }
    } else {
        echo "Error executing query: " . mysqli_error($connection) . "<br>";
    }

    // Close the result set
    mysqli_free_result($result);
} else {
    echo "Database connection failed!<br>";
}

// Close the database connection
mysqli_close($connection);
?>
