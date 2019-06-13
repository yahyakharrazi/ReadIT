<?php
	require 'DAO.php';
	require 'header.php';
	require 'horizontalheader.php';		
	//require 'verticalheader.php';
	$tables = array();
	$names = array();
	$daw = new DAO('dsbd');
    $names = $daw->nomTables();
	if(isset($_POST['table_name']))
		$table_name=$_POST['table_name'];
	else
		$table_name = $names[0];
	$l = $daw->getColumns($table_name);
	$lis= $daw->getList($table_name);
	$column_names = $daw->getColumns($table_name);
	$values = array();
	if(isset($_POST['save'])){
		foreach($l as $col){
    		if($col!='image'){
	    		if(isset($_POST[$col]))
		    		$values[] = $_POST[$col];
    		}
    		else{//ajout image
	    		if(!is_null($_FILES['image'])){
					$daw->justFile($table_name,$_POST['id']);
					$target_dir = "../upload/";
					$target_file = $target_dir .basename($_FILES["image"]["name"]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					$target_name = $target_dir.$table_name.'_' .$_POST['id'].'.'.$imageFileType;
					if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_name))
						$values[]=$target_name;
					else
						$cond++;
				}
				else
					$cond++;
    		}    			
    	}
		$daw->update($table_name,$l,$_POST['id'],$values);
	}
?>
	<form method="POST" class="form" enctype="multipart/form-data"> 
		<div class="container">
			<div class="container" id="cont">
				<div class="card mt-4">
				  <h3 class="card-header text-center">Choose your table</h3>
				  <div class="card-body">
					<div class="form-group">
						<div class="row">
							<label for="table" class="col-sm-2 control-label">Table : </label>
							<select id="table" name="table_name" class="form-control col-sm-6" >
								<?php foreach ($names as $n) {
									if($_POST['table_name']==$n)
										echo '<option selected>'.$n.'</option>';
									else{echo '<option>'.$n.'</option>';}
								}?>
							</select>
							<div class="form-group">
								<div class="col-sm-3">
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
			<table id="tables" class="table table-striped table-dark mt-5">
				<thead>
					<?php foreach ($column_names as $name){echo "<th>".$name."</th>";}?>
				</thead>
				<tbody>
					<?php
						foreach ($lis as $client) {
							echo '<tr>';
							foreach ($column_names as $name) {
								if($name=='image')
									echo '<td><img src="'.$client->$name.'" width="60px" height="60px" class="rounded-circle"></td>';
								else echo '<td class="p-3 mb-2" name='.$client->$name.'>'.$client->$name.'</td>';}?>
							<td><button class="btn btn-primary" type="submit" value="<?php echo $client->id?>" name="update" 
								onClick="show()">Update</button></td>
						</tr>
						<?php }?>
				</tbody>
			</table>
		</div>
		<div id="upd" class="card mt-3" <?php if(!isset($_POST['update'])){?>style="display: none;<?php }?>">
			<h4 class="card-header">Update : </h4>
			<div class="card-body">
				<?php
				//
				foreach($l as $colname){
					$daw->genereForm($colname);
				}?>
				<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-6">
					    <button type="submit" class="btn btn-danger" name="save">Save</button>
					    <button onclick="hide()" class="btn btn-danger">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
	<script type="text/javascript" language="javascript">
		function show(){
			document.getElementById('upd').style.display = "block";
		}
		function hide(){
			document.getElementById('upd').style.display = "none";
		}
	</script>
</body>
</html>