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
        <section class="bienvenue">
            <h1>Bienvenue sur votre messagerie.</h1>
        </section>
        <section class="messagerie">
            <h3>Messages reçus : </h3>
            <div class="messagerie_contenu">
                <div class="row">
                    <div class="col-md-5">EXPÉDITEUR : </div>
                    <div class="col-md-4">| OBJET : </div>
                </div>
                <div class="row">
                    <a href="afficher_message.php" >
                        <div class="col-md-5 message_non_lu">
                            Pseudo_dd
                        </div>
                        <div class="col-md-4 message_non_lu">
                            Ceci est un objet
                        </div>
                    </a>
                </div>
                <div class="row">
                    <a href="afficher_message.php" >
                        <div class="col-md-5 message_lu">
                            Pseudo_dd
                        </div>
                        <div class="col-md-4 message_lu">
                            Ceci est un objet
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <section class="messagerie">
            <h3>Messages envoyés : </h3>
            <div class="messagerie_contenu">
                <div class="row">
                    <div class="col-md-5">EXPÉDITEUR : </div>
                    <div class="col-md-4">| OBJET : </div>
                </div>
                <p>Aucun message.</p>
            </div>
        </section>
        <?php include("include/footer.php") ?>
    </body>

</html>