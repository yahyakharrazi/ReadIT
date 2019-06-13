<?php

/**
* 
*/

include "../connexion/cnx.php";
class Commentaire
{
	
	private $id ;
	private $conn;
	function __construct($id , $conn)
	{
		$this->id = $id;
		$this->conn=$conn;
	}

	public function RecuperateById( $id)
	{
		$sql = "SELECT * FROM commentaire where id = $id and user = $this->id";
		$query = $this->conn->query($sql);
		$data = $query->fetchAll(PDO::FETCH_OBJ);
		echo json_encode($data);

		return $data;

	}
	public function RecuperateByAll()
	{
		$sql = "SELECT * FROM commentaire where  user = $this->id";
		$query = $this->conn->query($sql);
		$data = $query->fetchAll(PDO::FETCH_OBJ);
		
		return $data;
	}
	public function Delete($idUser='' )
	{
		$sql = "SELECT * FROM commentaire where  user = $this->id";
		$query = $this->conn->query($sql);

	}
	static public function Edit( $commente , $id )
	{
		$sql = "UPDATE `commentaire` SET `commente` = '".$commente."' WHERE `commentaire`.`id` = $id;";
		$query = $this->conn->exec($sql);
		if ($query) {
			//echo "daz";
		}		
	}
	static public function Add($article , $commente , $user  )
	{
		$sql = "INSERT INTO `commentaire` (`id`, `article`, `user`, `commente`, `date`) VALUES (NULL, $article, $user , '".$commente."', CURRENT_DATE());";
		$query = $this->conn->exec($sql);
		if ($query) {
			//echo "daz";
		}
	}
}

$art = new Commentaire('1' , $conn);
$art->RecuperateById( '1');
//$art->Edit( 'dfdsfdfdsgsd' , '1' );


?>