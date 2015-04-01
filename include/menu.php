    <header id="navbar" class="navbar-collapse collapse bar_sup">
    <?php
    if (!empty($_SESSION)) {
        if ($_SESSION['login'] == true) {
            $pseudo = $_SESSION['pseudo'];
            $select = select_by_id('user', 'id_user', $_SESSION['id_user']);
            $nbpoint = $select['point_user'];
            
            //Récupération de l'id_enigme en cours de résolution par le joueur
            $num = $select["idEnigme"];
            $enigme = select_enigme_by_num($num);
            $id = $enigme[0]["id_enigme"];
            echo "<p>Bonjour $pseudo, vous avez $nbpoint points.</p>";
        }
    }
    ?>
    <ul class="nav navbar-nav links">
        <li> <a href="index.php" class="nav_color">Accueil</a></li>
        <li> <a href="regles.php" class="nav_color">Les règles</a></li>

        <?php
        if (!empty($_SESSION)) {
            if ($_SESSION['login'] == true) {
                /*
                 * Une autre façon de faire un echo mais sur plusieurs lignes avec 
                  echo <<<NIMPORTEQUOI
                  blablabla contenu du echo
NIMPORTEQUOI;
                 * surtout coller la fin du echo au bord et ne rien laisser sur la même ligne (même pas d'espace ! sinon ça marche pas
                 * Dans ce type d'echo, les variables sont interprétées, sauf si tu veux afficher un truc du type $tab['id_user'] il faut écrire : {$tab['id_user']}
                 */
                
                echo <<<HEADER
        <li> <a href="enigme.php?code=$id" class="nav_color">Énigme en cours</a></li>
        <li> <a href="messagerie.php" class="nv_mess">Ma messagerie</a></li>
        <li> <a href="creation_enigme.php" class="nav_color">Proposer une énigme</a></li>
        <li> <a href="classement.php" class="nav_color">Classement</a></li>
        <li> <a href="traitement.php?mode=logout" class="nav_color">Déconnexion</a></li>
HEADER;
            }
        }
        ?>

    </ul>
</header>
