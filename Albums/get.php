<?php

	//connect to database
	mysql_connect("localhost","root","root") or die(mysql_error());
	mysql_select_db("picShare") or die(mysql_error());


	$id = addslashes($_REQUEST['id']);
    
    $picture = mysql_query("SELECT * FROM photo WHERE photoid = '$id'");
    $picture = mysql_fetch_assoc($picture);
    $picture = $picture['binary'];

    header("Content-type: image/png");

    echo $picture;

 


?>