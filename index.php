<?php        
        ini_set('display_error',1);
        error_reporting(E_ALL);
                
        require_once('header.php');
?>
<?php
    if(func::checkLogin()){
        require_once('nav.php');
    }else{
        require_once('navNot.php');
    }

    $string = func::createSerial(8);
    echo $string;
?>
<?php
require_once('footer.php');
?>