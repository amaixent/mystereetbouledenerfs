<?php

/* Intègre l'entête de la page */

function getHeader() {

    $logout = '';
    if ($_SESSION['login'] === true) {
        $logout = "<a href=\"manage.php?mode=logout\"><button class=\"search_btn signout\"><i class=\"fa fa-sign-out\"></i></button></a>";
    }


    echo <<<HEADER
 <!-- barre de navigation --> 
  <div class="navbar">
    <div class="navbar-inner">
      <div class="search_box"> 
        <div class="wrapper">
          $logout
        </div> 
      </div>
      <ul class="nav"> 
        <li><a href="index.php">Intro</a></li> 
        <li id="filmo" class=""><a href="filmo.php">Filmographie</a></li> 
        <li id="bio" class=""><a href="bio.php">Biographie</a></li> 
        <li id="quizz" class=""><a href="quizz.php">Le quizz</a></li> 
      </ul> 
    </div> 
  </div>
HEADER;
}

function getFooter() {
    echo <<<FOOTER
    <div id="footer"  class="footer mt3 pt1 txtcenter">
            <p>Alice Maixent - Projet SRC 2013-2014 - Fan de Martin SCORSESE.</p>
        </div>
FOOTER;
}

/*
 * Enregistre une img téléchargée dans le dossier /images/films
 * Le format de l'image .jpg est vérifié
 * L'image est renommée si une image portant le même nom est déjà existante
 * L'image est redimensionnée à 800 px de large (hauteur proportionnelle
 * 
 * @param {string}      $file
 *                      le nom de l'élément file dans le formulaire
 * 
 * @return array
 *          un tableau avec deux éléments :
 *              - le statut de l'opération : true si une erreur, false sinon
 *              - le nom final de l'image telle qu'elle est enregistrée sur le disque
 * 
 * @code
 * list($error, $image) = uploadImage('file2upload');
 * @endcode
 */

function uploadImage($file) {
    //debug($_FILES[$file]['type'], '$_FILES[$file]["type"]');
    //$file = $image_source;
    if ($_FILES[$file]['type'] === 'image/jpeg') {
        $dir2save = dirname($_SERVER['SCRIPT_FILENAME']) . '/images/films';
        $image_source = $_FILES[$file]['tmp_name'];
        //$image_dest = "$dir2save/{$_FILES[$file]['name']}";
	
	//debug($dir2save, '$dir2save');
	//debug($image_source, '$image_source');
	
        $ext = 'jpg';
        $fichier = pathinfo($_FILES[$file]['name'], PATHINFO_FILENAME);
        $i = 1;
        $completename = $dir2save . '/' . $fichier . '.' . $ext;

        while (file_exists($completename)) {
            $completename = $dir2save . '/' . $fichier .'('. $i . ').' . $ext;
            $i++;
        }

        $image_dest = $completename;


        if (move_uploaded_file($image_source, $image_dest)) {
            //echo "Le fichier est valide; il a été téléchargé avec succès ! \n";

            //lire l'image d'origine
            $im = imagecreatefromjpeg($image_dest);
            list($width, $height) = getimagesize($image_dest);
            $r = $width / $height;
            $new_width = 800;
            $new_height = $new_width / $r;

            $im2 = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($im2, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($im2, $image_dest);
            //effacer les zones mémoire
            imagedestroy($im);
            imagedestroy($im2);
            $error = false;
        } else {
            $error = true;
            echo "Problème lors du téléchargement du fichier ! \n";
        }
    } else {
        $error = true;
        //echo "Le type d'image envoyée n'est pas conforme : doit être jpeg";
        /* header("location:upload.html");
          exit(); */
    }
    $filename = pathinfo($_FILES[$file]['name'], PATHINFO_BASENAME);
    return array($error, $filename);
}

/*
 * Effacer une image dans le dossier /images/films
 * @param {string}  $image
 *                  le nom du fichier image à effacer
 * @code
 * deletethumbnail('poster.png');
 * @endcode
 */

function deletethumbnail($image) {
    global $cfg;
    //debug($cfg['ROOT_DIR'] . "images/films/$image", 'image');
	@unlink($cfg['ROOT_DIR'] . "images/films/$image");
}
?>
