<?php

include "../Controller/usercontroller.php"; // Assume you have a UserController
$userC = new usercontroller();
$list = $userC->userList(); // Fetch the list of users
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>

<body>
    <a href="adduser.php">Add User</a> <!-- Link to add a new user -->
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
                    <form method="POST" action="updateUser.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value="<?= $user['id']; ?>" name="id">
                    </form>
                    <!-- Link to delete user -->
                    <a href="deleteUser.php?id=<?= $user['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>
