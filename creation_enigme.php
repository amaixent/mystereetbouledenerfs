﻿<?php
session_start();
require ('main.inc.php');
if (empty($_SESSION['login'])) {
    header("location: index.php?alert=deconnecte");
}
?>
<!DOCTYPE html>
<html>
    <?php include("include/head.php");?>
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

            <form  action="traitement.php?mode=crea_enigme" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titre">Titre :</label>
                    <input type="text" class="form-control" id="titre" name="titre" required/>
                </div>
                <div class="form-group">
                    <label for="ennonce">Enoncé :</label>
                    <textarea id="ennonce" class="form-control" name="enonce"></textarea>
                </div>
                <!--taille max= 1GO-->
                <input type="hidden" name="MAX_FILE_SIZE" value="1073741824" />
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
                    <select name="nb_indice"class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
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

