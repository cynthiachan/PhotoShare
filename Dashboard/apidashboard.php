<?php

class dashboardAPI{


				
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