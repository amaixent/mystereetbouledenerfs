<?php
//tableaux de fonctions
session_start();
require ('main.inc.php');
//require ($cfg['ROOT_DIR'] . '/lib/parameters.inc.php');


// extraire les informations en fonction de la méthode d'appel
if (isset($_GET) && !empty($_GET)) {
    extract($_GET);
}

if (isset($_POST) && !empty($_POST)) {
    extract($_POST);
}

switch ($mode) {

    //enregistrer un utilisateur
    case 'new_user':
        //if ($_SESSION['login'] = false;){
            enregistrer_user($nom_user, $mdp_user, $mail);

        //}
        header("location: index.php");
        exit();
        break;

    // DELOG pour l'admin 
    case 'logout':
        $_SESSION['login'] = false;
        header("location:index.php");
        exit();
        break;


    // EFFACER un film 
    // paramètres complémentaires : 
    //  idmovie 
    case 'delete_user':
        $film = $oMovie->get($idmovie);
        deletethumbnail($film['poster']);
        $oMovie->delete($idmovie);
        header("location:filmo.php");
        exit();
        break;

}
?>
