<?php
session_start();
require ('main.inc.php');
if (empty($_SESSION['login'])) {
    header("location: index.php?alert=deconnecte");
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
        <section class="prop_enigme">
            <h1>Quelques consignes avant de vous lancer :<h3>
                    <p>
                        1) Vous devez proposer une énigme dont vous êtes l'auteur. <br>
                        2) En proposant une énigme vous nous autorisez à l'exploiter sur ce site.<br>  
                        3) L'image doit être libre de droit et de résolution correcte.<br>
                        4) La réponse de l'énigme doit être en un mot, sans majuscule et sans symbole.<br>
                        5) Vous devez cliquer sur suivant pour compléter les indices.<br>
                        <BR>
                    </p>
                    </section>
                    <section class="crea_enigme">
                        <h1>Créer une enigme </h1>
                        <br>

                        <form  action="traitement.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="titre">Titre :</label>
                                <input type="text" class="form-control" id="titre" name="titre" required/>
                            </div>
                            <div class="form-group">
                                <label for="ennonce">Ennoncé :</label>
                                <textarea id="ennonce" class="form-control" name="ennonce"></textarea>
                            </div>
                            <div class="form-group">
                                <!--image-->
                                <label for="image">Image :</label>
                                <input type="file" id="image" name="image"/>
                            </div>
                            <div class="form-group">
                                <label for="reponse">Réponse :</label>
                                <input type="text"  class="form-control" id="reponse" name="reponse" required/>
                            </div>
                            <div class="form-group">
                                <label for="point">Nombre de points que rapporte l'énigme :</label>
                                <input type="number"  class="form-control" id="point" name="point" required/>
                            </div>
                            <div class="form-group">
                                <label>Nombre d'indices : </label>
                                <select class="form-control">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p>J'accepte que mon pseudo soit cité sous l'énigme permettant aux joueurs de m'envoyer des messages : </p>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                        oui
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                        non
                                    </label>
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" required> Je reconnais être l'auteur de cette énigme et je laisse à Mystèreetbouledenerf le choix de l'utiliser ou non sur son site.
                                </label>
                            </div>
                            <div class="button">
                                <button type="submit" type="button" class="btn btn-info">Suivant</button>
                            </div>
                        </form>
                    </section>

                    <?php include("include/footer.php") ?>

                    </body>

                    </html>

