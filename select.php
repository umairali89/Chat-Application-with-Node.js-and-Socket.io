<?php

	@mysql_connect("localhost","root","");
	mysql_select_db("nodetest") or die ("Couldn't find database");
	 
	$query = mysql_query("SELECT * FROM chatschema");
	$numrows = mysql_num_rows($query);
	 
	if($numrows !=0)
	{
		while ($rows = mysql_fetch_assoc($query))
		{
	 
			$nick = $rows['nick'];
			$msg = $rows['msg'];
			
			echo $fname;
			echo $lname;
		}
	}
	else
	die ("That user doesn't exist");
?>