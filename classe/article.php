<?php

/**
* 
*/

include "../connexion/cnx.php";
class Article
{
	private $id ;
	private $conn;
	function __construct($id , $conn)
	{
		$this->id = $id;
		$this->conn=$conn;
	}

	public function RecuperateById($idArticle='')
	{
		$sql = "SELECT * FROM article where id = $idArticle and auteur = $this->id";
		$query = $this->conn->query($sql);
		$data = $query->fetchAll(PDO::FETCH_OBJ);
		echo json_encode($data);

		return $data;
	}
	public function RecuperateByAll()
	{
		$sql = "SELECT * FROM article where  auteur = $this->id";
		$query = $this->conn->query($sql);
		$data = $query->fetchAll(PDO::FETCH_OBJ);
		
		return $data;	
	}
	public function Delete($idArticle='')
	{

	}
	public function Edit( $title='' , $description = '' ,$image= '' 	 )
	{
		$sql = "UPDATE `article` SET `title` = '".$title."' ,`description` = '".$description."' ,`image` = '".$image."'  WHERE `commentaire`.`id` = $id;";
		$query = $this->conn->exec($sql);
		if ($query) {
			//echo "daz";
		}
	}
	public function Add($title='' , $description = '' ,$image= ''  , $vus ='' , $categorie='' , $auteur='')
	{
		$sql = "INSERT INTO `article` (`id`, `titre`, `description`, `image`, `vus`, `date_creation`, `date_modification`, `categorie`, `auteur`) VALUES (NULL, '$title', '$description', '$image', '$vus', CURRENT_DATE(), NULL, '$categorie', '$auteur');";
		$query = $this->conn->exec($sql);
		if ($query) {
			//echo "daz";
		}
		
	}
}




?>