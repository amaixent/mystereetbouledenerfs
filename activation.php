<?php

session_start();
require ('main.inc.php');
// Récupération des variables nécessaires à l'activation
$login = $_GET['log'];
$cleget = $_GET['cle'];

//echo "<br><br>login : $login, cleget : $cleget <br><br>";

$user = authentifier_user($login);
//echo "<br><br>user : <br><br>";
//var_dump($user);
$user_info = select_by_id("user", "id_user", $user[0]["id_user"]);
//echo "<br><br>user_info : <br><br>";
//var_dump($user_info);

// On teste la valeur de la variable $actif récupéré dans la BDD
if ($user_info["actif"] == '1') { // Si le compte est déjà actif on prévient
    header("location:index.php?alert=dejaactif");
} else { // Si ce n'est pas le cas on passe aux comparaisons
    if ($cleget == $user_info["cle"]) { // On compare nos deux clés	
        // Si elles correspondent on active le compte !
        extract($user_info);
        //echo "<br><br>user_info : <br><br>";
        //var_dump($user_info);
        $actif = 1;
        // La requête qui va passer notre champ actif de 0 à 1
        modifier_user($id_user, $nom_user, $mdp_user, $mail, $statut, $idEnigme, $point_user, $indice_achete, $cle, $actif);
        header("location:index.php?alert=connectezvous");
    } else { // Si les deux clés sont différentes on provoque une erreur...
        header("location:index.php?alert=pbactiv");
    }
}
?>