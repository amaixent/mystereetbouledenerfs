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
    <head>	
        <meta charset="utf-8"/>    
        <title>Mystereetbouledenerf</title>
        <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="css/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    </head>
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