<?php
	require 'DAO.php';
	require 'header.php';
	require 'horizontalheader.php';		
	//require 'verticalheader.php';
	$bd = new DAO('dsbd');
	$tables = array();
	$names = array();
	$names = $bd->nomTables();	
	if(isset($_POST['table_name']))
		$table_name=$_POST['table_name'];
	else
		$table_name = $names[0];
	$lis= $bd->getList($table_name);
	$column_names = $bd->getColumns($table_name);
	if(isset($_POST['delete']))
		$bd->delete($table_name,$_POST['delete']);
?>
	<form method="POST" class="form"> 
	<div class="container">
			<div class="container" id="cont">
		<div class="card mt-4">
				  <h3 class="card-header">Choose your table</h3>
				  <div class="card-body">
					<div class="form-group">
						<div class="row mx-2">
							<label for="table" class="col-sm-2 col-lg-1 col-xl-1 control-label">Table : </label>
							<select id="table" name="table_name" class="form-control col-sm-8" >
								<?php foreach ($names as $n) {
									if($_POST['table_name']==$n)
										echo '<option selected>'.$n.'</option>';
									else echo '<option>'.$n.'</option>';
								}?></select>
							<div class="form-group">
								<div class="col-sm-3 col-xl-3 col-lg-2">
								    <button type="submit" class="btn btn-danger">Go</button>
								</div>
							</div>
						</div>
					</div>
				  </div>
				</div>
			</div>
	<div class="container">
		<div class="table-responsive">
			<table id="tables" class="table table-striped table-dark mt-3">
				<thead>
					<?php
						foreach ($column_names as $name) {
							echo "<th>".$name."</th>";}
					?>
				</thead>
				<tbody>
					<?php
						foreach ($lis as $client) {
							echo '<tr>';
							foreach ($column_names as $name) {
								if($name=='image')
					echo '<td><img src="'.$client->$name.'" width="60px" height="60px" class="rounded-circle"></td>';
								else echo '<td class="p-3 mb-2" name='.$client->$name.'>'.$client->$name.'</td>';
							}?>
							<td><button class="btn btn-dark border border-danger" value="<?php echo $client->id?>" name="delete" onClick="confirm('Are you sure you want to delete?')">Delete</button></td>
						</tr>
						<?php }?>
				</tbody>
			</table>
		</div>
	</div>
	</form>
</body>
</html>