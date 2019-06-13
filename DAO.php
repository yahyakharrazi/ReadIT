<?php
class DAO{
	private $dub;	private $tab;
	public function __construct($database_name){$this->dub = $database_name;}
	public function nomTables(){
		$pdo = new PDO('mysql:host=localhost;dbname='.$this->dub,'root','');
		$reqet = "select TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE 
	    	TABLE_TYPE='BASE TABLE' AND TABLE_SCHEMA='".$this->dub."'";
	    $tables = $pdo->query($reqet)->fetchAll();
	    $names = array();
	    for ($i=0; $i < count($tables); $i++) { 
	    	$names[] = $tables[$i][0];	    }			
	    return $names;
	}
	public function getList($table_name){
		require './classes/'.$table_name.'.php';
    	$pdo = new PDO('mysql:host=localhost;dbname='.$this->dub, 'root', '');
    	$req = "select * from ".$table_name;
    	$result = array();
    	$result =$pdo->query($req)->fetchAll();
    	$l = array();
    	foreach($result as $dta){
    		$l[] = new $table_name($dta);}
    	return $l;
	}

		/*public function getLost($table_name,$id){
		require_once './classes/'.$table_name.'.php';
		$strcon = 'mysql:host=localhost;dbname='.$this->dub;
    	$pdo = new PDO($strcon, 'root', '');
    	$req = "select * from ".$table_name . " where id=".$id;
    	$result = array();
    	$result =$pdo->query($req)->fetchAll();
    	$l = array();
    	foreach($result as $dta){
    		$l[] = new $table_name($dta);
    	}
    	return $l;
	}*/

	public function getColumns($tab){
		$pdo = new PDO('mysql:host=localhost;dbname='.$this->dub,'root','');
		$req = "SHOW COLUMNS FROM ".$tab;
	    $result = $pdo->query($req)->fetchAll();
	    $l = array();
	    foreach ($result as $k) {
	    	$l[] = $k['Field'];
	    }return $l;
	}

	public function insert($tname,$tab){
		$pdo = new PDO('mysql:host=localhost;dbname='.$this->dub,'root','');
		$txt='insert into '.$tname.' values(';
	    for ($i=0; $i < count($tab); $i++) {
    		if(is_numeric($tab[$i]))
    			$txt.=" ".$tab[$i].",";
    		else
    			$txt.="'".$tab[$i]."',";
	    }
    	$txt = substr($txt, 0,strlen($txt)-1);$txt.=');';
    	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$pdo->exec($txt);
	}

	public function genereForm($colonne){
		echo 
		    '<div class="form-group"><label for="'.$colonne.'" class="col-sm-3 mx-5 control-label">'.$colonne.':</label>
		        <div class="mx-5">';
		        if($colonne != 'image'){
					echo '<input type="text" class="form-control col-sm-7" name="'.$colonne.'" id="'.$colonne.'" placeholder="Enter '.$colonne.'">';
		        }
		        else{
		        	echo '<input type="file" class="form-control col-sm-7" name="'.$colonne.'" id="'.$colonne.'" placeholder="Enter '.$colonne.'">';
		        }
				echo '</div>
		    </div>';
	}

	public function delete($tname,$id){
		$pdo = new PDO('mysql:host=localhost;dbname='.$this->dub,'root','');
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
		$re = 'delete from '.$tname.' where id='.$id;
		$pdo->exec($re);
	}

	public function deleteFile($tname,$id){
		$pdo = new PDO('mysql:host=localhost;dbname='.$this->dub,'root','');
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	    $req = 'select image from '.$tname.' where id='.$id;
	    $tab = $pdo->query($req)->fetchAll();
	    $re = 'delete from '.$tname.' where id='.$id;
		$pdo->exec($re);
		unlink($tab[0][0]);
	}
	
	public function justFile($tname,$id){
		$pdo = new PDO('mysql:host=localhost;dbname=bootdb','root','');
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	    $req = 'select image from '.$tname.' where id='.$id;
	    $tab = $pdo->query($req)->fetchAll();
		unlink($tab[0][0]);	
	}

	public function update($tnom,$col,$id,$val){
		$pdo = new PDO('mysql:host=localhost;dbname='.$this->dub,'root','');
		$txt ='update '.$tnom. ' set ';
		$i=0;
		foreach($col as $t){
			$txt.=$t." = '";
			$txt.=$val[$i]."' ";
			$i++;
			if($i<count($val))
				$txt.=' , ';
		}
		$txt.= 'where id='.$id;
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($txt);
	}
}
?>