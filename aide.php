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
        <?php include("include/menu.php") ?>
        <section>

            <h2>Besoin d'aide?</h2>

            <div class="aide"> 
                <p class="indice"><em>1er indice :</em> -2 points</p>
                <div class="afficher-indice2">
                    Comme le monsieur a acheté l'indice, il le voit ici, bla bla bla!
                </div>
                <div>

                    <div class="aide"> 
                        <p class="indice"><em>2ème indice :</em> -2 points</p>
                        <a href="traitement.php"><button type="submit" type="button" class="btn btn-info indice">Acheter</button></a>
                    </div>

                    <div class="aide"> 
                        <p class="indice"><em>3ème indice : </em>-4 points</p>
                        <a href="traitement.php"><button type="submit" type="button" class="btn btn-info indice">Acheter</button></a>
                    </div>

                    <a href="creer_message.php"><button type="submit" type="button" class="btn btn-info indice">Demander de l'aide</button></a>

                    </section>

                    <?php include("include/footer.php") ?>

                    </body>
                    </html>


