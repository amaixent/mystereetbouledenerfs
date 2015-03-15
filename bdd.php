<?php
class Database
{
	public $base;
	
	function __construct($type,$host,$dbname,$login,$password)
	{
		try{$this->base = new PDO("$type:host=$host;dbname=$dbname;charset=utf8",$login,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}
		catch(PDOException $e)
		{
			echo 'Erreur connexion : ',$e->getMessage();
			exit();
		}
	}

	public function prepare_execute($_req,$_param = array())
	{
		$stmt = $this->base->prepare($_req);
		$stmt->execute($_param);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
        
        
	public function prepare_execute_add_up_del($_req,$_param = array())
	{
		$stmt = $this->base->prepare($_req);
		$stmt->execute($_param);
	}
	
	public function get_by_id($_table,$_idparam,$_id)
	{
		$stmt = $this->prepare_execute('SELECT * FROM '.$_table.' WHERE '.$_idparam.' = :id LIMIT 1;',[':id' => $_id]);
		return $stmt[0];
	}

	public static function get()
	{
		return new Database('mysql','localhost','site_enigme','root','');
	}
}
?>