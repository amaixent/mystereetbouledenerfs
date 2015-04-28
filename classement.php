<?php
session_start();
require ('main.inc.php');

$classement = select_classement();

?>
<!DOCTYPE html>
<html>
    <?php include("include/head.php");?>
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


