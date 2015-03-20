/*TRUCS*/
include : récupérer un fichier php : si erreur rien ne se passe
require : rien ne se passe si erreur
BOF require_once : ajout d'un contrôle en plus - intégrer 1 seule fois dans la page - inutile et fait calculer plus
echo prend un ou plusieurs paramètre et les affiche dedans
'Pour du texte'
"Pour mettre une $variable dedans et qu'elle soit interprétée"
echo 'coucou', $nom ;
exit() et die() sont pareils, die() est un alias de exit($arg) => affiche ce qu'il y a comme argument

-> MVC
M : dialogue avec la BDD, requêtes SQL
V : Vue : créer le HTML
C : contrôleur : traiter les données

----------------------------------------------------------------------------------------------------------------

Fonction session_start()

client 							serveur
		identification ->
		<- phpsessionId + token
		token + sessionid ->

		<- phpsessionid + nouveau token
		phpsessionid + nouveau token ->

on ajoute une clé (token) à chaque fois différente sur l'id
