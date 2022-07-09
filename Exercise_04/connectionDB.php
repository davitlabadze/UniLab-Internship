<?php
//Connect database
try {
    $DB = new PDO("mysql:host=localhost;dbname=unilab", "root", "");
} catch (PDOException $e) {
    print "there is problem " . $e->getMessage();
}
