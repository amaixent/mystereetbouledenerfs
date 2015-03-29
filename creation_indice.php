<?php
session_start();
require ('main.inc.php');
if (empty($_SESSION['login'])) {
    header("location: index.php?alert=deconnecte");
}
if (isset($_GET) && !empty($_GET)) {
    extract($_GET);
}

if (isset($_POST) && !empty($_POST)) {
    extract($_POST);
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
        <?php include("include/menu.php"); ?>
        
            <section class="indice_crea">
            <h1>Créer un / des indice(s)</h1>
            <br>
        <?php
        echo "<form action='traitement.php?mode=crea_indice&id_enigme=$id_enigme&nb_indice=$nb_indice' method='post'>";
        for($i=0; $i<$nb_indice; $i++){
            $num = $i+1;
            echo <<<FORM
                <div class="form-group">
                    <label for="num_indice">Numéro de l'indice :</label>
                    <input type="number" class="form-control" id="num_indice" name="num_indice[$i]" value="$num" required/>
                </div>
                <div class="form-group">
                    <label for="prix">Points (minimum 2) :</label>
                    <input type="number"  class="form-control" id="prix" name="prix[$i]" required/>
                </div>
                <div class="form-group">
                    <label for="enonce">Enoncé :</label>
                    <textarea id="enonce"  class="form-control" name="enonce[$i]" required></textarea>
                </div>
FORM;
        }
        ?>
                <div class="button btn_indice ">
                    <button type="submit" type="button" class="btn btn-info">Créer l'indice</button>
                </div>
                
            </form>
        </section>
        <a href="creation_enigme.php" class="btn_indic_pre">
            <button type="submit" type="button" class="btn btn-info">Précedent</button>
        </a>

       <?php include("include/footer.php") ?>

    </body>

</html>