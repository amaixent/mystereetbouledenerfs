<?php
session_start();
require ('main.inc.php');

if (!empty($_SESSION['login'])) {
    header("location: index.php?alert=enregistreruser");
}
?>
<!DOCTYPE html>
<html>
    <?php include("include/head.php");?>
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

