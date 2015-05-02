<?php
session_start();
require ('main.inc.php');

//enregistrer_user("User7775654", "md77rgs7p", "mai7fgdfg77l@mail.com");
if (isset($_GET) && !empty($_GET)) {
    extract($_GET);
}
if (isset($_POST) && !empty($_POST)) {
    //lecture des paramètres
    $auth = authentifier_user($_POST['nom_user']);
    if (!empty($auth)) {
        if ($auth[0]["actif"] == 1) {
            //traitement
            if (md5($_POST['mdp_user']) == $auth[0]["mdp_user"]) {
                $_SESSION['login'] = true;
                $_SESSION['pseudo'] = $_POST['nom_user'];
                $_SESSION['id_user'] = $auth[0]["id_user"];
                header("location:traitement.php?mode=acceder_enigme");
                exit();
            } else {
                $message = "INCORRECT, veuillez vous ré-identifier ";
            }
        } else {
            $message = "Vous n'avez pas activé votre compte, allez voir vos mails !";
        }
    } else {
        $message = "INCORRECT, veuillez vous ré-identifier ";
    }
}
?>
<!DOCTYPE html>
<html>
<?php include("include/head.php"); ?>
    <body>

<?php
include("include/menu.php");
//Messages d'alerte, d'information, etc
if (isset($alert)) {
    switch ($alert) {
        case 'connectezvous':
            $avertissement = "Votre compte est activé, vous pouvez maintenant vous connecter !";
            break;
        case 'interdit':
            $avertissement = "Attention ! L'accès à cette page est interdit !";
            break;
        case 'deconnecte':
            $avertissement = "Accès interdit, veuillez vous connecter pour voir la page souhaitée.";
            break;
        case 'enregistreruser':
            $avertissement = "Accès interdit, vous avez déjà un compte...";
            break;
        case 'interditmessage':
            $avertissement = "Accès interdit, Le message auquel vous tentez d'accéder ne vous concerne pas.";
            break;
        case 'desinscrit':
            $avertissement = "Vous êtes maintenant désinscrit.";
            break;
        case 'enigmeok':
            $avertissement = "Votre énigme est enregistrée. Merci de votre aide !";
            break;
        case 'uploadnull':
            $avertissement = "Image incorrecte. Merci de réessayer.";
            break;
        case 'derniereenigme':
            $avertissement = "Vous avez répondu à toutes les enigmes disponibles. N'hésitez pas à en proposer pour faire avancer le jeu.";
            break;
        case 'identifiantexiste':
            $avertissement = "Cet identifiant existe déjà. Merci de recommencer votre inscription.";
            break;
        case 'usererror' :
            $avertissement = "La personne à qui vous essayez d'envoyer un message n'existe pas.";
            break;
        case 'dejaactif' :
            $avertissement = "Vous avez déjà activé votre compte, vous pouvez vous connecter normalement.";
            break;
        case 'pbactiv' :
            $avertissement = "Erreur, votre compte ne peut pas être activé";
            break;
        case 'activmail' :
            $avertissement = "Allez voir vos mails pour activer votre compte dès maintenant !";
            break;
        case 'newmdpmail' :
            $avertissement = "Allez voir vos mails pour avoir votre nouveau mot de passe !";
            break;
        case 'dejaconnecte' :
            $avertissement = "Vous êtes déjà connecté ... Si vous voulez modifier votre mot de passe <a href ='mdp_user.php?mode=new_mdp'>cliquez ici</a>";
            break;
    }

    echo "<div class='alert alert-warning'>
                    <strong>$avertissement</strong> 
                </div>";
}
?>

        <nav>	
            <div class="titre">
                <h1>Mystère et boule de nerfs...</h1> 
            </div>
        </nav>

        <section>
            <p> Mystère et boule de nerf est un site d'énigmes participatif. 
                Vous pouvez répondre aux énigmes et proposer vos propres énigmes pour faire avancer le développement du jeu.
                <br/> Avant de vous inscrire, merci de consulter les règles de fonctionement du site.
            </p>
            <a href="regles.php"> <button type="button" class="btn btn-info"> Les règles</button> </a>
        </section>


<?php
if (empty($_SESSION['login'])) {
    ?>
            <section>
            <?php
            if (!empty($message)) {
                echo "<p class = 'alert alert-warning'>$message</p>";
            }
            ?>
                <!-- Formulaire se connecter-->
                <form method="post" action="index.php">
                    <div class="form-group">
                        <label for="nom_user">Identifiant :</label>
                        <input type="text" class="form-control" id="nom_user" name="nom_user" required/>
                    </div>
                    <div class="form-group">
                        <label for="mdp_user">Mot de passe :</label>
                        <input type="password" class="form-control" id="mdp_user" name="mdp_user" required/>
                    </div>
                    <div>
                        <button type="submit" type="button" class="btn btn-info" >Connexion</button>
                    </div>
                </form>
                <br>
                <a class="MP_oubli" href="mdp_user.php?mode=mdp_oublie"> Mot de passe oublié ?</a>
                <br>
                <br>
                <a href="enregistrement.php"> <button type="button" class="btn btn-default">Inscription</button> </a>
            </section>

    <?php
}

if (!empty($_SESSION['login'])) {
    ?>
            <section>
                <h3>Se désinscrire :</h3>
                <p>
                    ATTENTION : action irréversible <br />
                    Vous pouvez à tout moment vous désinscrire en cliquant sur <a class="MP_oubli" href="traitement.php?mode=desinscription">ce lien</a>.
                </p>
            </section>
<?php } ?>

        <?php include("include/footer.php"); ?>
    </body>

</html>


