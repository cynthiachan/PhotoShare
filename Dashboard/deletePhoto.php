<?php
session_start();

echo $_SESSION['user_id'];

?>

<html>
<head> <center> <h2>Deleting Photo: </h2></center> </head>
<br>

<body>
	
	<form action="deletePhoto.php" method="post" enctype ="multipart/form-data">

    Photo Name:
     <input type ="text" name ="photo">
     <br>
     <br>
      Album Name:
     <input type = "text" name ="album">
     <br>
     <br>
     <br>
     <!--delete-->
      <input type ="submit" value="Delete Photo">


     </form>
 



</body>

</html>
<?php

  include 'apidashboard.php';


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
         if((!isset($photoName)|| $photoName  == '') ||(!isset($albumName) ||  $albumName== '') ) {
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
  //end of error checking that works 

   //delete:


//connect to database

  $link = mysql_connect('localhost','root','root');
$conn = new mysqli('localhost', 'root', 'root','picShare');

//get photo id
 $modelFunc = new dashboardAPI();

 $album_id = $modelFunc->getALBUMID($_SESSION['user_id'],$albumName);
$photo_id = $modelFunc->getPHOTOID($album_id, $photoName);


$query = "DELETE FROM photo WHERE photoid = $photo_id AND caption = '$photoName'";
//we connect here to  the database to execute our query
$result = $conn->query($query);

             if (!$result)

                echo "Problem deleting photo.";
               
             else  {

             echo "Photo deleted successfully!";
            
        }


?>