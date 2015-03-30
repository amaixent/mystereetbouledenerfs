<?php

class Database {

    public $base;

    function __construct($type, $host, $dbname, $login, $password) {
        try {
            $this->base = new PDO("$type:host=$host;dbname=$dbname;charset=utf8", $login, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            echo 'Erreur connexion : ', $e->getMessage();
            exit();
        }
    }

    public function prepare_execute($_req, $_param = array()) {
        $stmt = $this->base->prepare($_req);
        $stmt->execute($_param);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function prepare_execute_add_up_del($_req, $_param = array()) {
        $stmt = $this->base->prepare($_req);
        $stmt->execute($_param);
    }

    public function get_by_id($_table, $_idparam, $_id) {
        $stmt = $this->prepare_execute('SELECT * FROM ' . $_table . ' WHERE ' . $_idparam . ' = :id LIMIT 1;', [':id' => $_id]);

        return $stmt[0];
    }

    public function get_by_id_notall($_params, $_table, $_idparam, $_id) {
        $stmt = $this->prepare_execute('SELECT ' . $_params . ' FROM ' . $_table . ' WHERE ' . $_idparam . ' = :id LIMIT 1;', [':id' => $_id]);
        return $stmt[0];
    }

    /* Sélectionne toute une table en fonction d'un paramètre commun
     * A utiliser principalement pour la messagerie / les indices peut être
     */

    public function get_all($_table, $_param, $_val) {
        $stmt = $this->prepare_execute('SELECT * FROM ' . $_table . ' WHERE ' . $_param . ' = :val', [':val' => $_val]);
        return $stmt;
    }

    public static function get() {
        return new Database('mysql', 'localhost', 'site_enigme', 'root', '');
    }

}

?>