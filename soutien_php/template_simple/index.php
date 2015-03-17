<?php
require('view.php');

/* traitements */
$titre = 'Ma page';
$nom = 'Grégoire';

/* Affichage */
$vue = new View('simple.html');
$vue->set(['TITRE' => $titre,'NOM' => $nom]);
$vue->display();
?>