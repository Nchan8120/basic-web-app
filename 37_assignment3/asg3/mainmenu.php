<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Database</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>User List</h2>
    <form action="userlist.php" method="post">
        Order by:
        <input type="radio" name="order_by" value="firstname" checked> First Name
        <input type="radio" name="order_by" value="lastname"> Last Name
        <br>
        Order type:
        <input type="radio" name="order_type" value="ASC" checked> Ascending
        <input type="radio" name="order_type" value="DESC"> Descending
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
<body>
    <h2>Add New User</h2>
    <a href="adduser.php">Add User</a>
</body>
<body>
    <h2>Delete User</h2>
    <a href="deleteuser.php">Delete User</a>
</body>
<body>
    <h2>Modify User</h2>
    <a href="modifyuser.php">Modify User	</a>
</body>
<body>
    <h2>View Hashtags</h2>
    <a href="viewhash.php">View Hashtag Posts</a>
</body>
<body>
    <h2>View Posts</h2>
    <a href="selectpost.php">View Posts</a>
</body>
<body>
    <h2>Most Popular Users</h2>
    <a href="mostpopular.php">Top 3 Users</a>
</body>
</html>
