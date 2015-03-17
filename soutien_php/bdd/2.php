<?php
require('bdd.php');
$resultats = Database::get()->prepare_execute('SELECT * FROM user;');
// :: car fonction "static"
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Test</title>
</head>
<body>
	<p>
<?php 
//print_r($resultats); 
foreach($resultats as $resultat)
{
	echo $resultat['idUser'],'<br>',$resultat['pseudo'],'<br>',$resultat['mail'],'<br>',$resultat['password'],'<br>__________________<br>';
}
?>
    </p>
</body>
</html>