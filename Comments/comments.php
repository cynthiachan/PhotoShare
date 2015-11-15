
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
  <center> <h2>COMMENTING: </h2></center>
  
  <form action="comments.php" method="post" enctype ="multipart/form-data">
    Email-Address:
     <input type ="text" name ="emailz">
     <br>
     Album name:
     <input type = "text" name ="albumN">
     <br>
     Photo name:
     <input type ="text" name ="photoN">
     <br>
     Comment:
     <input type = "text" name ="Comment">
     <br>
     <br>
     <br>
     <input type ="submit" value="comment">

  </form>

</body>

</html>

<?php

include 'commentAPI.php';

   $email = ($_POST["emailz"]);
   $albumName = ($_POST["albumN"]);
   $photoName = ($_POST["photoN"]);
   $comment = ($_POST["Comment"]);

   $boolean ="";
   $userinput ="";

  if(isset($_POST["emailz"])) {
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
              //  echo "yah";

           }

       if ($boolean == "true") {



           $modelFunc = new commentAPI(); //create object of model 

         $user_id = $modelFunc->getUserID($email);
         $album_id = $modelFunc-> getALBUMID($user_id,$albumName);
           
           $photo_id = $modelFunc->getPHOTOID($album_id, $photoName);

           $res = $modelFunc->addComment($_SESSION['user_id'],$photo_id,$comment,date("m.d.y"));


          if($res == "Commented successfully!")

        {
            echo "comment created successfully!";
            echo "<br>";
            echo "Your comment:".$comment;
        }

        else
        {
          echo "comment problemo";
        }


    }
 
}






?>