<?php
require('bdd.php');
// CHANGER EN FONCTION DU NOM DE LA BASE DE DONNEES
$nom_bdd = 'site_enigme';
/*
 * Ce qui concerne les utilisateurs :
 */

function enregistrer_user($nom_user, $mdp_user, $mail) {
    //$query = mysql_query("INSERT INTO $base.user (id_user, nom_user, mdp_user, mail, statut, idEnigme, point_user) VALUES (NULL, '$nom_user', '$mdp_user',  '$mail', 'joueur', '0', '10')");
    // :: car fonction "static"
    $req = Database::get()->prepare_execute_add_up_del("INSERT INTO user (id_user, nom_user, mdp_user, mail, statut, idEnigme, point_user) VALUES (NULL, :nom_user, :mdp_user,  :mail, 'joueur', '0', '10')", 
    array(
        'nom_user' => $nom_user,
        'mdp_user' => $mdp_user,
        'mail' => $mail
    ));
    return $req;
}

function modifier_user($id_user, $nom_user, $mdp_user, $mail, $statut, $idEnigme, $point_user) {

    $req = Database::get()->prepare_execute_add_up_del("UPDATE user SET nom_user = :nom_user, mdp_user = :mdp_user, mail = :mail, statut = :statut, idEnigme = :idEnigme, point_user = :point_user WHERE id_user = :id_user", 
    array(
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

function effacer_user($id_user) {
    //DELETE FROM jeux_video WHERE nom='Battlefield 1942'
    $req = Database::get()->prepare_execute_add_up_del("DELETE FROM user WHERE id_user =?", array($id_user));
    return $req;
}

/* * *****************************
 * Ce qui concerne les énigmes
 * ***************************** */

function enregistrer_enigme($titre, $enonce, $image, $reponse, $point, $num_enigme, $auteur_id) {
    //INSERT INTO `enigme` (`id_enigme`, `titre`, `enonce`, `image`, `reponse`, `point`, `num_enigme`, `auteur_id`) 
    //VALUES (NULL, 'titre de l'énigme', '2NONC2 texte blebleble oFHEQZILJDKBF',  'cupcake.gif', 'banane' , '1', '7', '3');
    $req = Database::get()->prepare_execute_add_up_del("INSERT INTO enigme (id_enigme, titre, enonce, image, reponse, point, num_enigme, auteur_id) VALUES (NULL, :titre,  :enonce, :image, :reponse, :point, :num_enigme, :auteur_id)", 
    array(
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

function modifier_enigme($id_enigme, $titre, $enonce, $image, $reponse, $point, $num_enigme, $auteur_id) {
    $req = Database::get()->prepare_execute_add_up_del("UPDATE enigme SET titre = :titre, enonce = :enonce, image = :image, reponse = :reponse, point = :point, num_enigme = :num_enigme, auteur_id = :auteur_id WHERE id_enigme = :id_enigme",
    array(
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


function effacer_enigme($id_enigme) {
    $req = Database::get()->prepare_execute_add_up_del("DELETE FROM enigme WHERE id_enigme =?", array($id_enigme));
    return $req;
}

/* * ****************************
 * Ce qui concerne les indices
 * **************************** */

function enregistrer_indice($num_indice, $prix, $enonce, $idEnigme) {
    //INSERT INTO `indice` (`id_indice`, `num_indice`, `prix`, `enonce`, `idEnigme`) VALUES (NULL, '1', '1', 'enonce de l'indice',  '7');

    $req = Database::get()->prepare_execute_add_up_del("INSERT INTO indice (id_indice, num_indice, prix, enonce, idEnigme) VALUES (NULL, :num_indice, :prix, :enonce, :idEnigme)",
    array(
        'num_indice' => $num_indice,
        'prix' => $prix,
        'enonce' => $enonce,
        'idEnigme' => $idEnigme
    ));
    return $req;
}

function modifier_indice($id_indice, $num_indice, $prix, $enonce, $idEnigme) {
    $req = Database::get()->prepare_execute_add_up_del("UPDATE indice SET num_indice = :num_indice, prix = :prix, enonce = :enonce, idEnigme = :idEnigme WHERE id_indice = :id_indice",
    array(
        'num_indice' => $num_indice,
        'prix' => $prix,
        'enonce' => $enonce,
        'idEnigme' => $idEnigme,
        'id_indice' => $id_indice
    ));
    return $req;
}


function select_point_indice($idEnigme, $num_indice) {

    //SELECT `point`, `enonce` FROM `indice` WHERE `idEnigme`='1', `num_indice`='2';
    //SELECT `prix`, `enonce`FROM `indice` WHERE `num_indice` = 1 

    $req = Database::get()->prepare_execute("SELECT prix, enonce FROM indice WHERE idEnigme = :idEnigme AND num_indice = :num_indice",
    array(
        'idEnigme' => $idEnigme,
        'num_indice' => $num_indice
    ));
    return $req;
}

function effacer_indice($id_indice) {
    $req = Database::get()->prepare_execute_add_up_del("DELETE FROM indice WHERE id_indice =?",
    array($id_indice));
    return $req;
}

/* * ****************************
 * Ce qui concerne les messages
 * **************************** */

function enregistrer_message($objet, $destinataire, $expediteur, $texte, $date, $lu, $image, $idUser) {
    //INSERT INTO `message` (`id_message`, `objet`, `destinataire`, `expediteur`, `texte`, `date`, `lu`, `image`, `idUser`) 
    //VALUES (NULL, 'un objet', 'pseudo destinataire',  'pseudo expéditeur', 'texte du message', '2015-02-24', '0', 'poney.jpg', '3');

    $req = Database::get()->prepare_execute_add_up_del("INSERT INTO message (id_message, objet, destinataire, expediteur, texte, date, lu, image, idUser) VALUES (NULL, :objet, :destinataire, :expediteur, :texte, :date, :lu, :image, :idUser)",
    array(
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

function select_message_by_idUser($select, $idUser) {
    $req = Database::get()->prepare_execute("SELECT :select FROM message WHERE idUser = :idUser",
    array(
        'select' => $select,
        'idUser' => $idUser
    ));
    return $req;
}

function select_messages_envoyes($select, $expediteur) {
    //SELECT `id_message` FROM `message` WHERE `expediteur`='pseudo';
    $req = Database::get()->prepare_execute("SELECT :select FROM message WHERE expediteur = :expediteur",
    array(
        'select' => $select,
        'expediteur' => $expediteur
    ));
    return $req;
}

function effacer_message($id_message) {
    $req = Database::get()->prepare_execute_add_up_del("DELETE FROM message WHERE id_message =?",
    array($id_message));
    return $req;
}

//turtoise git
?>﻿