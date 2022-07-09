<?php
require("connectionDB.php");
if (isset($_POST['deleteID'])) {
    $id =  $_POST['deleteID'];
    $sql = "DELETE FROM users WHERE id=$id";

    // Prepare statement
    $statment = $GLOBALS['DB']->prepare($sql);

    // execute the query
    $status = $statment->execute();
    if ($status) {
        header("Location: http://localhost:3000/Exercise_04/index.php");
        exit();
    }
} else {
    header("Location: http://localhost:3000/Exercise_04/index.php");
    exit();
}
