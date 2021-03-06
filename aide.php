﻿<?php
session_start();
require ('main.inc.php');

if (empty($_SESSION['login'])) {
    header("location: index.php?alert=deconnecte");
}
if (isset($_POST) && !empty($_POST)) {
    extract($_POST);
}
if (isset($_GET) && !empty($_GET)) {
    extract($_GET);
}
//Sélection de tous les indices correspondant à $code (id enigme) passé dans $_GET
$indices = select_all("indice", "idEnigme", $code);
$info_user = select_by_id("user", "id_user", $_SESSION["id_user"]);
$nb_point_user = $info_user["point_user"];
?>
<!DOCTYPE html>
<html>
    <?php include("include/head.php");?>
    <body>
        <?php
        include("include/menu.php");

        if (!empty($alert) && $alert == "pauvre") {
            $message = "Vous n'avez pas assez de points pour acheter cet indice. Demandez plutôt de l'aide !";
            echo "<div class='alert alert-warning'>
                    <strong>$message</strong> 
                </div>";
        }
        ?>


        <section>

            <h2>Besoin d'aide ?</h2>

            <?php
            if (isset($indices) && !empty($indices)) {
                foreach ($indices as $i => $indice) {
                    $num = $i + 1;
                    $prix = $indice["prix"];
                    $id_indice = $indice["id_indice"];
                    $enonce = $indice["enonce"];
                    if ($i < $info_user["indice_achete"]) {
                        echo <<<INDICE
                        <div class="aide">
                            <p class="indice"><em>Indice numéro $num</em> : $prix points</p>
                            <div class="afficher-indice2">
                                $enonce
                            </div>
                        </div>
INDICE;
                    } else {
                        echo <<<INDICE
                <div class="aide"> 
                    <p class="indice"><em>Indice numéro $num</em> : $prix points</p>
                    <a href="traitement.php?mode=acheter_indice&id_indice=$id_indice"><button type="submit" type="button" class="btn btn-info indice">Acheter</button></a>
                </div>
INDICE;
                    }
                }
            } else{
                echo "<div class='aide'>Il n'y a pas d'indices mais vous pouvez demander de l'aide ;).</div>";
            }

            //si nbpoints <2 afficher bouton aide
            if (!empty($nb_point_user) && $nb_point_user < 2 || $num == $info_user["indice_achete"] || empty($indices)) {
                echo "<a href='creer_message.php?mode=aide'><button type='submit' type='button' class='btn btn-info indice'>Demander de l'aide</button></a>";
            }
            
            $id_enigme = $indice["idEnigme"];
            echo "<br><a href='enigme.php?code=$id_enigme'><button type='submit' type='button' class='btn btn_enregistrement btn-info indice'>Retour</button></a>";
            ?>
        </section>

        <?php include("include/footer.php") ?>

    </body>
</html>


