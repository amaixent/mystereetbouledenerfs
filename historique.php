<?php
session_start();
require ('main.inc.php');
?>
<!DOCTYPE html>
<html>
    <head>	
        <meta charset="utf-8"/>    
        <title>Mystereetbouledenerf</title>
        <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <link href="css/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    </head>
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
