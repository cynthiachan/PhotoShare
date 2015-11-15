
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
<head> 


<body>
  <center> <h2>View all Photos: </h2></center>
  
  <form action="photobyTag.php" method="post" enctype ="multipart/form-data">
    
   Email-Address:
     <input type = "text" name = "emailz">
     <br>
     Tags:
     <input type = "text" name ="tags">
     <br>
     <br>
     <input type ="submit" value="View ">
     <br>
     <br>
           <script type="text/javascript"> 
            function browse() {

              window.location.assign("http://localhost:8888/picShare/tags/yourPhotosByTag.php")
            }
            
        </script>
     <input type ="button" onclick = "browse()" value="Browse your photos by Tag ">

  </form>

</body>

</html>

<?php

include 'tagAPIstructure.php';

   $email = ($_POST["emailz"]);
   $tags = ($_POST["tags"]);

   $boolean ="";
   $userinput ="";

  if(isset($_POST["emailz"])) {
        $userinput = "true";
      }
      else {
        $userinput ="false";
      }

     if($userinput == "true") {
         if((!isset($email)|| $email  == '') || (!isset($tags) ||  $tags== '') ) {
          echo "<html>";
          echo "<center>";
          echo "<div style=color:red;>Fields were filled in incorrectly. Please try again!</div>";
          echo "</center>";
          echo "</html>";
          $boolean="false";
         }

          else {
                $boolean ="true";

                $modelFunc = new tagFunctions(); //create object of model 
               
               $user_id = $modelFunc->getUserID($email);

                $photo_id = $modelFunc->getPhotoByTag($user_id, $tags);
   
                 $photos = $modelFunc ->displayPhotos($photo_id, "photoid");

                  $photonames = $modelFunc->UserPhotos($user_id, "caption");
 			        //  echo "photo id here:".$photo_id;
                $length = count($photo_id);


              for ($i=0; $i<$length; $i++){
             // echo "last id: ".$lastid;

             echo $photonames[$i].":</p><img src=../tags/get.php?id=".$photos[$i]."/>";
             echo "<br>";
             echo "<br>";
           }

           }

       }


?>