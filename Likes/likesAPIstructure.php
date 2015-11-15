<?php

class likesAction {
	
public function addLike($user_id, $photoid ){
        

      //connect to the database
     $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');

  //insert into database

	$query = "INSERT INTO likes SET userid='$user_id', photoid='$photoid'";


		 $result = $conn->query($query);

             if (!$result)

                echo "Problem liking.";
               
             else  {

               // echo "Commented successfully!";
                return "Liked successfully!";
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

    public function numOfLikes(){

            $array = array();
        $counter = 0;

         $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');
   
   $query = "SELECT * FROM likes L, photo P WHERE P.photoid = L.photoid";
        $result = $conn->query($query);
 for ($row =$result->fetch_assoc(); $row !=FALSE; $row = $result->fetch_assoc()){

        $array[$counter] = stripslashes($row["caption"]);
        $counter++;

       }
       $index = count($array);

       return $array;


    }

        public function getInfo($column){
           

            $array = array();
        $counter = 0;

         $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');
   
   $query = "SELECT * FROM likes L, photo P, table_Users T 
   WHERE P.photoid = L.photoid
   AND L.userid = T.userid";

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