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
  <center> <h2>View Most Popular Tags: </h2></center>
  

</body>

</html>


<?php

include 'tagAPIstructure.php';

$modelFunc = new tagFunctions();

$tags = $modelFunc->mostPopularTags();

$temp = array_count_values($tags);

echo "[tags]=>num of occurrences:";
echo "<br>";
echo "<br>";
 print_r($temp);





?>