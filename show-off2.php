<?php
	require 'DAO.php';
	require 'header.php';
	require 'horizontalheader.php';	
	
	$bd = new DAO('readit');
    $names = array();
    $names = $bd->nomTables();    
    $table_name= $names[3];
	$lis= $bd->getList($table_name);
	$column_names = $bd->getColumns($table_name);
?>
	<div class="container mt-5">
		<div class="row">
			<div class="table-responsive">
				<table id="tables" class="table table-striped table-dark">
					<thead>
<?php foreach ($column_names as $name) {echo "<th>".$name."</th>";}	?>
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
								echo'</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>