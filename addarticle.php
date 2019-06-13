<?php
	require 'DAO.php';
	require 'header.php';
	require 'horizontalheader.php';		
	session_start();
	if(!isset($_SESSION['auth'])){
		header('location:auth.php');
	}
	$items = unserialize($_SESSION['auth']);
//	echo '<h1>'.$items.'</h1>';
//	echo '<h1>'.session.'</h1>';
	$dao = new DAO('readit');
	$names = array();
	$cond=0;
	//table names
	$names = $dao->nomTables();
	$table_name = $names[1];
	//to get column names
	$l = $dao->getColumns($table_name);
	$lis= $dao->getList($table_name);
	
	//cond to check if there is no empty fields
	$cond=0;
	
	if (isset($_POST['submit'])){
		$pdo = new PDO('mysql:host=localhost;dbname=readit', 'root', '');
		if(!is_null($_FILES["image"])){
			$target_dir = "../upload/";
			$target_file = $target_dir .basename($_FILES["image"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$target_name = $target_dir.$table_name.'_' .$_POST['t'].'.'.$imageFileType;
			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_name)){
				$req = "insert into article (titre,description,categorie,image,auteur) values ('".
				$_POST['t']."','".$_POST['d']."','".$_POST['c']."','".$target_name."','".$items['id']."');";
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->exec($req);
				$_SESSION['article']=serialize($last_id);
				header('location: articles.php');}
		}
	}

?>

	<form method="POST" class="form" role="form" enctype="multipart/form-data"> 
		<div class="row">
			<h2 class="center">Post an article</h2>			
			</div>
			<div class="row">
				<div class="input-field col s12 l6">
					<input id="first_name" type="text" name="t" class="validate">
					<label for="first_name">Title</label>
				</div>
								
				<div class="input-field col s12 l6">
					<select name="c">
						<option value="" disabled selected>Field :</option>
						<?php
						foreach ($lis as $client) {
							echo '<option value="'.$client->id.'">'.$client->description.'</option>';
						}?>
					</select>
					<label>Categorie :</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<textarea id="textarea1" name="d" class="materialize-textarea"></textarea>
					<label for="textarea1">Description : </label>
				</div>
			</div>
			<div class="row">
				<div class="file-field input-field">
					<div class="btn">
						<span>Image</span>
						<input type="file" name="image">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col m4"></div>
				<div class="col s12 m6">
					<button class="waves-effect waves-light btn-large" name="submit">POST</button>
					<button class="waves-effect waves-light btn-large">CANCEL</button>
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