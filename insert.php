
 <?php 		 
	$con = @mysql_connect("localhost","root","");
	 if (!$con) 
	 {
	 die('Could not connect: ' . mysql_error()); 
	 } 
	 
	 mysql_select_db("nodetest", $con); 
		 $sql="INSERT INTO chatschema 
		 (nick,
		 msg,
		 created) 
		 VALUES 
		 ('$_POST[nick]',
		 '$_POST[msg]',
		 now())"; 
	 if (!mysql_query($sql,$con)) 
	 { 
	 die('Error: ' . mysql_error()); 
	 } 
	 echo("Success!")
 ?>
 