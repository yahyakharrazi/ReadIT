<?php
require 'dao.php';
require 'header.php';
require 'horizontalheader.php';
session_start();
$dao = new DAO('readit');
$names = array();
//table names
$names = $dao->nomTables();
$table_name = $names[0];
//to get column names
$l = $dao->getColumns($table_name);
$lis = $dao->getList($table_name);
//cond to check if there is no empty fields
$cond=0;
$values = array();
?>
<div class="bg"></div>
<div class="row">
	<div class="row">
	<?php
		foreach ($lis as $client) {
		echo '
		<div class="col s12 m6">
			<div class="card">
				<div class="card-image waves-effect waves-block waves-light">
					<img class="activator" src="'.$client->image.'">
				</div>
				<div class="card-content">
					<span class="card-title activator grey-text text-darken-4">'.$client->titre.'<i class="material-icons right">more_vert</i></span>
					<p><a href="./article?id='.$client->id.'">See more</a></p>
				</div>
				<div class="card-reveal">
					<span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
					<p>'.$client->description.'</p>
				</div>
			</div>
		</div>';
	}?>
    </div>
</div>