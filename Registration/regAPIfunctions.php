
<?php

class APIstructure{


				
	//Function to add Users
  public function addUserPerson($pwd, $eml, $fname, $lname, $bday, $htown, $cad,$edu){

//connect to the database

  	 $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');



//check for duplicate emails
	$query = "SELECT * FROM table_Users WHERE email= '$eml'";

	$result = $conn->query ( $query ) or die('SELECT query failed: ' . mysql_error());
$row = $result->fetch_assoc();

if ($row['email']==$eml){

return "Email has already been used";

}


	//insert into database

	$query = "INSERT INTO table_Users SET  password='$pwd' , email ='$eml',  firstName ='$fname' ,lastName= '$lname', birthDay='$bday', birthAddress='$htown', currentAddress= '$cad' , levelofEdu='$edu';";

	$conn->query($query) or die("Insert failed: ".$conn->error);

		return ("Registration successful.");

	}

  //get user ids from the person 
    public function getUserID($email) {

        $link = mysql_connect('localhost','root','root');
    	$conn = new mysqli('localhost', 'root', 'root','picShare');


    	$query = "SELECT * FROM table_Users WHERE email ='$email'";

    	$result = $conn->query($query);
    	$row = $result->fetch_assoc();

    	return $row['userid'];


    }


	}



	?>