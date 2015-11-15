
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

<body>
  <center> <h1> MAIN PAGE:</h1> </center>
</body>
</html>

<?php

include 'MainPageAPI.php';
//connect to database
   $link = mysql_connect('localhost','root','root') or die(mysql_error());
     $conn = new mysqli('localhost', 'root', 'root','picShare') or die(mysql_error());
    
    $modelFunc = new mainPageAPI();
  //returns last id inserted
              $lastid = $modelFunc->displayALLPhotos("photoid");
              $photonames = $modelFunc->displayALLPhotos("caption");

              $length = count($lastid);


              for ($i=0; $i<$length; $i++){
             // echo "last id: ".$lastid;

             echo $photonames[$i].": <br><br><img src=../mainPage/get.php?id=".$lastid[$i]."/>";
             echo "<br>";
             echo "<br>";
         }


?>