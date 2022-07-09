<?php
require("connectionDB.php");
if (isset($_POST['editID'])) {
    $id =  $_POST['editID'];
    $statment = $GLOBALS['DB']->query("SELECT * FROM `users` where id=$id");
    $arrPerson = $statment->fetchAll();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Update Person</title>
</head>

<body>
    <?php foreach ($arrPerson as $person) { ?>
        <form action="update.php" method="POST">
            <div>
                <label for="name">name</label>
                <input type="text" name="name" id="name" value="<?php echo $person['name'] ?> " />
            </div>
            <div>
                <label for="surname">surname</label>
                <input type="text" name="surname" id="surname" value="<?php echo $person['surname'] ?> " />
            </div>
            <div>
                <label for="email">email</label>
                <input type="email" name="email" id="email" value="<?php echo $person['email'] ?> " />

            </div>
            <div>
                <label for="password">password</label>
                <input type="password" name="password" id="password" value="<?php echo $person['password'] ?> " />
            </div>
            <input type="hidden" name="updatePersonID" value="<?= $person['id'] ?>">
            <td> <input type="submit" value="Update Person" id="updatePersonID" class="updatebutton"></td>
        </form>
    <?php } ?>

</body>

</html>