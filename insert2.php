<?php
	require 'DAO.php';
	require 'header.php';
	require 'horizontalheader.php';		
	//require 'verticalheader.php';
	$dao = new DAO('dsbd');
	$names = array();
	//table names
	$names = $dao->nomTables();
	if(isset($_POST['table_name']))
		$table_name=$_POST['table_name'];
	else
		$table_name = $names[1];
	//to get column names
	$l = $dao->getColumns($table_name);
	//cond to check if there is no empty fields
    $cond=0;
    $values = array();
    foreach($l as $col){
    	//if it's an image then uploads it
    	if($col=='image'){
    		//ajout image
    		if(!is_null($_FILES['image'])){
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
    	else{
    		if(isset($_POST[$col]))
	    		$values[] = $_POST[$col];
    		else{
    			$cond++;
    			break;
    		}
    	}
    }
    if($cond==0){
    	$dao->insert($table_name,$values);
    }
?>
<!--
<div class="row">
<div class="col-9 col-sm-9 col-md-10 col-lg-10 col-xl-10">
-->

		<form method="POST" class="form" role="form" enctype="multipart/form-data"> 
			<div class="container" id="cont">

		<div class="card mt-3">
		  	<h4 class="card-header text-center">Insert : </h4>
		  	<div class="card-body">

						<?php
							foreach($l as $colname){
								$dao->genereForm($colname);
				        	}
						?>
						<div class="form-group mx-5">
							<div class="row">
								<div class="col-sm-3 col-lg-3">
									<span>&nbsp;</span>
								</div>
							    <div class="col-sm-offset-2 col-sm-3 col-lg-6">
							        <button type="submit" class="btn btn-danger">Submit</button>
							    </div>
								<div class="col-sm-3 col-lg-3">
									<span>&nbsp;</span>
								</div>			
							</div>			    
						</div>
				</div>
		 	</div>
		</div>					
	</form>
        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
    </div>
            <?php //require 'headerverticalright.php'; ?>	
</body>
</html>