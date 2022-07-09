<?php
require("connectionDB.php");
$route = "http://localhost:3000/Exercise_04/index.php";
/**
 * Update a Person
 * Check if the variable is set to 
 * Update name,surname,email and password
 */
if (isset($_POST['updatePersonID']) && $_POST['name'] && $_POST['surname'] && $_POST['email'] && $_POST['password']) {
    $id       = $_POST['updatePersonID'];
    $name     = $_POST['name'];
    $surname  = $_POST['surname'];
    $email    = $_POST['email'];
    $pwd      = $_POST['password'];
    $statment = $GLOBALS['DB']->prepare("UPDATE `users` SET name=?,surname=?,email=?,password=? WHERE id=$id");
    $status   = $statment->execute(array($name, $surname, $email, $pwd));
    if ($status) {
        header("Location: $route");
        exit();
    }
} else {
    header("Location: $route");
    exit();
}
