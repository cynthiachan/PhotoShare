<?php

class albumAPI {


		
	//Function to Add people
  public function addAlbum($userid, $albumName, $dateCreated){

$link = mysql_connect('localhost','root','root');
$conn = new mysqli('localhost', 'root', 'root','picShare');




//Check for duplicates
	$query = "SELECT * FROM albums WHERE userid = '$userid' AND name ='$albumName'";

	$result = $conn->query ( $query ) or die('SELECT query failed: ' . mysql_error());
    $row = $result->fetch_assoc();

	if ($row['name']==$albumName){

	return "Album name has already been used";

}



	//insert into database

	$query = "INSERT INTO albums SET userid='$userid', name ='$albumName', `date`='$dateCreated';";

	$conn->query($query) or die("Insert failed: ".$conn->error);

		return ("Album creation successful.");

	}


      public function getALBUMID($user_id, $albumN) {
     //connect to the database
	 $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');

//select album id
    	$query = "SELECT * FROM albums WHERE userid='$user_id' and name='$albumN' ";

    	$result = $conn->query($query);
    	$row = $result->fetch_assoc();

    	return $row['albumid'];

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


     public function getPHOTOID($album_id, $photoN) {
     //	echo "photooooz";
    //connect to the database
     $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');

//select photo to delete
       // $query = "SELECT * FROM albums WHERE userid='$user_id' and name='$albumN' ";
        $query = "SELECT * FROM photo WHERE albumid = $album_id AND caption = '$photoN'";


        $result = $conn->query($query);
        $row = $result->fetch_assoc();

        return $row['photoid'];
            
    }

    public function AlbumPhotos($album_id, $column){

        $array = array();
        $counter = 0;

         $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');
       $query = "SELECT * FROM photo M, albums D WHERE D.albumid = '$album_id' AND D.albumid = M.albumid";
       $result = $conn->query($query);

       for ($row =$result->fetch_assoc(); $row !=FALSE; $row = $result->fetch_assoc()){

        
        $array[$counter] = stripslashes($row[$column]);
        $counter++;



       }
       $index = count($array);

       return $array;

    }

        public function UserPhotos($userid, $column){

        $array = array();
        $counter = 0;

         $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');
       $query = "SELECT * FROM photo M, albums D WHERE D.userid = '$userid' AND D.albumid = M.albumid";
       $result = $conn->query($query);

       for ($row =$result->fetch_assoc(); $row !=FALSE; $row = $result->fetch_assoc()){

        
        $array[$counter] = stripslashes($row[$column]);
        $counter++;



       }
       $index = count($array);

       return $array;





    }
  

}

?>