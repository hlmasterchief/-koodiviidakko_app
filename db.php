<?php
// Setting database
$dbname = 'mysql:dbname=koodiviidakko;host=127.0.0.1';
$user = 'koodiviidakko';
$password = 'koodiviidakko';

// Connect database
try {
    $db = new PDO($dbname, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

// Create table
try {
    $sql ="CREATE TABLE IF NOT EXISTS email(
    id int AUTO_INCREMENT PRIMARY KEY,
    email varchar(255) NOT NULL);" ;
    $db->exec($sql);
} catch (PDOException $e) {
    echo 'Create table failed: ' . $e->getMessage();
}

?>