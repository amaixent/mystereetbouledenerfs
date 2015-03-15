<?php
//tableaux de fonctions
session_start();
require ('lib/main.php');
require ($cfg['ROOT_DIR'] . '/lib/parameters.inc.php');
require ($cfg['ROOT_DIR'] . '/lib/models/movies.inc.php');
require ($cfg['ROOT_DIR'] . '/lib/models/ipuser.inc.php');
require ($cfg['ROOT_DIR'] . '/lib/models/quizz.inc.php');
require ($cfg['ROOT_DIR'] . '/lib/models/questions.inc.php');
require ($cfg['ROOT_DIR'] . '/lib/models/propositions.inc.php');
// instancier les objets 

$oParameter = Parameter::getInstance($db);
$oMovie = Movie::getInstance($db);
$oQuizz = Quizz::getInstance($db);
$oQuestion = Question::getInstance($db);
$oProposition = Proposition::getInstance($db);

// extraire les informations en fonction de la méthode d'appel
if (isset($_GET) && !empty($_GET)) {
    extract($_GET);
}
//$param = $oParameter->getAll();
//$films = $oMovie->getAll();
// valeurs par défaut 
//if (empty($_GET)) {
if (isset($_POST) && !empty($_POST)) {
    extract($_POST);
}
switch ($mode) {

    // DELOG pour l'admin 
    case 'logout':
        $_SESSION['login'] = false;
        header("location:index.php");
        exit();
        break;


    // EFFACER un film 
    // paramètres complémentaires : 
    //  idmovie 
    case 'delete':
        $film = $oMovie->get($idmovie);
        deletethumbnail($film['poster']);
        $oMovie->delete($idmovie);
        header("location:filmo.php");
        exit();
        break;


    // EDITER  un  film 
    case 'edit':
        $film = $oMovie->get($idmovie);
        header("location:filmform.php?mode=edit&idmovie={$film['idmovie']}");
        break;

    // ENREGISTRER les modifications sur un film 
    // paramètres complémentaires : 
    //  idmovie, title, shortdesc, year 
    case 'editsave':
        extract($_POST);
        $film = $oMovie->get($idmovie);
        $file2upload = $_FILES["poster"]["name"]; //parcourir
        //debug($film);
        //debug($file2upload);
        if ($file2upload != "") {
            list($error, $image) = uploadImage("poster"); // cas où on change d'image
        } else {
            $file2upload = $film['poster']; // cas où on n'a pas changé d'image : on garde l'image de la BDD
        }
        //debug($file2upload, '$file2upload');
        $oMovie->edit($idmovie, array(
            'title' => $title,
            'shortdesc' => $shortdesc,
            'year' => $year,
            'poster' => $file2upload
                )
        );
        header("location:filmo.php");
        break;


    // AJOUTER un nouveau film 
    case 'add':
        header("location:filmform.php?mode=add");
        break;

    // ENREGISTRER les données d'un nouveau film 
    // paramètres complémentaires : 
    //  idmovie, title, shortdesc, year 
    case 'addsave':
        extract($_POST);
        $file2upload = $_FILES["poster"]["name"]; //parcourir
        uploadImage("poster");
        $oMovie->add(
                array(
                    'title' => $title,
                    'shortdesc' => $shortdesc,
                    'year' => $year,
                    'poster' => $file2upload
                )
        );
        //debug($film, '$film');
        header("location:filmo.php");
        break;


    // METTRE à jour le vote sur un lien
    // Paramètres complémentaires :
    //  rate, idlink

    case 'rate':
        $oIpuser = Ipuser::getInstance($db);
        $adrips = $oIpuser->getAll();
        foreach ($adrips as $adrip) {
            if ($adrip['ipuser'] === $ip) {
                header("location:filmo.php?mode=already");
                exit();
            }
        }
        // lire les informations sur le films ($rates, $crates)
        // enregistrement du vote
        extract($oMovie->get($idmovie));
        // mettre à jour le vote du lien
        //debug($ip, '$ip');
        $crates = (int) $crates + 1;
        $rates = $rates * (1 - 1 / $crates) + $rate / $crates;
        $oMovie->edit($idmovie, array('crates' => $crates, 'rates' => $rates));
        $oIpuser->add(array('idmovie' => $idmovie, 'ip' => $ip));
        echo number_format($rate, 1);

        break;

// ***************************AJOUTER - QUIZZ**************************************
    // Ajouter un nouveau quizz
    case 'addquizz':
        header("location:quizzform.php?mode=addquizz");
        break;
    // Enregistrer l'ajout d'un nouveau quizz
    case 'addquizzsave':
        extract($_POST);
        $ajout = $oQuizz->add(
                array(
                    'description' => $description
                )
        );
        header("location:quizzform.php?mode=addquestion&idquizz=$ajout");
        break;

    // Ajouter une nouvelle question
    case 'addquestion':
        header("location:quizzform.php?mode=addquestion&idquizz=$idquizz");
        break;

// Enregistrer l'ajout d'une nouvelle question
    case 'addquestionsave':
        extract($_POST);

        $ajout = $oQuestion->add(
                array(
                    'textequestion' => $question,
                    'idquizz' => $idquizz
                )
        );
        if (!empty($proposition1)) {
            $oProposition->add(
                    array(
                        'texteprop' => $proposition1,
                        'good' => $good1,
                        'idquestion' => $ajout,
                        'idquizz' => $idquizz
                    )
            );
        }
        if (!empty($proposition2)) {
            $oProposition->add(
                    array(
                        'texteprop' => $proposition2,
                        'good' => $good2,
                        'idquestion' => $ajout,
                        'idquizz' => $idquizz
                    )
            );
        }
        if (!empty($proposition3)) {
            $oProposition->add(
                    array(
                        'texteprop' => $proposition3,
                        'good' => $good3,
                        'idquestion' => $ajout,
                        'idquizz' => $idquizz
                    )
            );
        }
        if (!empty($proposition4)) {
            $oProposition->add(
                    array(
                        'texteprop' => $proposition4,
                        'good' => $good4,
                        'idquestion' => $ajout,
                        'idquizz' => $idquizz
                    )
            );
        }
        if (!empty($proposition5)) {
            $oProposition->add(
                    array(
                        'texteprop' => $proposition5,
                        'good' => $good5,
                        'idquestion' => $ajout,
                        'idquizz' => $idquizz
                    )
            );
        }
        header("location:quizzform.php?mode=addquestion&idquizz=$idquizz&idquestion=$ajout");
        break;

// ******************************EDITER - QUIZZ********************************
    //Editer un quizz
    case 'editquizz':
        header("location:quizzform.php?mode=editquizz&idquizz=$idquizz");
        break;
    //Enregistrer l'édition d'un quizz
    case 'editquizzsave':
        $oQuizz->edit($idquizz, array(
            'description' => $description
                )
        );
        header("location:quizz.php");
        break;

//Editer une question
    case 'editquestion':
        header("location:quizzform.php?mode=editquestion&idquestion=$idquestion");
        break;
//Enregistrer la modification d'une question
    case 'editquestionsave':
        extract($_POST);
        $idquestion = $oQuestion->edit($idquestion, array(
            'textequestion' => $question,
            'idquizz' => $idquizz
                )
        );
        header("location:quizzaff.php?idquizz=$idquizz");
        break;

    case 'editproposition':
        header("location:quizzform.php?mode=editproposition&idquestion=$idquestion&idquizz=$idquizz&idproposition=$idproposition");
        break;

    case 'editpropositionsave':
        $oProposition->edit($idproposition, array(
            'texteprop' => $proposition,
            'good' => $good,
            'idquestion' => $idquestion,
            'idquizz' => $idquizz
                )
        );
        header("location:quizzaff.php?idquizz=$idquizz");
        break;

// Ajouter une proposition
    case 'addproposition':
        header("location:quizzform.php?mode=addproposition&idquizz=$idquizz&idquestion=$idquestion");
        break;

    case 'addpropositionsave':
        $oProposition->add(
                array(
                    'texteprop' => $proposition,
                    'good' => $good,
                    'idquestion' => $idquestion,
                    'idquizz' => $idquizz
                )
        );
        header("location:quizzaff.php?idquizz=$idquizz");
        break;


// Supprimer la totalité d'un quizz
    case 'deletequizz':
        $questions = $oQuestion->getfordelete(array('idquizz' => intval($idquizz)));
        $propositions = $oProposition->getfordelete(array('idquizz' => intval($idquizz)));
        foreach ($propositions as $prop) {
            $oProposition->delete($prop);
        }
        foreach ($questions as $quest) {
            $oQuestion->delete($quest);
        }
        $oQuizz->delete($idquizz);
        header("location:quizz.php");
        break;

// Supprimer une question et ses propositions
    case 'deletequestion':
        $propositions = $oProposition->getfordelete(array('idquestion' => intval($idquestion)));
        foreach ($propositions as $prop) {
            if ($prop['idquestion'] == $idquestion) {
                $oProposition->delete($prop);
            }
        }
        $oQuestion->delete($idquestion);
        header("location:quizzaff.php?idquizz=$idquizz");
        break;

// Supprimer une proposition
    case 'deleteproposition':
        $oProposition->delete($idproposition);
        header("location:quizzaff.php?idquizz=$idquizz");
        break;

    case 'result':
        $quizz = $oQuizz->get($idquizz);
        $nbj = $quizz['nbrejoueur'] + 1;
        $oQuizz->edit($idquizz, array(
            'moy' => $moy,
            'nbrejoueur' => $nbj
                )
        );
        header("location:quizz.php");
        break;
}
//}
?>
