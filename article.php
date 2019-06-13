<?php
require 'dao.php';
require 'header.php';
require 'horizontalheader.php';
session_start();
if(!isset($_GET['id'])){
	header('location: articles.php');
}
$pdo = new PDO('mysql:host=localhost;dbname=readit', 'root', '');
$req = "select utilisateur.nom,utilisateur.prenom,utilisateur.id,commentaire.commentaire,commentaire.dateCom from commentaire,utilisateur 
where commentaire.user=utilisateur.id
and commentaire.article=".$_GET['id'];
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//		echo $req;
$r2 =$pdo->query($req)->fetchAll();
		

if(isset($_POST['submit'])){
	$items=unserialize($_SESSION['auth']);
//	var_dump($items[0]);
	$req = "insert into commentaire (commentaire,user,article) values ('".$_POST['comment']."',".$items['id'].",".$_GET['id'].");";
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec($req);
}

$pdo = new PDO('mysql:host=localhost;dbname=readit', 'root', '');

$req = "SELECT a.id,a.titre,a.description,a.image,c.description,auteur.nom,auteur.prenom,auteur.id
FROM article a,categorie c,utilisateur auteur
WHERE a.id=".$_GET['id']." and c.id=a.categorie and a.auteur=auteur.id;";
$r =$pdo->query($req)->fetchAll();
//var_dump($r[0][7]);
	

?>

<div class="bg"></div>
<div class="container">
	<div class="post black-text lime lighten-5">
		<img class="materialboxed" src="<?php echo $r[0]['image'];?>">	
		<h3 class=""><?php echo $r[0]['titre'];?></h3>
		<span>Written by : <a href="./profile.php?id=<?php echo $r[0][7]?>"><?php echo $r[0]['nom'].' '.$r[0]['prenom'];?></a></span>
		<p><?php echo $r[0][2];?></p>
	</div>
	<div class="comments">
	<?php
		foreach($r2 as $row){
			echo '
			<div class="divider pink darken-4"></div>
			<div class="col s12 m8 offset-m2 l6 offset-l3">
				<div class="card-panel grey lighten-5 z-depth-1">
					<div class="row valign-wrapper">
						<div class="col s12">
							<span class="black-text"><a href="./profile.php?id='.$row[2].'">'.$row[0].' '.$row[1].'</a></span><br>
							<span class="black-text">'.$row[3].'</span>
						</div>
					</div>
				</div>
			  </div>';
		}
	?>
		</div>
	
	<?php
		if(isset($_SESSION['auth'])){
			echo '
			<form method="POST" class="form" role="form" enctype="multipart/form-data">
				<div class="addcomment lime lighten-5">
					<div class="col s12 m8">
						<p for="comment">Enter your comment : </p>
						<input type="text" placeholder="comment" name="comment" id="e">
						<button type="submit" class="waves-effect waves-light btn-large" name="submit">COMMENT</button><br>
					</div>
				</div>
			</form>
			';
		}
	?>
	
</div>
<?php
	echo "<script>document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('.materialboxed');
		var instances = M.Materialbox.init(elems);
	  });</script>";
?>