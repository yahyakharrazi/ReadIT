<?php
	if(isset($_POST['db_name'])){
		$strcon = 'mysql:host=localhost;dbname='.$_POST['db_name'];
    	$pdo = new PDO($strcon, 'root', '');
    	$re="select TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE 
    	TABLE_TYPE='BASE TABLE' AND TABLE_SCHEMA='"	.$_POST['db_name']."'";
    	$names = $pdo->query($re)->fetchAll();
    	foreach ($names as $n) {
            $req = "SHOW COLUMNS FROM ".$n["TABLE_NAME"];
        	$result = $pdo->query($req)->fetchAll();$l = array();
        	foreach ($result as $k) {$l[] = $k['Field'];}
        	$myfile = fopen('./classes/'.$n["TABLE_NAME"].".php","w");
        	$txt = "<?php class ".$n["TABLE_NAME"]."{
        		";
        	foreach($l as $colname){$txt .=' public $'.$colname.';
        		';}$i=0;
        	foreach($l as $ll){$i++;}
        	$txt.='public function __construct($tab){
    			';
    		for ($i=0; $i < count($l); $i++) { 
    			$txt.='$this->'.$l[$i].'=$tab['.$i.'];
    			';}
    		$txt.='}
    	}	?>';
        fwrite($myfile, $txt);fclose($myfile);}}?>
<!DOCTYPE html><html><body><form method="POST" action="">
		database : <input type="text" name="db_name">&nbsp;<button name="ok">Create</button>
	</form></body></html>