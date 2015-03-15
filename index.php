<?php
require 'main.inc.php';


//TEST - attention si ça marche, ça va être entré dans la BDD autant de fois qu'on recharge la page
$result = modifier_user(3, "Nouveaunom", "newmdp", "newmail", "joueur", 1, "30");
//enregistrer_enigme($base, 'titre énigme num3', 'super énoncé de ouf !!', 'image3.jpg', 'reponse', 3, 1, 2);

//enregistrer_indice($base, 1, 1, 'enonce indice enigme 2',  2);

/*$resultat = select_by_id('enigme', 'id_enigme', '2');
echo '<br>',$resultat['titre'],'<br>',$resultat['enonce'],'<br>';*/



// On affiche chaque entrée une à une


?>