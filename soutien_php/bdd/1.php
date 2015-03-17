<?php

/* création PDO : Connexion base de données */
try
{
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=test_db;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(PDOException $e)
{
	echo 'Erreur connexion : ',$e->getMessage();
	exit();
}

/* Requete */
$stmt = $bdd->prepare('SELECT * FROM user;');
$stmt->execute();
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

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