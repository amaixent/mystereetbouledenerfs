<?php
require('bdd.php');
// CHANGER EN FONCTION DU NOM DE LA BASE DE DONNEES
$nom_bdd = 'site_enigme';


// Connexion à la BDD, avec test pour voir s'il n'y a pas d'erreur
try {
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=$nom_bdd;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    echo 'Erreur connexion : ', $e->getMessage();
    exit();
}

/*
 * Ce qui concerne les utilisateurs :
 */

function enregistrer_user($nom_user, $mdp_user, $mail) {
    //$query = mysql_query("INSERT INTO $base.user (id_user, nom_user, mdp_user, mail, statut, idEnigme, point_user) VALUES (NULL, '$nom_user', '$mdp_user',  '$mail', 'joueur', '0', '10')");
    // :: car fonction "static"
    $req = Database::get()->prepare_execute_add_up_del("INSERT INTO user (id_user, nom_user, mdp_user, mail, statut, idEnigme, point_user) VALUES (NULL, :nom_user, :mdp_user,  :mail, 'joueur', '0', '10')", array(
        'nom_user' => $nom_user,
        'mdp_user' => $mdp_user,
        'mail' => $mail
    ));
    return $req;
}

function modifier_user($id_user, $nom_user, $mdp_user, $mail, $statut, $idEnigme, $point_user) {

    $req = Database::get()->prepare_execute_add_up_del("UPDATE user SET nom_user = :nom_user, mdp_user = :mdp_user, mail = :mail, statut = :statut, idEnigme = :idEnigme, point_user = :point_user WHERE id_user = :id_user", array(
        'nom_user' => $nom_user,
        'mdp_user' => $mdp_user,
        'mail' => $mail,
        'statut' => $statut,
        'idEnigme' => $idEnigme,
        'point_user' => $point_user,
        'id_user' => $id_user
    ));
    return $req;
}

function authentifier_user($nom_user) {
    //SELECT `id_user`, `mdp_user` FROM `user` WHERE `nom_user`='pseudo';
    //On prépare la requête car une variable est présente dedans, cela pour éviter les injections
    $req = Database::get()->prepare_execute("SELECT id_user, mdp_user FROM user WHERE nom_user = ?", $nom_user);
    // le ? est remplacé par la variable $nom_user
    return $req;
}

function select_by_id($table, $idparam, $id) {
    /* exemple : select_by_id('user', 'id_user', 2) */
    $req = Database::get()->get_by_id($table, $idparam, $id);
    return $req;
}

/* Qu’il puisse acheter les indices de l’énigme

  SELECT `point`, `enonce` FROM `indice` WHERE `idEnigme`='1', `num_indice`='2';
  On vérifie si le joueur a assez de points pour acheter l'indice
  si oui on affiche l'indice et :
  UPDATE `user` SET `point` = point-prix `user`.`id_user` = 3; */

function effacer_user($base, $id_user) {
    //DELETE FROM jeux_video WHERE nom='Battlefield 1942'
    $req = $base->prepare("DELETE FROM user "
            . "WHERE id_user =?");
    $req->execute(array($id_user));
    return $req;
}

/* * *****************************
 * Ce qui concerne les énigmes
 * ***************************** */

function enregistrer_enigme($base, $titre, $enonce, $image, $reponse, $point, $num_enigme, $auteur_id) {
    //INSERT INTO `enigme` (`id_enigme`, `titre`, `enonce`, `image`, `reponse`, `point`, `num_enigme`, `auteur_id`) 
    //VALUES (NULL, 'titre de l'énigme', '2NONC2 texte blebleble oFHEQZILJDKBF',  'cupcake.gif', 'banane' , '1', '7', '3');

    $req = $base->prepare("INSERT INTO enigme "
            . "(id_enigme, titre, enonce, image, reponse, point, num_enigme, auteur_id)"
            . "VALUES (NULL, :titre,  :enonce, :image, :reponse, :point, :num_enigme, :auteur_id)");
    $req->execute(array(
        'titre' => $titre,
        'enonce' => $enonce,
        'image' => $image,
        'reponse' => $reponse,
        'point' => $point,
        'num_enigme' => $num_enigme,
        'auteur_id' => $auteur_id
    ));

    return $req;
}

function modifier_enigme($base, $id_enigme, $titre, $enonce, $image, $reponse, $point, $num_enigme, $auteur_id) {
    $req = $base->prepare("UPDATE enigme "
            . "SET titre = :titre, enonce = :enonce, image = :image, reponse = :reponse, point = :point, num_enigme = :num_enigme, auteur_id = :auteur_id "
            . "WHERE id_enigme = :id_enigme");
    $req->execute(array(
        'titre' => $titre,
        'enonce' => $enonce,
        'image' => $image,
        'reponse' => $reponse,
        'point' => $point,
        'num_enigme' => $num_enigme,
        'auteur_id' => $auteur_id,
        'id_enigme' => $id_enigme
    ));
    return $req;
}


function effacer_enigme($base, $id_enigme) {
    $req = $base->prepare("DELETE FROM enigme "
            . "WHERE id_enigme =?");
    $req->execute(array($id_enigme));
    return $req;
}

/* * ****************************
 * Ce qui concerne les indices
 * **************************** */

function enregistrer_indice($base, $num_indice, $prix, $enonce, $idEnigme) {
    //INSERT INTO `indice` (`id_indice`, `num_indice`, `prix`, `enonce`, `idEnigme`) VALUES (NULL, '1', '1', 'enonce de l'indice',  '7');

    $req = $base->prepare("INSERT INTO indice "
            . "(id_indice, num_indice, prix, enonce, idEnigme) "
            . "VALUES (NULL, :num_indice, :prix, :enonce, :idEnigme)");
    $req->execute(array(
        'num_indice' => $num_indice,
        'prix' => $prix,
        'enonce' => $enonce,
        'idEnigme' => $idEnigme
    ));
    return $req;
}

function modifier_indice($base, $id_indice, $num_indice, $prix, $enonce, $idEnigme) {
    $req = $base->prepare("UPDATE indice "
            . "SET num_indice = :num_indice, prix = :prix, enonce = :enonce, idEnigme = :idEnigme "
            . "WHERE id_indice = :id_indice");
    $req->execute(array(
        'num_indice' => $num_indice,
        'prix' => $prix,
        'enonce' => $enonce,
        'idEnigme' => $idEnigme,
        'id_indice' => $id_indice
    ));
    return $req;
}


function select_point_indice($base, $idEnigme, $num_indice) {

    //SELECT `point`, `enonce` FROM `indice` WHERE `idEnigme`='1', `num_indice`='2';
    //SELECT `prix`, `enonce`FROM `indice` WHERE `num_indice` = 1 

    $req = $base->prepare("SELECT prix, enonce "
            . "FROM indice "
            . "WHERE idEnigme = :idEnigme AND num_indice = :num_indice");

    $req->execute(array(
        'idEnigme' => $idEnigme,
        'num_indice' => $num_indice
    ));
    return $req;
}

function effacer_indice($base, $id_indice) {
    $req = $base->prepare("DELETE FROM indice "
            . "WHERE id_indice =?");
    $req->execute(array($id_indice));
    return $req;
}

/* * ****************************
 * Ce qui concerne les messages
 * **************************** */

function enregistrer_message($base, $objet, $destinataire, $expediteur, $texte, $date, $lu, $image, $idUser) {
    //INSERT INTO `message` (`id_message`, `objet`, `destinataire`, `expediteur`, `texte`, `date`, `lu`, `image`, `idUser`) 
    //VALUES (NULL, 'un objet', 'pseudo destinataire',  'pseudo expéditeur', 'texte du message', '2015-02-24', '0', 'poney.jpg', '3');

    $req = $base->prepare("INSERT INTO message "
            . "(id_message, objet, destinataire, expediteur, texte, date, lu, image, idUser) "
            . "VALUES (NULL, :objet, :destinataire, :expediteur, :texte, :date, :lu, :image, :idUser)");
    $req->execute(array(
        'objet' => $objet,
        'destinataire' => $destinataire,
        'expediteur' => $expediteur,
        'texte' => $texte,
        'date' => $date,
        'lu' => $lu,
        'image' => $image,
        'idUser' => $idUser
    ));
    return $req;
}

function select_message_by_idUser($base, $select, $idUser) {
    $req = $base->prepare("SELECT :select "
            . "FROM message "
            . "WHERE idUser = :idUser");
    $req->execute(array(
        'select' => $select,
        'idUser' => $idUser
    ));
    return $req;
}

function select_messages_envoyes($base, $select, $expediteur) {
    //SELECT `id_message` FROM `message` WHERE `expediteur`='pseudo';
    $req = $base->prepare("SELECT :select "
            . "FROM message "
            . "WHERE expediteur = :expediteur");
    $req->execute(array(
        'select' => $select,
        'expediteur' => $expediteur
    ));
    return $req;
}

function effacer_message($base, $id_message) {
    $req = $base->prepare("DELETE FROM message "
            . "WHERE id_message =?");
    $req->execute(array($id_message));
    return $req;
}

//turtoise git
?>﻿