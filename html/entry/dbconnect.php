<?php
$option = [PDO::ATTR_EMULATE_PREPARES=>false];
try {
    $db = new PDO('mysql:dbname=test;host=mysql;port=3306;charset=utf8', 'test', 'test', $option);
} catch (PDOException $e) {
    header('Location: error.php');
    exit();
}
