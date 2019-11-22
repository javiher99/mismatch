<?php

    ini_set('display_error',1);
    error_reporting(E_ALL);

    require_once('header.php');

    if (func::checkLogin($con)){
        header["location: login.php"];
    } else {
        $mysql = "SELECT user_id, user_picture, user_username FROM users";
        $resul = $dbh->getQuery($mysql);
    }
?>

<div class="page">
  <div class="container">

    <?php
        foreach($resul as $row){
            echo"<div>".
                     $row['user_id']."</br>"
                    .$row['user_username']."</br>"
                    .$row['user_picture']."</br>
                </div>";
        }

    ?>

</div>

<?php

    require_once('footer.php');

?>