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
    case 'crea_enigme' :
        //fonction d'upload pour l'image
        $upload1 = upload('image',$image,1073741824, array('png','gif','jpg','jpeg') );
        if ($upload1) "Upload de l'icone réussi!<br />";
        //var_dump($_FILES["image"]);
        $image=$_FILES["image"]["name"];
        //$image=$_FILES["image"]["tmp_name"];

        //nom de l'auteur
        if($optionsRadios=="option1"){
            $auteur_id=$_SESSION ['id_user'];
        }
        
        enregistrer_enigme($titre, $enonce, $image, $reponse, $point, $num_enigme, $auteur_id);
        $enigme=NULL;
        $enigme=select_enigme_titre_enonce($titre, $enonce);
        $id_enigme=$enigme[0]['id_enigme'];
        header("Location:creation_indice.php?id_enigme=$id_enigme&nb_indice=$nb_indice");
        exit();
        break;
        
        
    case 'desinscription' :
        effacer_user($_SESSION ['id_user']);
        $_SESSION['login'] = false;
        session_destroy();
        header("location:index.php?alert=desinscrit");
        exit();
        break;
    
    case 'crea_indice' :
        echo 'id enigme : ',$id_enigme;
        for($i=0; $i<$nb_indice; $i++){
            enregistrer_indice($num_indice[$i], $prix[$i], $enonce[$i], $id_enigme);
        }
        header("location:index.php?alert=enigmeok");
        exit();
        break;
        
    
}
?>
