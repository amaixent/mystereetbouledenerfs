<?php
session_start();
require ('main.inc.php');
if (empty($_SESSION['login'])) {
    header("location: index.php?alert=deconnecte");
}

if (isset($_GET) && !empty($_GET)) {
    extract($_GET);
}
if (isset($_POST) && !empty($_POST)) {
    extract($_POST);
}




/*
 * GERER L'ENREGISTREMENT DE LA DATE / DE L'HEURE 
 * 
 */
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
        <section class="message">
            <!-- Formulaire message-->
            <form action="traitement.php?mode=envoi_message" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="objet">Objet :</label>
                    <input type="text" class="form-control" id="objet" name="objet" required/>
                </div>

                <?php
                if (isset($mode) && !empty($mode)) {
                    
                    if ($mode == "new") {
                        echo <<<FORM
                <div class="form-group">
                    <label for="destinataire">Pseudo du destinataire :</label>
                    <input type="text" class="form-control" id="destinataire" name="destinataire" required/>
                </div>
FORM;
                    } else{
                                                echo <<<FORM
                    <input type="hidden" class="form-control" id="destinataire" name="destinataire" value = "Alichou"/>
FORM;
                    }
                }
                ?>

                <div class="form-group">
                    <label for="texte">Message :</label>
                    <textarea id="texte" class="form-control" name="texte" required></textarea>
                </div>
                <div class="button">
                    <button type="submit" type="button" class="btn btn-info">Envoyer</button>
                </div>
            </form>
        </section>

        <?php include("include/footer.php") ?>

    </body>

</html>

