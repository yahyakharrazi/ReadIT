<?php
	require 'DAO.php';
	require 'header.php';

	require 'horizontalheader.php';

	session_start();
	/*if(!isset($_SESSION['auth'])){
		header('location:auth.php');
	}*/
	$bd = new DAO('readit');
    $names = array();
    //table names
    $names = $bd->nomTables();
    //check if there is a chosen table
	$table_name = $names[0];

	if(isset($_POST['reserve']))
	{
		//$los= $bd->getLost('chambre',$_POST['reserve']);
		$strcon = 'mysql:host=localhost;dbname=readit';
    	$pdo = new PDO($strcon, 'root', '');
    	$req = "select distinct id,nombre_lits,categorie from ".$table_name." where id=".$_POST['reserve'];
    	//$r =$pdo->query($req)->fetchAll();
    	//surefire way to fetch data
		$sth = $pdo->prepare($req);
		$sth->execute();
		$result = $sth->fetchAll();
		//print_r($result);
		//$_SESSION['panier']= serialize($los);
		$_SESSION['panier'][]=$result;
	}
	//select * from table
	$lis= $bd->getList($table_name);
	//columns names
	$column_names = $bd->getColumns($table_name);
?>
<!--
<div class="row">
<div class="col-9 col-sm-9 col-md-10 col-lg-10 col-xl-10">
-->

<form method="post">
	<div class="container mt-5">
		<div class="row">
			<div class="table-responsive">
				<table id="tables" class="table table-striped table-dark">
					<thead>
						<?php
							foreach ($column_names as $name) {
								echo "<th>".$name."</th>";}
						?>
					</thead>
					<tbody>
						<?php
							foreach ($lis as $client) {
								echo'<tr>';
								foreach ($column_names as $name){
									if($name=='image')
										echo '<td><img class="rounded-circle" src="'.$client->$name.'" height="75px" width="75px"></td>';
									else
										echo '<td class="align-middle">'.$client->$name.'</td>';
								}
								//echo '<td><button class="btn btn-dark border border-danger" value="'. $client->id.'" type="submit" name="reserve">reserve</button></td>';
								echo'</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</form>
        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
    </div>
            <?php //require 'headerverticalright.php'; ?>

</body>
</html>