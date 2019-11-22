<?php

    require_once('funciton.php');
    unset($_SESSION);
    session_destroy();
    func::deleteCookie();
    header("Location: index.php");

?>