<?php

    ini_set('display_error',1);
    error_reporting(E_ALL);

    require_once('header.php');

if (func::checkLogin($con)){
    header["location: login.php"];
} else {
    $mysqlResponse = "SELECT * FROM mismatch_response";
    $resulResponse = $dbh->getQuery($mysqlCategory);

    
}



?>

<div class="mimismatch">

</div>

<?php

    require_once('footer.php');

?>