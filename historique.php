<?php
session_start();
require ('main.inc.php');
?>
<!DOCTYPE html>
<html>
    <?php include("include/head.php");?>
    <body>

        <?php
        include("include/menu.php"); ?>
           <?php

        $select = select_by_id("user", "id_user", $_SESSION['id_user']);
        $num_max = $select["idEnigme"];
        echo("<section> 
            <h1>Énigmes résolues : </h1>
            ");
        for($i=0; $i<$num_max; $i++){

            $enigme = select_enigme_by_num($i);
            $id = $enigme[0]["id_enigme"];
            
            $indice=$i+1;
            echo <<<HISTORIQUE
                <div class="form-group">
                <a href="afficher_enigme.php?code=$id" class="nav_color">Énigme$indice</a>
                 
                </div>
     
HISTORIQUE;
        }
        echo("</section>");
        ?>
        <?php include("include/footer.php"); ?>
    </body>

</html>
