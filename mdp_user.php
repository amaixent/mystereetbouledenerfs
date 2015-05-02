<?php
session_start();
require ('main.inc.php');
/* on arrive sur une page où on demande le pseudo + valider */



if (isset($_GET) && !empty($_GET)) {
    if (isset($_GET["mode"]) && !empty($_GET["mode"])){
        $mode_mdp = $_GET["mode"];
    }
}
$msg = "";
$message = "";
if (isset($_GET["alert"]) && !empty($_GET["alert"])) {
    if ($_GET["alert"] == "pbmdp") {
        $msg = "Vous avez fait une erreur lors de la saisie de l'un des mots de passe.";
    }
    if ($_GET["alert"] == "pareil") {
        $msg = "Le nouveau mot de passe ne change pas du précédent, il faut en choisir un autre.";
    }
    if ($_GET["alert"] == "okmdp") {
        $message = "Votre nouveau mot de passe a bien été enregistré.";
    }
}
?>
<!DOCTYPE html>
<html>
    <?php include("include/head.php"); ?>
    <body>
        <?php
        include("include/menu.php");
        if (isset($msg) && !empty($msg)) {
            echo "<div class='alert alert-warning'>
                    <strong>$msg</strong> 
                </div>";
        }
        ?>
        <section class="inscription">
            <?php
            if (isset($mode_mdp) && $mode_mdp == "mdp_oublie") {
                ?>
                <h1>Mot de passe oublié ?</h1>
                <br>
                <form action='traitement.php?mode=mdp_oublie' method='post'>
                    <div class='form-group'>
                        <label for='nom_user'>Identifiant :</label>
                        <input type='text' class='form-control' id='nom_user' name='nom_user' required/>
                    </div>
                    <div class='btn_enregistrement'>
                        <button type='submit' type='button' class='btn btn-info'>Recevoir un nouveau mot de passe !</button>
                    </div>
                </form>
                <?php
            }
            if (isset($mode_mdp) && $mode_mdp == "new_mdp") {
                if (empty($_SESSION['login'])) {
                    header("location: index.php?alert=deconnecte");
                } else {

                    // form nouveau mdp + enregistrement
                    ?>
                    <h1>Mot de passe oublié ?</h1>
                    <br>
                    <form action='traitement.php?mode=chgmt_mdp' method='post'>
                        <div class='form-group'>
                            <label for='mdp_user_form'>Mot de passe actuel</label>
                            <input type='password' class='form-control' id='mdp_user_form' name='mdp_user_form' required/>
                        </div>
                        <div class='form-group'>
                            <label for='newmdp1'>Nouveau mot de passe</label>
                            <input type='password' class='form-control' id='newmdp1' name='newmdp1' required/>
                        </div>
                        <div class='form-group'>
                            <label for='newmdp2'>Nouveau mot de passe</label>
                            <input type='password' class='form-control' id='newmdp2' name='newmdp2' required/>
                        </div>
                        <div class='btn_enregistrement'>
                            <button type='submit' type='button' class='btn btn-info'>Changer mon mot de passe !</button>
                        </div>
                    </form>
                    <?php
                }
            }
            if (isset($message) && !empty($message)) {
                echo "$message";
            }
            ?>
        </section>

        <?php include("include/footer.php") ?>

    </body>
</html>