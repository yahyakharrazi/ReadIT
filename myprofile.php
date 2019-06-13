<?php
require 'DAO.php';
require 'header.php';
require 'horizontalheader.php';	
session_start();
$items=unserialize($_SESSION['auth']);
$pdo = new PDO('mysql:host=localhost;dbname=readit', 'root', '');
$dao = new DAO('readit');
	$req = "SELECT u.nom,u.prenom,u.fonction,u.email,u.image,u.ville
	FROM utilisateur u
	WHERE u.id=".$items['id'];
	$r =$pdo->query($req)->fetchAll();
	$req = "SELECT u.nom,u.prenom,u.fonction
	FROM suivis s,utilisateur u
	WHERE s.idutilisateur=".$items['id']." and s.idauteur=u.id";
	$r2 =$pdo->query($req)->fetchAll();
	
	$names = array();
	//table names
	$names = $dao->nomTables();
	$table_name = $names[0];
	//to get column names
	$l = $dao->getColumns($table_name);
	//cond to check if there is no empty fields
    $cond=0;
    $values = array();
    foreach($l as $col){
    	//if it's an image then uploads it
    	if($col=='image'){
    		//ajout image
    		if(!is_null($_FILES['image'])){
				$target_dir = "../upload/";
				$target_file = $target_dir .basename($_FILES["image"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$target_name = $target_dir.$table_name.'_' .$_POST['id'].'.'.$imageFileType;
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_name))
					$values[]=$target_name;
				else
					$cond++;
			}
			else
				$cond++;
    	}
    	else{
    		if(isset($_POST[$col]))
	    		$values[] = $_POST[$col];
    		else{
    			$cond++;
    			break;
    		}
    	}
    }
    if($cond==0){
    	$dao->insert($table_name,$values);
    }
?>

	<form method="POST" class="form" role="form" enctype="multipart/form-data"> 
		<div class="row">
			<h2 class="center">Profile</h2>			
			</div>
			<div class="row">
				<div class="input-field col s12 m6">
					<input id="first_name" type="text" name="f" class="validate">
					<label for="first_name">First name</label>
				</div>
				<div class="input-field col s12 m6">
					<input id="last_name" type="text" name="l" class="validate">
					<label for="last_name">Last Name</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12 m6">
					<select>
					<option value="" disabled selected>City :</option>

					</select>
					<label>City :</label>
				</div>
				<div class="input-field col s12 m6">
					<input id="fon" type="text" name="fon" class="validate">
					<label for="fon">fonction</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s">
					<input id="email" type="text" name="e" class="validate">
					<label for="password">Email</label>
				</div>
				<div class="input-field col s6">
					<input id="password" type="password" name="p" class="validate">
					<label for="password">Password</label>
				</div>
			</div>
			<div class="row">
				<div class="file-field input-field">
					<div class="btn">
						<span>Image</span>
						<input type="file">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s4"></div>
				<div class="col s6">
					<button class="waves-effect waves-light btn-large" name="submit">SAVE</button>
					<button class="waves-effect waves-light btn-large" name="cancel">CANCEL</button>
				</div>

			</div>
	</form>
<?php 
echo "<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
  });
  $('#textarea1').val('New Text');
  M.textareaAutoResize($('#textarea1'));
  </script>";
?>
</body>
</html>