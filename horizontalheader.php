<?php 
echo '<nav>
<div class="nav-wrapper pink darken-5">
	<a href="#!" class="brand-logo">Home</a>
	<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
	<ul class="right hide-on-med-and-down">
		<li><a href="./addarticle.php">Post</a></li>
		<li><a href="./articles.php">Articles</a></li>
		<li><a href="./myprofile.php">Profile</a></li>
		<li><a href="./signup.php">Signup</a></li>
		<li><a href="./disconnect.php">Logout</a></li>
	</ul>
</div>
</nav>

<ul class="sidenav" id="mobile-demo">
<li><a href="./addarticle.php">Post</a></li>
<li><a href="./articles.php">Articles</a></li>
<li><a href="./myprofile.php">Profile</a></li>
<li><a href="./signup.php">Signup</a></li>
<li><a href="./disconnect.php">Logout</a></li>
</ul>
';
?>