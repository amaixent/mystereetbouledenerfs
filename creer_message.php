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

?>
<!DOCTYPE html>
<html>
    <?php include("include/head.php");?>
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
                    <input type="hidden" class="form-control" id="destinataire" name="destinataire" value = "Ausecours"/>
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

