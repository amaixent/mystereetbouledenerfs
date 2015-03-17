<?php

// Pour pouvoir manipuler plus facilement la base de données
class Database {

    public $bdd;
    private $dbname;

    public function __construct($type, $host, $dbname, $login, $password) {
        $this->dbname = $dbname;
        try {
            $this->base = new PDO("$type:host=$host;dbname=$dbname;charset=utf8", $login, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            exit('Erreur : ' . $e->getMessage());
        }
    }
    
    public function prepare_execute($_req, $_param){
        
    }
    
    public static function get(){ // utilisable pas sur un objet
        
    }

}

?>