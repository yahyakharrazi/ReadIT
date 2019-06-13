<?php
require 'DAO.php';
require 'header.php';
require 'horizontalheader.php';	
session_start();

$items=unserialize($_SESSION['auth']);
$pdo = new PDO('mysql:host=localhost;dbname=readit', 'root', '');
if(!isset($_GET['id']) || !isset($_SESSION['auth'])){
	header('location: articles.php');
}
var_dump($items[0]);
var_dump($_GET['id']);
if(isset($_POST['submit'])){
	 $req = "insert into suivis (idutilisateur,idauteur) values (". $items['id'].",".$_GET['id'].")";
//	 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $pdo->exec($req);
}


$req = "SELECT u.nom,u.prenom,u.fonction
FROM utilisateur u
WHERE u.id=".$_GET['id'];
$r =$pdo->query($req)->fetchAll();

?>
	<div class="row">
		<form method="POST" class="form" role="form" enctype="multipart/form-data"> 
			<div class="row">
				<h2 class="center">Profile</h2>			
				</div>
				<div class="row">
					<div class="input-field col s12 m6">
						<input id="first_name" type="text" value="<?php echo $r[0]['nom']?>" name="f" disabled>
						<label for="first_name">First name</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="last_name" type="text" value="<?php echo $r[0]['prenom']?>" name="l" disabled>
						<label for="last_name">Last Name</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12 m6">
						<input id="fon" type="text" name="fon" value="<?php echo $r[0]['fonction']?>" disabled>
						<label for="fon">fonction</label>
					</div>
				</div>


				<div class="row">
					<div class="col s5"></div>
					<div class="col s3">
						<button class="waves-effect waves-light btn-large" name="submit">FOLLOW</button>
					</div>

				</div>
		</form>
	</div>
	
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
