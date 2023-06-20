<?php
	
	define('DB_HOST', 'localhost');
    
	define('DB_USER', 'root');
    
	define('DB_PASSWORD', '');
   
	define('DB_DATABASE', 'taskmanager');

	//1. create a database connection
	$connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	

	$dbCon = mysqli_select_db($connection,DB_DATABASE);

	if (!$connection) {
		die("Database connection failed: ". mysqli_error());
	}

	//FUNCTION CHECK IF USED IN OTHER TABLE
	function IsUsed($TableName,$fldName,$StrData){
		$sql="SELECT ". $fldName . " from " . $TableName . " WHERE " . $fldName ."='". $StrData ."';";
		//echo $sql;
		$result=mysqli_query($connection,$sql);
		if ($result) {
			if (mysqli_num_rows($result)>0) {
				return true;
			}else {
				return false;
			} 
		}else {
			die ("error in sql qry ". mysqli_error()); 
		}
	}//end of function Check if Used
		
?>