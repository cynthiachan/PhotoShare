<?php
session_start();

echo $_SESSION['user_id'];

?>

<html>
<head> 
<ul>
   <li style="display:inline;"> <a href="http://localhost:8888/picShare/Dashboard/DashboardAction.php"> Dashboard </a></li>
  <li style="display:inline;"> <a href="http://localhost:8888/picShare/mainPage/mainpage.php"> Main Page </a></li>
  <li style="display:inline;"><a href = "http://localhost:8888/picShare/Likes/likesAction.php" >Likes</a></li>
  <li style="display:inline;"><a href = "http://localhost:8888/picShare/Friends/friendAction.php">Friends</a></li>
   <li style="display:inline;"><a href="http://localhost:8888/picShare/Comments/comments.php">Comments</a></li>
    <li style="display:inline;"><a href = "http://localhost:8888/picShare/Albums/AlbumAction.php"> Albums</a></li>
    <li style="display:inline;"><a href="http://localhost:8888/picShare/tags/tagsAction.php">Tags</a></li>
   <li style="display:inline;"> <a href="http://localhost:8888/picShare/Login/LoginAction.php"> Log Out</a><li>
</ul>
  
</head>
<br>

<body>
	<center> <h2>Dashboard: </h2></center> 
	<form action="DashboardAction.php" method="post" enctype ="multipart/form-data">
    Photo Name:
     <input type ="text" name ="photo">
     <br>
     Album Name:
     <input type = "text" name ="album">
     <br>
     <br>
     

   		 Select File: 

   		 <input type ="file" name="picture">
   		 <input type ="submit" value="Upload Photos">


	</form>

 

 
</body>

</html>

	<?php

  include 'apidashboard.php';

  //private $album_id;

      $photoName = ($_POST["photo"]);
      $albumName = ($_POST["album"]);

      $boolean ="";
      $userinput ="";


  if(isset($_POST["photo"])) {
        $userinput = "true";
      }
      else {
        $userinput ="false";
      }

         if($userinput == "true") {
         if((!isset($photoName)|| $photoName  == '') || (!isset($albumName) ||  $albumName== '') ) {
          echo "<html>";
          echo "<center>";
          echo "<div style=color:red;>Fields were filled in incorrectly. Please try again!</div>";
          echo "</center>";
          echo "</html>";
          $boolean="false";
         }

          else {
                $boolean ="true";


           }
 
         }
//end of errorchecking + getting album id

//start of upload photo

  //connect to database
  mysql_connect("localhost","root","root") or die(mysql_error());
  mysql_select_db("picShare") or die(mysql_error());

//uploading pics
  $file = $_FILES['picture']['tmp_name'];

   //if file has not been submitted
    if(!isset($file)) {
      echo "Please select an image.";
    }
    
    else {
       $image = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
       $imageName = addslashes($_FILES['picture']['name']);
       $imageSize = getimagesize($_FILES['picture']['tmp_name']);

      //dashboard
        $modelFunc = new dashboardAPI();
     
        $album_id = $modelFunc->getALBUMID($_SESSION['user_id'],$albumName);
    
        //echo $album_id;
       //check if image or not
      
       if ($imageSize == false) {
          echo "That's not an image.";
        }

         
       else {
      $link = mysql_connect('localhost','root','root') or die(mysql_error());
     $conn = new mysqli('localhost', 'root', 'root','picShare') or die(mysql_error());

     
      $query = "INSERT INTO photo VALUES ('','$album_id','$photoName','$image')"; 
        //we connect here to the database to execute our query
        $result = $conn->query($query);


             if (!$result)

                echo "Problem uploading image.";
               
             else  {
              //returns last id inserted
              $lastid = $modelFunc->UserPhotos($_SESSION['user_id'], "photoid");
              $photonames = $modelFunc->UserPhotos($_SESSION['user_id'], "caption");

              $length = count($lastid);


              for ($i=0; $i<$length; $i++){
             // echo "last id: ".$lastid;

             echo $photonames[$i].":<br></p><img src=../Dashboard/get.php?id=".$lastid[$i]."/>";
            echo "<br>";
             echo "<br>";
           }

        }
         

    }
       


}



?>