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
        <?php include("include/menu.php"); ?>
        
            <section class="indice_crea">
            <h1>Créer un / des indice(s)</h1>
            <br>
        <?php
        echo "<form action='traitement.php?mode=crea_indice&id_enigme=$id_enigme&nb_indice=$nb_indice' method='post'>";
        for($i=0; $i<$nb_indice; $i++){
            $num = $i+1;
            echo <<<FORM
                <div class="form-group">
                    <label for="num_indice">Numéro de l'indice :</label>
                    <input type="number" class="form-control" id="num_indice" name="num_indice[$i]" value="$num" required/>
                </div>
                <div class="form-group">
                    <label for="prix">Points (minimum 2) :</label>
                    <input type="number"  class="form-control" id="prix" name="prix[$i]" required/>
                </div>
                <div class="form-group">
                    <label for="enonce">Enoncé :</label>
                    <textarea id="enonce"  class="form-control" name="enonce[$i]" required></textarea>
                </div>
FORM;
        }
        ?>
                <div class="button btn_indice ">
                    <button type="submit" type="button" class="btn btn-info">Créer l'indice</button>
                </div>
                
            </form>
        </section>
        <a href="creation_enigme.php" class="btn_indic_pre">
            <button type="submit" type="button" class="btn btn-info">Précedent</button>
        </a>

       <?php include("include/footer.php") ?>

    </body>

</html>