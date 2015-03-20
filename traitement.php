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
        if (empty($_SESSION['login'])) {
            enregistrer_user($nom_user, $mdp_user, $mail);
        }
        header("location: index.php?alert=connectezvous");
        exit();
        break;

    // se déconnecter
    case 'logout':
        $_SESSION['login'] = false;
        session_destroy();
        header("location:index.php");
        exit();
        break;

    // accéder à l'énigme en cours
    case 'acceder_enigme':
        $select = select_by_id("user", "id_user", $_SESSION['id_user']);
        //echo "<br> résultat select : ";
        //var_dump($select);
        $num = $select["idEnigme"];
        //echo '<br> $num = ', $select["idEnigme"];
        $enigme = select_enigme_by_num($num);
        //echo '<br>$enigme : select by num';
        //var_dump($enigme);
        $id = $enigme[0]["id_enigme"];
        header("location:enigme.php?code=$id");
        exit();
        break;
}
?>
