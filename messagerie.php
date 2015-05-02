<?php
session_start();
require ('main.inc.php');
if (empty($_SESSION['login'])) {
    header("location: index.php?alert=deconnecte");
}
if (isset($_POST) && !empty($_POST)) {
    extract($_POST);
}
if (isset($_GET) && !empty($_GET)) {
    extract($_GET);
}

/*
 *
 * A FAIRE : MESSAGES ENVOYES 
 * 
 */



//Sélection de tous les messages correspondant à $_SESSION["id_user"] (id du joueur)
$messages = select_all("message", "idUser", $_SESSION["id_user"]);
$messages_envoyes = select_all("message", "expediteur", $_SESSION["pseudo"]);



/* Résultat de la forme    $message[0] -> tout le message 0
 *                          $message[1] -> tout le message 1
 */
?>
<!DOCTYPE html>
<html>
    <?php include("include/head.php");?>
    <body> 
        <?php
        include("include/menu.php") 
        ?>

        <section class="bienvenue">
            <h1>Bienvenue sur votre messagerie.</h1>
        </section>
        <a  href="creer_message.php?mode=new" ><button type="submit" type="button" class="btn btn-info btn_nv_message" >Nouveau message</button></a>
        <section class="messagerie">
            <h3>Messages reçus : </h3>
            <div class="messagerie_contenu">
                <div class="row">
                    <div class="col-md-5">EXPÉDITEUR : </div>
                    <div class="col-md-4">| OBJET : </div>
                </div>


                <?php
                if (!empty($messages)) {
                    foreach (array_reverse($messages) as $message) {
                        $id_message = $message['id_message'];
                        $expediteur = $message['expediteur'];
                        $objet = $message['objet'];
                        $lu = $message["lu"];
                        $classeLu = ' message_non_lu';
                        if($lu == 1){
                            $classeLu = ' message_lu';
                        }

                        echo <<<MESSAGE
                <div class="row">
                    <a href="afficher_message.php?id=$id_message&mode=recu" >
                        <div class="col-md-5$classeLu">
                            $expediteur
                        </div>
                        <div class="col-md-4$classeLu">
                            $objet
                        </div>
                    </a>
                </div>
MESSAGE;
                    }
                } else {
                    echo "<div class='row'>
                                Aucun message reçu.
                            </div>";
                }
                ?>
            </div>
        </section>
        <section class="messagerie">
            <h3>Messages envoyés : </h3>
            <div class="messagerie_contenu">
                <div class="row">
                    <div class="col-md-5">DESTINATAIRE : </div>
                    <div class="col-md-4">| OBJET : </div>
                </div>

                <?php
                if (!empty($messages_envoyes)) {
                    foreach (array_reverse($messages_envoyes) as $message) {
                        $id_message = $message['id_message'];
                        $destinataire = $message['destinataire'];
                        $objet = $message['objet'];
                        $lu = $message['lu'];
                        echo <<<MESSAGE
                <div class="row">
                    <a href="afficher_message.php?id=$id_message&mode=envoye" >
                        <div class="col-md-5 message_lu">
                            $destinataire
                        </div>
                        <div class="col-md-4 message_lu">
                            $objet
                        </div>
                    </a>
                </div>
MESSAGE;
                    }
                } else {
                    echo "<div class='row'>
                                Aucun message envoyé.
                            </div>";
                }
                ?>
            </div>




        </section>
        
        <?php include("include/footer.php") ?>
    </body>

</html>