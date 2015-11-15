
<?php


class loginAPI{


				
	//Function to Add people
  public function checksLogin($pwd, $eml){


 //connect to the database

  	 $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');


//echo "$pwd";
echo "<br>";
//echo "$eml";
echo "<br>";

//Check for duplicates cause we cant have them
	$query = "SELECT * FROM table_Users WHERE email='$eml' and password='$pwd' ";

	$result = $conn->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	$row = $result->fetch_assoc();

	if ($row['email']==$eml && $row['password']==$pwd){

return "login success";

}
else {
echo "not found in database";

}



	}

	    public function getUserID($email) {

	 $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');

    	$query = "SELECT * FROM table_Users WHERE email ='$email'";

    	$result = $conn->query($query);
    	$row = $result->fetch_assoc();

    	return $row['userid'];


    }




	}
//unit tests
	/*
	$model = new loginAPI();

	$return=$model->checksLogin("d", "cynthiac256@gmail.com");
	$return=$model->checksLogin("d", "d");
	$return=$model->checksLogin("dix", "dix");

	echo "$return";
	echo "<br>";
	echo "<br>";
	*/


	?>