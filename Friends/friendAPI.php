<?php

class friendAPI {


	public function addFriend($userID, $friendID ) 
	{
		echo "<br>";
	//	echo "friend id:".$friendID;
		echo "<br>";

   $link = mysql_connect('localhost','root','root');
   $conn = new mysqli('localhost', 'root', 'root','picShare');


	//insert into database

	$query = "INSERT INTO friends SET userid='$userID', friendid ='$friendID';";

	$conn->query($query) or die("Insert failed: ".$conn->error);

		return ("You successfully added a friend.");

	}


	 public function getUserID($email) {

	 $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');

    	$query = "SELECT * FROM table_Users WHERE email ='$email'";

    	$result = $conn->query($query);
    	$row = $result->fetch_assoc();

    //	echo "row:".$row['userid'];

    	return $row['userid'];


    }

    public function getFriendIDs($user_id, $column) {
    	$array = array();
        $counter = 0;

     $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');
       $query = "SELECT * FROM friends WHERE userid = '$user_id'";
       $result = $conn->query($query);

       for ($row =$result->fetch_assoc(); $row !=FALSE; $row = $result->fetch_assoc()){

        
        $array[$counter] = stripslashes($row[$column]);
        $counter++;


       }
       $index = count($array);

       return $array;
       echo $array;

    }

        public function getFRIENDID($user_id) {
    //connect to the database
     $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');

//select photo to delete
       // $query = "SELECT * FROM albums WHERE userid='$user_id' and name='$albumN' ";
        $query = "SELECT * FROM friends WHERE friendid = '$user_id'";


        $result = $conn->query($query);
        $row = $result->fetch_assoc();

        return $row['friendid'];
            
    }

        public function getEmail($friend_id, $column) {

          

    	$array = array();
        $counter = 0;

     $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');
     
       $query = "SELECT * FROM table_Users WHERE userid = '$friend_id'";
       $result = $conn->query($query);


       $row =$result->fetch_assoc();


       return $row['email'];

    }




}

?>