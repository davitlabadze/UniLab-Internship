<?php

$servername = "localhost";
$database = "unilab";
$username = 'root';
$password = '';


/**
 * Create Database
 *
 * @param [string] $servername
 * @param [string] $username
 * @param [string] $password
 * @return void
 */
function createDatabase($servername, $username, $password)
{
    // Creating a connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Creating a database named unilab
    $sql = "CREATE DATABASE unilab";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully with the name unilab";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    // closing connection
    $conn->close();
}

/**
 * Create Table
 *
 * @param [string] $servername
 * @param [string] $username
 * @param [string] $password
 * @param [string] $database
 * @return void
 */
function createTable($servername, $username, $password, $database)
{
    // Creating a connection
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $unilabTable = "CREATE TABLE users (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        surname VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        password VARCHAR(128) NOT NULL
        )";
    if ($conn->query($unilabTable) === TRUE) {
        echo "Table users created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // closing connection
    $conn->close();
}

//call functions
// createDatabase($servername, $username, $password);
// createTable($servername, $username, $password, $database);


//Connect database
try {
    $DB = new PDO("mysql:host=localhost;dbname=unilab", "root", "");
} catch (PDOException $e) {
    print "there is problem " . $e->getMessage();
}

/**
 * Add a Person
 * Check if the variable is set to 
 * Insert name,surname,email and password
 */
if (isset($_POST['addID']) && $_POST['name'] && $_POST['surname'] && $_POST['email'] && $_POST['password']) {
    $person = new Person($_POST['name'], $_POST['surname'], $_POST['email'],  PASSWORD_HASH($_POST["password"], PASSWORD_DEFAULT));
    $person->addPerson();
}

/**
 * Edit a Person
 * Check if the variable is set
 * @param $id
 * @return array;
 */

if (isset($_POST['editID'])) {
    $id =  $_POST['editID'];
    $person = new Person();
    $arrPerson = $person->editPerson($id);
}

/**
 * Update a Person
 * Check if the variable is set
 * @param mixed $id,$name,$surname,$email and $password
 */

if (isset($_POST['updatePersonID'])) {
    $id =  $_POST['updatePersonID'];
    $person = new Person($_POST['name'], $_POST['surname'], $_POST['email'],  PASSWORD_HASH($_POST["password"], PASSWORD_DEFAULT));
    $person->updatePerson($id);
}

/**
 * Delete Person
 * Check if the variable is set
 * call deletePerson function
 * @param $id
 */

if (isset($_POST['deleteID'])) {
    $id =  $_POST['deleteID'];
    $person = new Person();
    $person->deletePerson($id);
}

/**
 * Create new Person object
 * Get All Persons
 */
$data = new Person();
$dataArray = $data->getPersons();

class Person
{
    private $table = "users";
    public $name;
    public $surname;
    public $email;
    public $password;
    function __construct($name = '', $surname = '', $email = '', $password = '')
    {
        $this->name     = $name;
        $this->surname  = $surname;
        $this->email    = $email;
        $this->password = $password;
    }

    /**
     * INSERT
     * @return INT
     */
    function addPerson()
    {
        $status = 0;
        if ($this->name && $this->surname && $this->email && $this->password) {
            // $status = $GLOBALS['DB']->exec("INSERT INTO `$this->table`(`name`,`surname`,`email`,`password`) VALUES('$this->name','$this->surname','$this->email','$this->password')");
            $statment = $GLOBALS['DB']->prepare("INSERT INTO `$this->table`(`name`,`surname`,`email`,`password`) VALUES(?,?,?,?)");
            $status = $statment->execute(array($this->name, $this->surname, $this->email, $this->password));
        }
        return $status;
    }

    /**
     * Get one person's data to edit
     * @param $id
     * @return array;
     */

    function editPerson($id)
    {
        $statment = $GLOBALS['DB']->query("SELECT * FROM `$this->table` where id=$id");
        $data = $statment->fetchAll();
        return $data;
    }

    /**
     * UPDATE
     * @param $id
     * @return INT
     */
    function updatePerson($id)
    {
        $status = 0;
        if ($this->name && $this->surname && $this->email && $this->password) {
            $statment = $GLOBALS['DB']->prepare("UPDATE `$this->table` SET name=?,surname=?,email=?,password=? WHERE id=$id");
            $status = $statment->execute(array($this->name, $this->surname, $this->email, $this->password));
        }
        return $status;
    }


    /**
     * DELETE
     * @param $id
     * @return INT
     */
    function deletePerson($id)
    {
        $status = 0;
        $sql = "DELETE FROM $this->table WHERE id=$id";

        // Prepare statement
        $statment = $GLOBALS['DB']->prepare($sql);

        // execute the query
        $status = $statment->execute();
        return $status;
    }

    /**
     * GET Persons
     * @return array
     */
    function getPersons()
    {
        $statment = $GLOBALS['DB']->query("SELECT * FROM `$this->table`");
        $data = $statment->fetchAll();
        return $data;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        form {

            justify-content: center;
            text-align-last: 20px;
            padding: 20px;
            width: 50%;
            transform: translate(50%);

            text-align: center;
            display: flex;
        }

        label {
            font-family: arial, sans-serif;
            display: block;
        }

        input {
            display: inline;
            padding: 5px 20px;
            margin-right: 5px;
        }



        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 70%;
            transform: translate(25%);

        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .addbutton {
            margin-left: 12px;
            background: green;
            border: none;
            font-size: 18px;
            border-radius: 5px;
            box-shadow: 2px 2px 2px greenyellow;
            color: #fff;
            padding: 5px 20px;
            cursor: pointer;
        }

        .addbutton:hover {
            background: #018749;
        }

        .editButton {
            background: #00ff;
            box-shadow: 2px 2px 2px steelblue;
            color: #fff;
            padding: 5px 20px;
            border-radius: 20px;
            border: hidden;
            cursor: pointer;
        }

        .updatebutton {
            margin-left: 12px;
            background: blue;
            border: none;
            font-size: 18px;
            border-radius: 5px;
            box-shadow: 2px 2px 2px steelblue;
            color: #fff;
            padding: 5px 20px;
            cursor: pointer;
        }

        .updatebutton:hover {
            background: #1a84b8;
        }

        .deleteButton {
            background: #ff0000;
            box-shadow: 2px 2px 2px salmon;
            color: #fff;
            padding: 5px 20px;
            border-radius: 20px;
            border: hidden;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST['editID'])) { ?>
        <?php
        foreach ($arrPerson as $person) { ?>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
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

    <?php } else { ?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
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
            <input type="submit" value="Add Person" name="addID" id="addID" class="addbutton">
        </form>
    <?php } ?>

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
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <input type="hidden" name="editID" value="<?= $row['id'] ?>">
                    <td> <input type="submit" value="edit" id="edit" class="editButton"></td>
                </form>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <input type="hidden" name="deleteID" value="<?= $row['id'] ?>">
                    <td> <input type="submit" value="delete" id="delete" class="deleteButton"></td>
                </form>
            </tr>
        <?php  } ?>
    </table>
</body>

</html>