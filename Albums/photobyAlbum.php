<?php
session_start();
 $sessionVar = $_SESSION['user_id'];

echo $sessionVar;
echo "<br>";

if ($sessionVar == -1) {

  ?>
  <ul>
    <li style="display:inline;"> <a href="http://localhost:8888/picShare/mainPage/mainpage.php"> Main Page </a></li>
     <li style="display:inline;"><a href = "http://localhost:8888/picShare/Likes/likesAction.php" >Likes</a></li>
    <li style="display:inline;"><a href="http://localhost:8888/picShare/Comments/comments.php">Comments</a></li>
     <li style="display:inline;"><a href="http://localhost:8888/picShare/Albums/photobyAlbum.php">Browse photos by Album</a></li>
    <li style="display:inline;"><a href="http://localhost:8888/picShare/tags/photobyTag.php">Browse photos by Tag</a></li>
    <li style="display:inline;"><a href="http://localhost:8888/picShare/Login/LoginAction.php">Log In</a></li>
</ul>
  <?php

}

else {
  ?>
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
<?php
}
?>

<html>
<head> </head>
<br>

<body>
	<center> <h2>Albums: </h2></center> 
	<form action="photobyAlbum.php" method="post" enctype ="multipart/form-data">
      Email name: <input type="text" name="email" value="" size="40">
      <br>
      <br>
   		 Album Name: <input type="text" name="album" value="" size="40">
   		 <br>
   		 <br>
   		 <br>

   		<center> <input type ="submit" name="Album" value="Browse Photo by Album"> </center>

	</form>
</html>
	<?php

     include 'APIstructure.php';

    $album_Name= ($_POST["album"]);
    $email= ($_POST["email"]);
	$boolean ="";
	$userinput ="";


	if(isset($_POST["album"])) {
		$userinput = "true";
	}
	else {
	     $userinput ="false";
	}

            if($userinput == "true") {
            	if((!isset($album_Name)|| $album_Name  == '') ||(!isset($email)|| $email  == '') ) {
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
                if ($boolean == "true") {
                $modelFunc = new albumAPI(); //create object of model 


               $user_id = $modelFunc->getUserID($email);
            //   echo "user id here:".$user_id;
               echo "<br>";
               
               $album_id = $modelFunc->getALBUMID($user_id, $album_Name);
           //    echo "album id here: ".$album_id;
               echo "<br>";
               
               $photo_id = $modelFunc->AlbumPhotos($album_id, "photoid");
 			      //   $photos = $modelFunc->returnPhoto($album_id,"binary");
               $photonames = $modelFunc->UserPhotos($user_id, "caption");
 			        //  echo "photo id here:".$photo_id;
                $length = count($photo_id);


              for ($i=0; $i<$length; $i++){
             // echo "last id: ".$lastid;

             echo $photonames[$i].":</p><img src=../Albums/get.php?id=".$photo_id[$i]."/>";
             echo "<br>";
             echo "<br>";
           }



       }



     }



	?>


</body>

</html>