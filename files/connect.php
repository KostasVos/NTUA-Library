<?php

	$mysql_host = 'localhost:3306';
	$mysql_user = 'root';
	$mysql_pass = '';
	$mysql_db = 'library_db';

	$mysql_connection = mysqli_connect($mysql_host,$mysql_user,$mysql_pass);
	mysqli_set_charset($mysql_connection,'utf8');

	if(!$mysql_connection || !mysqli_select_db($mysql_connection,$mysql_db))
	{
		die("Could not connect to database");
	}
?>