<?php

    ini_set('display_error',1);
    error_reporting(E_ALL);

    require_once('header.php');
        $name = 0;

        $mysqlCategory = "SELECT * FROM mismatch_category";
        $resulCategory = $dbh->getQuery($mysqlCategory);

        $mysqlTopics = "SELECT * FROM mismatch_topic";
?>

<div class="page">
    <div class="pepe">
    <?php

        foreach($resulCategory as $row){
            echo "<h3>".$row['category_name']."</h3>";
            $resulTopics = $dbh->getQuery($mysqlTopics);
            foreach($resulTopics as $valor){
                if ($valor['category_id'] == $row['category_id']){
                //echo "<label><input type="."checkbox". "id="."box1". "value="."first_checkbox>".$valor['name'].$valor['category_id']."</label>";
                echo $valor['name'].' '; //<input type="radio" name=$name value="Like">Like</input><input type="radio" name=$name value="Dislike">Dislike</input>';
                }
            }
        }

    ?>
    </div>
</div>

<?php

    require_once('footer.php');

?>
