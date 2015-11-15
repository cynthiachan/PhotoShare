<?php
class tagFunctions{


	public function addTag($photoid, $user_tag){
      //  echo "dicksss";

      //connect to the database
     $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');

  //insert into database

	$query = "INSERT INTO tag SET photoid='$photoid', tags='$user_tag'";

		 $result = $conn->query($query);

             if (!$result)

                echo "Problem tagging.";
               
             else  {

                return "Tagged successfully!";
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
     // echo "photooooz";
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

	 public function getPhotoByTag($user_id, $tag) {
        $array = array();
        $counter = 0;
     //connect to the database
	 $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');

//select album id
    	$query = "SELECT * FROM tag T, photo P WHERE tags = '$tag' AND T.photoid = P.photoid";

    	$result = $conn->query($query);
    	$row = $result->fetch_assoc();

    	return $row['photoid'];

    }

    public function displayPhotos($photo_id, $column){

        $array = array();
        $counter = 0;

         $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');
        $query = "SELECT * FROM photo WHERE photoid = '$photo_id'";
       $result = $conn->query($query);

       for ($row =$result->fetch_assoc(); $row !=FALSE; $row = $result->fetch_assoc()){

        
        $array[$counter] = stripslashes($row[$column]);
        $counter++;


       }
       $index = count($array);

       return $array;

    }



         public function getUserID($email) {

     $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');

        $query = "SELECT * FROM table_Users WHERE email ='$email'";

        $result = $conn->query($query);
        $row = $result->fetch_assoc();

    //  echo "row:".$row['userid'];

        return $row['userid'];


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

    public function mostPopularTags() {
      
                $array = array();
        $counter = 0;

         $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');
   
   $query = "SELECT * FROM tag";
        $result = $conn->query($query);
 for ($row =$result->fetch_assoc(); $row !=FALSE; $row = $result->fetch_assoc()){

        $array[$counter] = stripslashes($row["tags"]);
        $counter++;

       }
       $index = count($array);

       return $array;

    }

}

?>