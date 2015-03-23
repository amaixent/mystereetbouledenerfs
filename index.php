<?php
session_start();
require ('main.inc.php');

//enregistrer_user("User7775654", "md77rgs7p", "mai7fgdfg77l@mail.com");
if (isset($_GET) && !empty($_GET)) {
    extract($_GET);
}
if (isset($_POST) && !empty($_POST)) {
    //lecture des paramètres
    //var_dump($_POST['nom_user']);
    $auth = authentifier_user($_POST['nom_user']);
    if (!empty($auth)) {
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
        $message = "INCORRECT, veuillez vous ré-identifier ";
    }
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

        <?php
        include("include/menu.php");
        if (isset($alert)) {
            switch ($alert) {
                case 'connectezvous':
                    $avertissement = "Vous êtes enregistré, maintenant connectez vous !";
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
                
                
            }

            echo "<div class='alert alert-warning'>
                    <strong>$avertissement</strong> 
                </div>";
        }
        ?>

        <nav>	
            <div class="titre">
                <h1>Mystère et boule de nerf...</h1> 
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
                <form method="post">
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
                <a class="MP_oubli" href="#" > Mot de passe oublié ?</a>
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

        <?php include("include/footer.php") ?>


        <a href="enregistrement.php">s'enregistrer</a>
        <br>

        <a href="enigme.php">accéder à l'énigme</a>
        <br>

        <a href="creation_enigme.php">créer une énigme</a>
        <br>

        <a href="creation_indice.php">créer un indice</a>
        <br>

        <a href="aide.php">aide</a>
        <br>

        <a href="regles.php"> règles</a>

        <br>
        <a href="messagerie.php">accéder à ma messagerie</a>

        <br>
        <a href="afficher_message.php">afficher un message</a>

        <br>
        <a href="creer_message.php">créer un message</a> 
        </br>
    </body>

</html>


