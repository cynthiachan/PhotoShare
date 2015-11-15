<?php
session_start();
echo $_SESSION['user_id'];
?>

<html>
<head> <ul >
   <li style="display:inline;"> <a href="http://localhost:8888/picShare/Dashboard/DashboardAction.php"> Dashboard </a></li>
  <li style="display:inline;"> <a href="http://localhost:8888/picShare/mainPage/mainpage.php"> Main Page </a></li>
  <li style="display:inline;"><a href = "http://localhost:8888/picShare/Likes/likesAction.php" >Likes</a></li>
  <li style="display:inline;"><a href = "http://localhost:8888/picShare/Friends/friendAction.php">Friends</a></li>
   <li style="display:inline;"><a href="http://localhost:8888/picShare/Comments/comments.php">Comments</a></li>
    <li style="display:inline;"><a href = "http://localhost:8888/picShare/Albums/AlbumAction.php"> Albums</a></li>
    <li style="display:inline;"><a href="http://localhost:8888/picShare/tags/tagsAction.php">Tags</a></li>
     <li style="display:inline;"> <a href="http://localhost:8888/picShare/Login/LoginAction.php"> Log Out</a><li>
</ul></head>
<br>

<body>
	<center> <h2>Albums: </h2></center> 
	<form action="AlbumAction.php" method="post" enctype ="multipart/form-data">
   		 Album Name: <input type="text" name="album" value="" size="40">
   		 <br>
   		 <br>
   		 <br>
        <script type="text/javascript"> 
            function browse() {

              window.location.assign("http://localhost:8888/picShare/Albums/photobyAlbum.php")
            }
            
        </script>

   		<center> <input type ="submit" name="Submit" value="Create"> </center>
      <br>
      <br>
      <center> <input type ="button" onclick="browse()" value="Browse Photos by Album"> </center>

	</form>

	<?php

     include 'APIstructure.php';

    $album_Name= ($_POST["album"]);
	$boolean ="";
	$userinput ="";


	if(isset($_POST["album"])) {
		$userinput = "true";
	}
	else {
	     $userinput ="false";
	}

            if($userinput == "true") {
            	if((!isset($album_Name)|| $album_Name  == '')) {
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

 				$res = $modelFunc->addAlbum($_SESSION['user_id'],$album_Name,date("m.d.y"));
 			  	if($res == "Album creation successful.")

 				{
            echo "Album created successfully!";
 				}

 				else
 				{
 					echo $res;
 				}

       }



     }



	?>


</body>

</html>