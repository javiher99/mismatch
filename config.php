<?php

    ini_set('display_error',1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    define("DB_HOST", 'localhost');
    define("DB_USER", 'root');
    define("DB_PASS", 'root');
    define("DB_NAME", 'mismatch');

    require_once('DBConnection.php');

    $dbh = new DBConnection();
    $con = $dbh->getDBH();
?>