<?php
	require 'DAO.php';
	require 'header.php';
	require 'horizontalheader.php';
	session_start();
	if(isset($_SESSION['auth'])){
		header('location:articles.php');
	}
	$dao = new DAO('readit');
	$names = array();
	$names = $dao->nomTables();
	$table_name = $names[6];
	//to get column names
	$l = $dao->getColumns($table_name);
	$lis= $dao->getList($table_name);
	
	if (isset($_POST['submit'])){
		$pdo = new PDO('mysql:host=localhost;dbname=readit', 'root', '');
		$req = "insert into utilisateur (nom,prenom,email,motdepasse,image,fonction,ville,sexe) values ('".
		$_POST['l']."','".$_POST['f']."','".$_POST['e']."','".$_POST['p']."',' ','".$_POST['fon']."','".$_POST['v']."','".$_POST['s']."');";
    	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($req);
		$last_id = $pdo->lastInsertId();
		$_SESSION['auth']=serialize($last_id);
		header('location: articles.php');		
	}

?>
<div class="row">
	<div class="col s0 m2"></div>
	<div class="col s12 m10">
		<form method="POST" class="col s12" role="form" enctype="multipart/form-data"> 
			<div class="row">
				<h2 class="center">SignUp</h2>			
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input id="first_name" type="text" name="f" class="validate">
					<label for="first_name">First Name</label>
				</div>
				<div class="input-field col s6">
					<input id="last_name" type="text" name="l" class="validate">
					<label for="last_name">Last Name</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12 m6">
					<input id="email" type="text" name="e" class="validate">
					<label for="email">Email</label>
				</div>
				<div class="input-field col s12 m6">
					<input id="password" type="password" name="p" class="validate">
					<label for="password">Password</label>
				</div>
			</div>
			<div class="input-field col s12 m12">
				<input id="fonction" type="text" name="fon" class="validate">
				<label for="fonction">Job</label>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<select name="v">
						<option value="" disabled selected>Choose your city</option>
						<?php
						foreach ($lis as $client) {
							echo '<option value="'.$client->id.'">'.$client->nom.'</option>';
						}?>
					</select>
					<label>City</label>
				</div>
				<div class="input-field col s3">
					<label>
						<input name="s" value="1" type="radio" checked />
						<span>Male</span>
					</label>
				</div>
				<div class="input-field col s3"> 
					<label>
						<input name="s" value="2" type="radio" />
						<span>Female</span>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col s4"></div>
				<div class="col s12 m12 l6">
					<button class="waves-effect waves-light btn-large" name="submit">SIGN UP</button>
					<button class="waves-effect waves-light btn-large" name="reset">CANCEL</button>
				</div>

			</div>
		</form>
	</div>
	<div class="col s2"></div>
</div>
<?php 
echo "<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
  });
  </script>";
?>

	</body>
</html>