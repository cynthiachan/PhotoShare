<?php
session_start();
echo $_SESSION['user_id'];
?>

<html>
<head> 
<ul >
   <li style="display:inline;"> <a href="http://localhost:8888/picShare/Dashboard/DashboardAction.php"> Dashboard </a></li>
  <li style="display:inline;"> <a href="http://localhost:8888/picShare/mainPage/mainpage.php"> Main Page </a></li>
  <li style="display:inline;"><a href = "http://localhost:8888/picShare/Likes/likesAction.php" >Likes</a></li>
  <li style="display:inline;"><a href = "http://localhost:8888/picShare/Friends/friendAction.php">Friends</a></li>
   <li style="display:inline;"><a href="http://localhost:8888/picShare/Comments/comments.php">Comments</a></li>
    <li style="display:inline;"><a href = "http://localhost:8888/picShare/Albums/AlbumAction.php"> Albums</a></li>
    <li style="display:inline;"><a href="http://localhost:8888/picShare/tags/tagsAction.php">Tags</a></li>
     <li style="display:inline;"> <a href="http://localhost:8888/picShare/Login/LoginAction.php"> Log Out</a><li>
  
</ul> </head>
<br>

<body>
  <center> <h2>TAGGING: </h2></center>
  
  <form action="tagsAction.php" method="post" enctype ="multipart/form-data">
    Email-Address:
     <input type ="text" name ="emailz">
     <br>
     Album name:
     <input type = "text" name ="albumN">
     <br>
     Photo name:
     <input type ="text" name ="photoN">
     <br>
    Tags:
     <input type = "text" name ="tags">
     <br>
     <br>
     <br>
      <script type="text/javascript"> 
            function browse() {

              window.location.assign("http://localhost:8888/picShare/tags/photobyTag.php")
            }
            
        </script>
     <input type ="submit" value=" Tag ">
     <input type ="button" onclick="browse()" value="Browse Photos by tags">

  </form>

</body>

</html>

<?php

include 'tagAPIstructure.php';

   $email = ($_POST["emailz"]);
   $albumName = ($_POST["albumN"]);
   $photoName = ($_POST["photoN"]);
   $userTag = ($_POST["tags"]);

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

           }

       if ($boolean == "true") {


        
           $modelFunc = new tagFunctions(); //create object of model 

        $user_id = $modelFunc->getUserID($email);
        echo "user id:".$user_id;
        $album_id = $modelFunc-> getALBUMID($user_id,$albumName);

        echo "album id:".$album_id;

           
        $photo_id = $modelFunc->getPHOTOID($album_id, $photoName);
      
        $res = $modelFunc->addTag($photo_id, $userTag);


          if($res == "Tagged successfully!")

        {
            echo "Tag created successfully!";
            echo "<br>";
        }

        else
        {
          echo "Tag problem.";
        }


    }
 
}






?>