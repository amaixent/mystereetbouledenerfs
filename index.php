<?php
require 'main.inc.php';


//TEST - attention si ça marche, ça va être entré dans la BDD autant de fois qu'on recharge la page
//$result = modifier_user(3, "Nouveaunom", "newmdp", "newmail", "joueur", 1, "30");
enregistrer_enigme('titre énigme num blablablablabla', 'super énoncé êogjepzmiqjrekdlqfnre gptjzig fohde ouf !!', 'imageX.jpg', 'reponseeee', 3, 1, 1);

//enregistrer_indice(1, 1, 'enonce indice enigme 2',  2);

/*$resultat = select_by_id('enigme', 'id_enigme', '2');
echo '<br>',$resultat['titre'],'<br>',$resultat['enonce'],'<br>';*/



// On affiche chaque entrée une à une


?>