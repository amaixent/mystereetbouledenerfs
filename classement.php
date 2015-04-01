<?php
session_start();
require ('main.inc.php');

$classement = select_classement();

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
        <?php include("include/menu.php") ?>
        <section class="classement">
            <h3>Classement</h3>
                <div class="row">
                    <div class="col-md-3">RANG</div>
                    <div class="col-md-3">| PSEUDO</div>
                    <div class="col-md-3">| NIVEAU</div>
                    <div class="col-md-3">| POINTS</div>
                </div>


                <?php
                if (!empty($classement)) {
                    foreach ($classement as $numrang => $rang) {
                        $num = $numrang + 1;
                        $pseudo = $rang['nom_user'];
                        $niveau = $rang['idEnigme'];
                        $points = $rang['point_user'];

                        echo <<<MESSAGE
                <div class="row">
                    <div class="col-md-3">$num</div>
                    <div class="col-md-3">$pseudo</div>
                    <div class="col-md-3">$niveau</div>
                    <div class="col-md-3">$points</div>
                </div>
MESSAGE;
                    }
                } else {
                    echo "<div class='row'>
                                Aucun message reçu.
                            </div>";
                }
                ?>
        </section>

        <?php include("include/footer.php") ?>


    </body>

</html>


