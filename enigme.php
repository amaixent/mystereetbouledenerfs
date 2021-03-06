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



/*
 * La variable $code est passée par l'adresse - c'est en fait l'id de l'énigme en cours
 */
$info_enigme = select_by_id("enigme", "id_enigme", $code);
if ($info_enigme == NULL) {
    header("location: index.php?alert=derniereenigme");
}

if (!empty($info_enigme["auteur_id"])) {
    $info_auteur = select_by_id("user", "id_user", $info_enigme["auteur_id"]);
    if (!empty($info_auteur["nom_user"])) {
        $nom_auteur = $info_auteur["nom_user"];
    }
}

$info_user = select_by_id("user", "id_user", $_SESSION["id_user"]);
$nb_point_user = $info_user["point_user"];


/*
 * Réponse à l'énigme
 */

if (isset($reponse) && !empty($reponse)) {
    if ($reponse == $info_enigme["reponse"]) {
        $select = select_by_id("user", "id_user", $_SESSION['id_user']);
        $nb_point_user += $info_enigme["point"];
        $num = $info_enigme["num_enigme"];
        $num++;
        $enigme = select_enigme_by_num($num);
        
        /*
        * vérifier si l'énigme suivante existe
        */
        
        $id = $enigme[0]["id_enigme"];
        extract($info_user);
        modifier_user($_SESSION["id_user"], $nom_user, $mdp_user, $mail, $statut, $num, $nb_point_user, 0, $cle, $actif);

        header("location:enigme.php?code=$id");
    }
}
?>
<!DOCTYPE html>
<html>
    <?php include("include/head.php");?>
    <body>
        <?php include("include/menu.php") ?>

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

        <div class="rep">
            <!-- Formulaire répondre à une enigme-->
            <form method="post" class="form-inline">
                <div class="form-group ">
                    <label for="reponse">Réponse :</label>
                    <input type="text" class="form-control " id="reponse" name="reponse" required/>
                    <button type="submit" type="button" class="btn btn-info">Répondre</button>
                </div>
            </form>  
            <p>Cette énigme rapporte <?php echo $info_enigme["point"] ?> points.</p>
        </div>
        <div class="btn-aide">
<?php echo "<a href='aide.php?code=$code'><button type='submit' type='button' class='btn btn-default indice'>Besoin d'aide ?</button></a>"; ?>
        </div>

<?php include("include/footer.php") ?>

    </body>
</html>

