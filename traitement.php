<?php
//tableaux de fonctions
session_start();
require ('main.inc.php');
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
            $test = authentifier_user($nom_user);
            if ($test == NULL ){
                
                
                // Génération aléatoire d'une clé
                $cle = md5(microtime(TRUE)*100000);

                
                enregistrer_user($nom_user, $mdp_user, $mail, $cle);

                // Préparation du mail contenant le lien d'activation
                $destinataire = $mail;
                $sujet = "Activer votre compte" ;
                $entete = "From: mystereetbouledenerfs@enigme.com" ;

                // Le lien d'activation est composé du login(log) et de la clé(cle)
                $message = 'Bienvenue sur Mystère et boule de nerfs,

                Pour activer votre compte, veuillez copier/coller dans votre navigateur internet.

                http://pmserv.net/alice/mystereetbouledenerfs/activation.php?log='.urlencode($nom_user).'&cle='.urlencode($cle).'


                ---------------
                Ceci est un mail automatique, Merci de ne pas y répondre.';


                mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
                
                header("location: index.php?alert=activmail");
            }
            else{
                header("location: index.php?alert=identifiantexiste");
            }
        }
        
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
        $num = $select["idEnigme"];
        $enigme = select_enigme_by_num($num);
        $id = $enigme[0]["id_enigme"];
        header("location:enigme.php?code=$id");
        exit();
        break;
    // proposer une énigme
    case 'crea_enigme' :

        //Pour éviter d'écraser les doublons si 2 images chargées ont le même nom    
        $dir2save = $_SERVER['DOCUMENT_ROOT'] . "/mystereetbouledenerfs/img";
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        echo("esxtension = $ext");
        $fichier = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
        $i = 1;
        $completename = $dir2save . '/' . $_FILES["image"]["name"];
        $image = $_FILES["image"]["name"];

        while (file_exists($completename)) {
            $completename = $dir2save . '/' . $fichier . '(' . $i . ').' . $ext;
            $image = $fichier . '(' . $i . ').' . $ext;
            $i++;
        }

        $destination = $completename;

        //fonction d'upload pour l'image
        $upload1 = upload('image', $destination, 1073741824, array('png', 'gif', 'jpg', 'jpeg', 'JPG'));
        if ($upload1 == false ){
            header("Location:index.php?alert=uploadnull");
            exit();
            break;
        }

        //nom de l'auteur
        if ($optionsRadios == "option1") {
            $auteur_id = $_SESSION ['id_user'];
        }

        enregistrer_enigme($titre, $enonce, $image, $reponse, $point, $num_enigme, $auteur_id);
        $enigme = NULL;
        $enigme = select_enigme_titre_enonce($titre, $enonce);
        $id_enigme = $enigme[0]['id_enigme'];

        if ($nb_indice == 0) {
            header("Location:index.php?alert=enigmeok");
        } else {
            header("Location:creation_indice.php?id_enigme=$id_enigme&nb_indice=$nb_indice");
        }


        exit();
        break;

    //se désinscrire
    case 'desinscription' :
        effacer_user($_SESSION ['id_user']);
        $_SESSION['login'] = false;
        session_destroy();
        header("location:index.php?alert=desinscrit");
        exit();
        break;

    //créer le nombre d'indices choisi à la saisie de l'énigme.
    case 'crea_indice' :
        echo 'id enigme : ', $id_enigme;
        for ($i = 0; $i < $nb_indice; $i++) {
            enregistrer_indice($num_indice[$i], $prix[$i], $enonce[$i], $id_enigme);
        }

        header("location:index.php?alert=enigmeok");
        exit();
        break;

    //Envoyer un message
    case 'envoi_message':
        $date = date("Y-m-d H:i:s");
        $lu = 0;
        $image = NULL;
        $info_dest = authentifier_user($destinataire);
        if($info_dest == NULL){
            header("location:index.php?alert=usererror");
        }
        else{
            $id_dest = $info_dest[0]["id_user"];
            enregistrer_message($objet, $destinataire, $_SESSION["pseudo"], $texte, $date, $lu, $image, $id_dest);
            header("location:messagerie.php");
        }
        break;

    case 'acheter_indice':
        $info_user = select_by_id("user", "id_user", $_SESSION["id_user"]);
        $info_indice = select_by_id("indice", "id_indice", $id_indice);
        extract($info_user);
        $id_enigme = $info_indice["idEnigme"];
        if($point_user > $info_indice["prix"]){
            $point_user -= $info_indice["prix"];
            $indice_achete ++;
            modifier_user($id_user, $nom_user, $mdp_user, $mail, $statut, $idEnigme, $point_user, $indice_achete, $cle, $actif);
        } else {
            header("location:aide.php?code=$id_enigme&alert=pauvre");
        }
        header("location:aide.php?code=$id_enigme");
        break;
        
        /*
        * on clique sur mot de passe oublié
        * on arrive sur une page où on demande le pseudo + valider
        * on arrive sur génération de mot de passe ou sur traitement avec un mode particulier
        * ça envoie un mail avec un mot de passe généré dedans, sans mettre l'identifiant
        * on pourra rechanger le mot de passe plus tard
        */
    case 'mdp_oublie':
        if (empty($_SESSION['login'])) {
            $test = authentifier_user($nom_user);
            if (isset($test)){
                $info_user = select_by_id("user", "id_user", $test[0]["id_user"]);
                // Génération d'une chaine aléatoire
                $newmdp = mdp_aleatoire(8);
                extract($info_user);
                $new_encode_mdp = md5($newmdp);
                modifier_user($id_user, $nom_user, $new_encode_mdp, $mail, $statut, $idEnigme, $point_user, $indice_achete, $cle, $actif);

                // Préparation du mail contenant le lien d'activation
                $destinataire = $mail;
                $sujet = "Modifier votre mot de passe" ;
                $entete = "From: mystereetbouledenerfs@enigme.com" ;

                $message = "Bonjour,
                
                Voici votre nouveau mot de passe : ".$newmdp." 
                Nous vous conseillons vivement de le modifier via l'onglet Paramètres une fois que vous vous serez connecté !
                
                A bientôt sur Mystère et boule de nerfs.
                ---------------
                Ceci est un mail automatique, Merci de ne pas y répondre.";
                
                //echo "$destinataire, $sujet, $message, $entete";
                
                mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
               
                header("location: index.php?alert=newmdpmail");
            }
            else{
                header("location: index.php?alert=dejaconnecte");
            }
        }
        break;
        
    case 'chgmt_mdp':
        $infos_user = select_by_id("user", "id_user", $_SESSION["id_user"]);
        if($infos_user["mdp_user"] == md5($mdp_user_form) && $newmdp1 == $newmdp2){
            if($mdp_user_form != $newmdp1){
                extract($infos_user);
                $mdp_user = md5($newmdp1);
                modifier_user($id_user, $nom_user, $mdp_user, $mail, $statut, $idEnigme, $point_user, $indice_achete, $cle, $actif);
                header("location: mdp_user.php?alert=okmdp");
            } else {
                header("location: mdp_user.php?mode=new_mdp&alert=pareil");
            }
        } else {
            header("location: mdp_user.php?mode=new_mdp&alert=pbmdp");
        }
        break;
}

