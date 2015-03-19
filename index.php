<?php

session_start();
require ('main.inc.php');

//enregistrer_user("User", "mdp", "mail@mail.com");

if (!empty($_POST)) {
    //lecture des paramètres
    $user_name = $_POST['nom_user'];
    echo "username : $user_name <br>";
    
    $user_pwd = md5($_POST['mdp_user']);
    echo "mot de passe : $user_pwd <br>";
    
    $auth = authentifier_user($user_name);
    
    echo $id_user, $auth["mdp_user"];
    
    // ["id_user"]=> string(2) "22" ["mdp_user"]
    
    $message = "";
    //traitement
    /*if ($user_pwd == md5($auth["mdp_user"])) {
        $_SESSION['login'] = true;
        $_SESSION['pseudo'] = $user_name;
        $message = "victoire ";
        //header("location:traitement.php?mode=acceder_enigme");
        exit();
    } else {
        $message = "INCORRECT, veuillez vous ré-identifier ";
    }
    
    if($_SESSION['login'] == true){
        $_SESSION['pseudo'] = $pseudo;
    }*/
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
        <!--<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />-->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <link href="css/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>

        <!--Si l'utilisateur est connecté -->
        <header id="navbar" class="navbar-collapse collapse bar_sup">
            <p>Bonjour <?php echo $pseudo ?>, vous avez *** points.</p>
            <ul class="nav navbar-nav links">
                <li> <a href="regles.php">Les règles</a></li>
                <li> <a href="enigme.php">Énigme en cours</a></li>
                <li> <a href="messagerie.php" class="nv_mess">Ma messagerie</a></li>
                <li> <a href="creation_enigme.php">Proposer une énigme</a></li>
                <li> <a href="#deconnexion">Déconnexion</a></li>
            </ul>
        </header>



        <nav>	
            <div class="titre">
                <h1>Mystère et boule de nerf...</h1> 
            </div>
        </nav>

        <section>
            <p> Mystère et boule de nerf est un site d'énigmes participatif. 
                Vous pouvez répondre aux énigmes et proposer vos propres énigmes pour faire avancer le développement du jeu.<br/> Avant de vous inscrire, 
                merci de consulter les règles de fonctionement du site.</p>
            <a href="regles.php"> <button type="button" class="btn btn-info"> Les règles</button> </a>
        </section>

        <section>
            <?php echo "<p>$message</p>"; ?>
            <!-- Formulaire se connecter-->
            <form method="post">
                <div class="form-group">
                    <label for="nom_user">identifiant :</label>
                    <input type="text" class="form-control" id="nom_user" name="nom_user" required/>
                </div>
                <div class="form-group">
                    <label for="mdp_user">mot de passe :</label>
                    <input type="password" class="form-control" id="mdp_user" name="mdp_user" required/>
                </div>
                <div>
                    <button type="submit" type="button" class="btn btn-info" >Connexion</button>
                </div>
            </form>
            <br>
            <a class="MP_oubli" href="#" > mot de passe oublié?</a>
            <br>
            <br>
            <a href="enregistrement.php"> <button type="button" class="btn btn-default">Inscription</button> </a>
        </section>

        <footer class="conditions">
            <p>
                Maëlle Carlier & Alice Maixent<br>
                IMAC 2014-2015 <br>
            </p>
        </footer>


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


