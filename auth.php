<?php
require 'dao.php';
require 'header.php';
require 'horizontalheader.php';
session_start();

if (isset($_POST['submit'])){
		$pdo = new PDO('mysql:host=localhost;dbname=readit', 'root', '');
		$email = addslashes($_POST['email']);
		//$pass = sha1($_POST['pass']);
		//$email = $_POST['email'];
		$pass = $_POST['pass'];
		$req = "select id from utilisateur where email='". $email ."' and motdepasse='".$pass."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//		echo $req;
		$r =$pdo->query($req)->fetchAll();
		if($r[0]!=0){
			$_SESSION['auth']=serialize($r[0]);
			header('location: articles.php');
		}
}

?>
<div class="bg"></div>
<form method="POST">
	<div class="login">
		<h2>Login here</h2>
		<p for="email">Email : </p>
		<input type="text" placeholder="Email" name="email" id="e">
		<p for="pass">Password :</p>
		<input type="password" placeholder="Entrez mot de passe" name="pass" id="p">
		<button type="submit" name="submit">LOGIN</button>
		<a href="./signup.php">Create account</a>
	</div>
</form>