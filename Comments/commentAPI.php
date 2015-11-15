<?php

class commentAPI {
	

	public function addComment($user_id, $photoid, $comment, $dateCreated ){
        

      //connect to the database
     $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');

  //insert into database

	$query = "INSERT INTO comment SET userid='$user_id', photoid='$photoid', `text` ='$comment', `date`='$dateCreated'";

	//$conn->query($query) or die("Insert failed: ".$conn->error);

		//return ("Commented successfully!");

		 $result = $conn->query($query);

             if (!$result)

                echo "Problem commenting.";
               
             else  {

               // echo "Commented successfully!";
                return "Commented successfully!";
             }
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

	 public function getPHOTOID($album_id, $photoN) {
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