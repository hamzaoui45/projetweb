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

        a.add-user-link {
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 20px auto;
            display: inline-block;
            text-align: center;
            font-size: 16px;
        }

        a.add-user-link:hover {
            background-color: #45a049;
        }

        /* Table Styling */
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

        /* Button Styling */
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
                // Redirect to the delete script if confirmed
                window.location.href = `deleteUser.php?id=${userId}`;
            }
        }
    </script>
</head>

<body>
    <a href="adduser.php" class="add-user-link">Add User</a> <!-- Link to add a new user -->
    <table border="1">
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php
        include "../../Controller/usercontroller.php"; // Assume you have a UserController
        $userC = new usercontroller();
        $list = $userC->userList(); // Fetch the list of users

        foreach ($list as $user) {
        ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['nom']; ?></td>
                <td><?= $user['nomFamille']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['password']; ?></td>
                <td><?= $user['tel']; ?></td>
                <td><?= $user['adresse']; ?></td>
                <td><?= $user['role']; ?></td>
                <td>
                    <!-- Form to update user -->
                    <form method="POST" action="updateuser.php?id=<?= $user['id'] ?>">
                        <input type="submit" name="update" value="Update" class="update-btn">  
                    </form>
                    <!-- Link to delete user with confirmation -->
                    <a href="#" onclick="confirmDelete(<?= $user['id']; ?>)" class="delete-btn">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>
