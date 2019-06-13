<?php

/**
* 
*/

class User
{
	private $id;
	private $conn ;

	
	function __construct($id)
	{
		$this->id = $id;
		$this->conn=$conn;
		
	}

	public function RecuperateById($idUser)
	{
		$sql = "SELECT * FROM utilisateur where id = $idUser";
		$query = $this->conn->query($sql);
		$data = $query->fetchAll(PDO::FETCH_OBJ);
		echo json_encode($data);

		return $data;
	}
	static public function RecuperateByAll()
	{
		$sql = "SELECT * FROM utilisateur";
		$query = $this->conn->query($sql);
		$data = $query->fetchAll(PDO::FETCH_OBJ);
		
		return $data;
	}
	public function Delete($idUser='')
	{
		
	}


	static public function Edit( $nom='',	$prenom='',	$email='',$ville='',$sexe='' ,$motdepasse = '')
	{
		$sql = "UPDATE `utilisateur` SET `commente` = '".$commente."' , prenom = '".$prenom."' , nom = '".$nom."' , email = '".$email."' , 	motdepasse = '".$motdepasse."' ville='".$ville."' , sexe = '".$sexe."'  WHERE `utilisateur`.`id` = $this->id;";
		$query = $this->conn->exec($sql);
		if ($query) {
			//echo "daz";
		}		
	}
	static public function add( $nom='',$prenom='',	$email='',$ville='',$sexe='',$motdepasse = '' ,$fonction = '' , $conn='')
	{
		$sql = "INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `motdepasse`, `fonction`, `ville`, `sexe`) VALUES (NULL, '".$nom."', '".$prenom."', '".$email."', '".$motdepasse."', '".$fonction."', '".$ville."', '".$sexe."')";
		$query = $conn->exec($sql);
			if ($query) {
				//echo "daz";
			}
	}
}



?>