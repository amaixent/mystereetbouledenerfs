<?php
$link = mysql_connect("localhost", "root", "")
        or die("Impossible de se connecter : " . mysql_error());
echo 'Connexion réussie';

// CHANGER EN FONCTION DU NOM DE LA BASE DE DONNEES
$base = 'site_enigme';

//Fonction de vérification des requêtes ; comme c'est la même chose à chaque fois mieux vaut mettre ça dans une fonction réutilisable
function verif($req) {
    // Affichage de la requête, à commenter si on n'a plus besoin de tester !
    echo "<br />", "18 Requete_Insertion", "<pre>", print_r($req), "</pre>";

    $result = mysql_query($req);
    //Vérification du bon fonctionnement de l'envoi de la requête - affiche les problèmes
    if (!$result) {
        $message = 'Requête invalide : ' . mysql_error() . "\n";
        $message .= 'Requête complète : ' . $req;
        die($message);
    }
}

/*
 * Ce qui concerne l'enregistrement et l'authentification d'un utilisateur:
 */

function enregistrer_user($base, $nom_user, $mdp_user, $mail) {
    //$query = mysql_query("INSERT INTO $base.user (id_user, nom_user, mdp_user, mail, statut, idEnigme, point_user) VALUES (NULL, '$nom_user', '$mdp_user',  '$mail', 'joueur', '0', '10')");

    $req = sprintf("INSERT INTO user "
            . "(id_user, nom_user, mdp_user, mail, statut, idEnigme, point_user) "
            . "VALUES (NULL, '$nom_user', '$mdp_user',  '$mail', 'joueur', '0', '10')");

    verif($req);

    return $req;
}

function authentifier_user($base,$nom_user){
    //SELECT `id_user`, `mdp_user` FROM `user` WHERE `nom_user`='pseudo';
    $req = sprintf("SELECT id_user, mdp_user "
            . "FROM user "
            . "WHERE nom_user='$nom_user'");
//$base.user
    verif($req);
    
    return $req;
}



function enregistrer_enigme($base, $titre,  $enonce, $image, $reponse, $point, $num_enigme, $auteur_id) {
    //INSERT INTO `enigme` (`id_enigme`, `titre`, `enonce`, `image`, `reponse`, `point`, `num_enigme`, `auteur_id`) 
    //VALUES (NULL, 'titre de l'énigme', '2NONC2 texte blebleble oFHEQZILJDKBF',  'cupcake.gif', 'banane' , '1', '7', '3');
    
    $req = sprintf("INSERT INTO enigme "
            . "(id_enigme, titre, enonce, image, reponse, point, num_enigme, auteur_id)"
            . "VALUES (NULL, '$titre',  '$enonce', '$image', '$reponse', '$point', '$num_enigme', '$auteur_id')");

    verif($req);

    return $req;
}


function enregistrer_indice($base, $num_indice,  $prix, $enonce, $idEnigme) {
    //INSERT INTO `indice` (`id_indice`, `num_indice`, `prix`, `enonce`, `idEnigme`) VALUES (NULL, '1', '1', 'enonce de l'indice',  '7');
    
    $req = sprintf("INSERT INTO indice "
            . "(id_indice, num_indice, prix, enonce, idEnigme) "
            . "VALUES (NULL, '$num_indice',  '$prix', '$enonce', '$idEnigme')");

    verif($req);

    return $req;
}

?>