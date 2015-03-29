<?php
session_start();
require ('main.inc.php');

if (!empty($_SESSION['login'])) {
    header("location: index.php?alert=enregistreruser");
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
        <section class="inscription">
            <h1>Inscription</h1>
            <br>
            <form action="traitement.php?mode=new_user" method="post">
                <div class="form-group">
                    <label for="nom_user">identifiant :</label>
                    <input type="text" class="form-control" id="nom_user" name="nom_user" required/>
                </div>
                <div class="form-group">
                    <label for="mdp_user">mot de passe :</label>
                    <input type="password" class="form-control" id="mdp_user" name="mdp_user" required/>
                </div>
                <div class="form-group">
                    <label for="mail">mail :</label>
                    <input type="email" class="form-control" id="mail" name="mail" required/>
                </div>
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox1" value="option1" required> J'ai lu et compris les règles et le fonctionnement de ce site.
                </label>

                <div class="btn_enregistrement">
                    <button type="submit" type="button" class="btn btn-info">Inscription</button>
                </div>
            </form>
        </section>

        <?php include("include/footer.php") ?>

    </body>
</html>

