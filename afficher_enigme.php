<?php
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

$info_enigme = select_by_id("enigme", "id_enigme", $code);
$indices = select_all("indice", "idEnigme", $code);
$reponse = $info_enigme["reponse"];
if (!empty($info_enigme["auteur_id"])) {
    $info_auteur = select_by_id("user", "id_user", $info_enigme["auteur_id"]);
    if (!empty($info_auteur["nom_user"])) {
        $nom_auteur = $info_auteur["nom_user"];
    }
}
?>
<!DOCTYPE html>
<html>
    <?php include("include/head.php");?>
    <body>
        <?php include("include/menu.php");?>
       
        <div class="titre_enigme">
            <h1><?php echo $info_enigme["titre"] ?></h1>
        </div>

        <div class="image">
            <?php
            $image = $info_enigme["image"];
            echo "<img src='img/$image' alt='Ceci est une enigme'/>";
            ?>
            <br>
            <h1><?php echo $info_enigme["enonce"] ?></h1>
            <p> 
            <?php if (!empty($nom_auteur)) {

                echo 'Auteur : ',$nom_auteur;
            } ?></p>
           
        </div>

        <?php
        echo <<<REPONSE
        <section>
            <h1>Réponse : <h1> $reponse
        </section>
REPONSE;
        ?>
        <section>
             Cette énigme a rapporté <?php echo $info_enigme["point"] ?> points.
        </section>

            <?php
            if (isset($indices) && !empty($indices)) {
                foreach ($indices as $i => $indice) {
                    $num = $i + 1;
                    $prix = $indice["prix"];
                    $id_indice = $indice["id_indice"];
                    $enonce = $indice["enonce"];

                    echo <<<INDICE
                    <section>
                        <div class="aide">
                            <p class="indice"><em>Indice numéro $num</em> : $prix points</p>
                            <div class="afficher-indice2">
                                $enonce
                            </div>
                        </div>
                    </section>
INDICE;
                    
                }
            } else{
                echo "<section><div class='aide'>Il n'y a pas avait pas d'indice.</div></section>";
            }
            ?>

        <?php include("include/footer.php"); ?>
    </body>

</html>
