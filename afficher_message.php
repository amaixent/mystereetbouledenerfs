<?php
session_start();
require ('main.inc.php');
if (empty($_SESSION['login'])) {
    header("location: index.php?alert=deconnecte");
}

if (isset($_GET) && !empty($_GET)) {
    extract($_GET);
}
$info_message = select_by_id("message", "id_message", $id);


if($mode == "recu" && ($info_message["idUser"] !== $_SESSION["id_user"])){
    header("location:index.php?alert=interditmessage");
    exit();
}
if($mode == "envoye" && ($info_message["expediteur"] !== $_SESSION["pseudo"])){
    header("location:index.php?alert=interditmessage");
    exit();
}
extract($info_message);
if(isset($lu) && $lu == 0){
    $lu = 1;
    modifier_message($id_message, $objet, $destinataire, $expediteur, $texte, $date, $lu, $image, $idUser);
}
?>
<!DOCTYPE html>
<html>
    <?php include("include/head.php");?>
    <body>
        <?php include("include/menu.php");
        
echo <<<MESSAGE
        <section class="msg_affich">
            <h1>Message : </h1>
            <p> Expéditeur : $expediteur. <br>
                Destinataire : $destinataire. <br>
                Date : $date
            </p> 
            <h3> Objet : </h3>
            <div class="msg_contenu">
                <p>$objet</p>
            </div>

            <h3> Contenu : </h3>
            <div class="msg_contenu">
                <p>$texte</p>
            </div>
            <a href="messagerie.php" class="display_inline_b"><button type="submit" type="button" class="btn btn-info" >Retour</button></a>
            <!--<a href="creer_message.php" class="display_inline_b repondre"><button type="submit" type="button" class="btn btn-info" >Répondre</button></a>-->

        </section>
MESSAGE;
         include("include/footer.php") ?>
    </body>
</html>