<header id="navbar" class="navbar-collapse collapse bar_sup">
<?php
if($_SESSION['login'] == true){
    $pseudo = $_SESSION['pseudo'];
    $select = select_by_id_notall('point_user, idEnigme','user', 'id_user', $_SESSION['id_user']);
    $nbpoint = $select['point_user'];
    $num_enigme = $select['idEnigme'];
    echo "<p>Bonjour $pseudo, vous avez $nbpoint points.</p>"; 
}
?>
    <ul class="nav navbar-nav links">
        <li> <a href="regles.php">Les règles</a></li>
        
<?php
if($_SESSION['login'] == true){
    /*
     * Une autre façon de faire un echo mais sur plusieurs lignes avec 
echo <<<NIMPORTEQUOI
    blablabla contenu du echo
NIMPORTEQUOI; surtout coller la fin du echo au bord et ne rien laisser sur la même ligne (même pas d'espace ! sinon ça marche pas
     * Dans ce type d'echo, les variables sont interprétées, sauf si tu veux afficher un truc du type $tab['id_user'] il faut écrire : {$tab['id_user']}
     */
echo <<<HEADER
        <li> <a href="enigme.php?num=$num_enigme">Énigme en cours</a></li>
        <li> <a href="messagerie.php" class="nv_mess">Ma messagerie</a></li>
        <li> <a href="creation_enigme.php">Proposer une énigme</a></li>
        <li> <a href="traitement.php?mode=logout">Déconnexion</a></li>
HEADER;
}
?>

    </ul>
</header>
