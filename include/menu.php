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
        <li> <a href="enigme.php?num=<?php echo $num_enigme ?>">Énigme en cours</a></li>
        <li> <a href="messagerie.php" class="nv_mess">Ma messagerie</a></li>
        <li> <a href="creation_enigme.php">Proposer une énigme</a></li>
        <li> <a href="#deconnexion">Déconnexion</a></li>
    </ul>
</header>
