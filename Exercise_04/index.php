<?php

require("connectionDB.php");
$statment = $GLOBALS['DB']->query("SELECT * FROM `users`");
$dataArray = $statment->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">

    <title>CRUD Operations</title>
</head>

<body>
    <form action="insert.php" method="POST">
        <div>
            <label for="name">name</label>
            <input type="text" name="name" id="name" />
        </div>
        <div>
            <label for="surname">surname</label>
            <input type="text" name="surname" id="surname" />
        </div>
        <div>
            <label for="email">email</label>
            <input type="email" name="email" id="email" />

        </div>
        <div>
            <label for="password">password</label>
            <input type="password" name="password" id="password" />
        </div>
        <input type="submit" name="insert" class="addbutton">
    </form>

    <table>
        <tr>
            <th>#ID</th>
            <th>Name</th>
            <th>surname</th>
            <th>Email</th>
            <th>Password</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
        <?php
        foreach ($dataArray as $row) { ?>
            <tr>
                <td><?= $row['id'] ?> </td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['surname'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['password'] ?></td>
                <form action="edit.php" method="POST">
                    <input type="hidden" name="editID" value="<?= $row['id'] ?>">
                    <td> <input type="submit" value="edit" id="edit" class="editButton"></td>
                </form>
                <form action="delete.php" method="POST">
                    <input type="hidden" name="deleteID" value="<?= $row['id'] ?>">
                    <td> <input type="submit" value="delete" id="delete" class="deleteButton"></td>
                </form>
            </tr>
        <?php  } ?>
    </table>
</body>

</html>