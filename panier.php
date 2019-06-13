<?php
require 'dao.php';
require 'header.php';
require 'horizontalheader.php';
//require 'verticalheader.php';

session_start();
if(isset($_SESSION['panier'])){
	$arr=array();
	//var_dump($_SESSION['panier']);
	//$arr = unserialize($_SESSION['panier']);
	$arr = $_SESSION['panier'];
	//var_dump($arr[10]);
	$bd = new DAO('dsbd');
	$column_names = $bd->getColumns('chambre');
}
?>
	<div class="container mt-5">
		<div class="row">
			<div class="table-responsive">
				<table id="tables" class="table table-striped table-dark">
					<thead>
						<?php	foreach ($column_names as $name) {
								echo "<th>".$name."</th>";}?>						
					</thead>
					<tbody>
						<?php
							foreach ($arr as $clients) {
								echo'<tr>';
								foreach($clients as $client){
									foreach ($column_names as $name){
										if($name=='image')
											echo '<td><img class="rounded-circle" src="'.$client[$name].'" height="75px" width="75px"></td>';
										else
											echo '<td class="align-middle">'.$client[$name].'</td>';
									}
								}
								echo'</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>