<?php
require("connectionDB.php");

$route = "http://localhost:3000/Exercise_04/index.php";

/**
 * Add a Person
 * Check if the variable is set to 
 * Insert name,surname,email and password
 */
if (isset($_POST['insert']) && $_POST['name'] && $_POST['surname'] && $_POST['email'] && $_POST['password']) {
    $name     = $_POST['name'];
    $surname  = $_POST['surname'];
    $email    = $_POST['email'];
    $pwd      = $_POST['password'];
    $statment = $GLOBALS['DB']->prepare("INSERT INTO `users`(`name`,`surname`,`email`,`password`) VALUES(?,?,?,?)");
    $status   = $statment->execute(array($name, $surname, $email, $pwd));
    if ($status) {
        header("Location: $route");
        exit();
    }
} else {
    header("Location: $route");
    exit();
}
