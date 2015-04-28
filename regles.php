<?php
session_start();
require ('main.inc.php');
?>
<!DOCTYPE html>
<html>
    <?php include("include/head.php");?>
    <body>
        <?php include("include/menu.php") ?>
        <div class="regles">
            <h1>Les règles : </h1>

            <h3>Les énigmes : </h3>
            <p>Pour répondre aux énigmes tous les moyens sont bons,
                vous pouvez utiliser vos neurones mais aussi internet. <br>
                Réfléchissez bien avant de demander de l'aide pour une énigme.
            </p>
            <h3>Répondre : </h3>
            <p> 
                Pour chaque énigme la réponse est un mot sans majuscule et sans symbole.
            </p>
            <h3>Les points : </h3>
            <p>
                Vous débutez le jeu avec un certain nombre de points.
                Ces points vous servent à acheter des indices lorsque vous bloquez sur une énigme. 
                Répondre correctement à une énigme vous rapporte des points.<br>
                Vous pouvez consulter à tout moment votre nombre de point dans la barre de navigation
            </p>
            <h3>Proposer une énigme :</h3>
            <p>
                À tout moment vous pouvez proposer une énigme depuis la barre de navigation.<br>
                Attention vous ne devez proposer que des énigmes dont vous êtes l'auteur et dont l'image l'illustrant est libre de droit. 
                En proposant une énigme vous nous autorisez à l'exploiter sur ce site.<br>  
                Une énigme doit être composée d'un titre, d'une image (libre de droit et de résolution correcte), d'un ennoncé, d'une réponse en un mot et d'indices.
            </p>
            <h3>Besoin d'aide sur une énigme : </h3>
            <p>
                Si vous êtes bloqué sur une énigme vous pouvez cliquer sur le boutton "Besoin d'aide" disponible sous l'énigme.
                Sur cette page vous pourrez acheter des indices et envoyer un message aux administrateurs.
                <br>
                Vous ne pourrez envoyer un massage pour demander de l'aide que si vous n'avez plus de points pour acheter des indices 
                ou que vous avez acheté tous les indices de l'énigme. </p>

            <h3>Nous contacter :</h3>
            <p> 
                À tout moment si vous avez un problème dans le jeu ou des remarques, vous pouvez nous envoyer depuis votre messagerie un message  à : pseudo-aide.
            </p>
            <a href="index.php" class="btn"><button type="submit" type="button" class="btn btn-info" >Retour</button></a>
        </div>

        <?php include("include/footer.php") ?>


    </body>

</html>


