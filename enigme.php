<?php
session_start();
require ('main.inc.php');
if (empty($_SESSION['login'])) {
    header("location: index.php?alert=deconnecte");
}
if (!empty($_POST)) {
    extract($_POST);
}
if (!empty($_GET)) {
    extract($_GET);
}
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

        <div class="titre_enigme">
            <h1>Ceci n'est pas Le titre d'une enigme</h1>
        </div>

        <div class="image">
            <img src="enigme/1/2.jpg" alt="Ceci est une enigme"/>
            <br>
            <h1>Ceci n'est pas une enigme?</h1>
            <p> auteur : pseudo_auteur</p>
        </div>

        <div class="rep">
            <!-- Formulaire répondre à une enigme-->
            <form action="traitement.php" method="post" class="form-inline">
                <div class="form-group ">
                    <label for="reponse">Réponse :</label>
                    <input type="text" class="form-control " id="reponse" name="reponse" required/>
                    <button type="submit" type="button" class="btn btn-info">Répondre</button>
                </div>
            </form>  
            <p>Cette énigme rapporte *** points.</p>
        </div>
        <div class="btn-aide">
            <a href="aide.php"><button type="submit" type="button" class="btn btn-default indice">Besoin d'aide</button></a>
        </div>

        <?php include("include/footer.php") ?>

    </body>
</html>

