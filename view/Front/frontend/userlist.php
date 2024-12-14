<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-top: 20px;
        }

        .header-container {
            width: 90%;
            margin: 20px auto;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .search-bar {
            display: flex;
            margin-right: 10px;
        }

        .search-bar input {
            width: 300px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-bar button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #45a049;
        }

        /* Add User Button Style */
        .add-user-button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .add-user-button:hover {
            background-color: #45a049;
        }

        /* Table and Button Styling */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            font-size: 14px;
        }

        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .update-btn {
            background-color: #4CAF50;
            color: white;
            transition: background-color 0.3s ease;
        }

        .update-btn:hover {
            background-color: #45a049;
        }

        .delete-btn {
            background-color: #ff4444;
            color: white;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color: #e03e3e;
        }
    </style>
    <script>
        // Function to confirm deletion
        function confirmDelete(userId) {
            const confirmation = confirm('Are you sure you want to delete this user?');
            if (confirmation) {
                window.location.href = `deleteUser.php?id=${userId}`;
            }
        }
    </script>
</head>

<body>
    <h1>User List</h1>

    <!-- Header Container (Search Bar + Add User Button) -->
    <div class="header-container">
        <!-- Add User Button -->
        <a href="adduser.php" class="add-user-button">Add User</a>

        <!-- Search Bar -->
        <div class="search-bar">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search by First Name (Nom)" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <!-- User Table -->
    <table border="1">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php
        include "../../Controller/usercontroller.php"; // Include UserController
        $userC = new usercontroller();
        
        // Get search term from the form submission
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        if ($search) {
            // Fetch users based on search term
            $list = $userC->searchUserByNom($search);
        } else {
            // Fetch all users if no search term is provided
            $list = $userC->userList();
        }

        // Display users in the table
        foreach ($list as $user) {
        ?>
            <tr>
                <td><?= ($user['nom']); ?></td>
                <td><?= ($user['nomFamille']); ?></td>
                <td><?= ($user['email']); ?></td>
                <td><?= ($user['tel']); ?></td>
                <td><?= ($user['adresse']); ?></td>
                <td><?= ($user['role']); ?></td>
                <td>
                    <!-- Update Form -->
                    <form method="POST" action="updateuser.php?id=<?= $user['id'] ?>">
                        <input type="submit" name="update" value="Update" class="update-btn">
                    </form>
                    <!-- Delete Link -->
                    <a href="#" onclick="confirmDelete(<?= $user['id']; ?>)" class="delete-btn">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>
