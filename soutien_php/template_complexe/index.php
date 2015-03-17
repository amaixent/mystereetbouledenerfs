<?php
require('view.php');

/* traitements */
$titre = 'liste de nombre';
$type = 'nombre';
$data = [['TEXTE' => '1'],['TEXTE' => '2'],['TEXTE' => '5'],['TEXTE' => '4'],['TEXTE' => '9']];


/* Configuration des vues */
$header = new View('header.html');
$header->set(['TITRE' => $titre]);
$header->setLoop(['CSS' => [['PATH' => 'a.css'],['PATH' => 'b.css'],['PATH' => 'c.css']]]);

$liste = new View('liste.html');
$liste->set(['TYPE' => $type]);
$liste->setLoop(['LISTE' => $data]);

$footer = new View('footer.html');
$footer->setLoop(['JS' => [['PATH' => 'script.js']]]);

/* Affichage des vues */ 

$header->display();
$liste->display();
$footer->display();
?>