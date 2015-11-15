<?php
session_start();

echo $_SESSION['user_id'];

?>

<html>
<head> <center> <h2>Deleting Album: </h2></center> </head>
<br>

<body>
	
	<form action="deleteAlbum.php" method="post" enctype ="multipart/form-data">

      Album Name:
     <input type = "text" name ="album">
     <br>
     <br>
     <br>
     <!--delete-->
    <input type ="submit" value="Delete Album">

     </form>
 



</body>

</html>
<?php

  include 'APIstructure.php';


    $albumName = ($_POST["album"]);


         $boolean ="";
      $userinput ="";


  if(isset($_POST["album"])) {
        $userinput = "true";
      }
      else {
        $userinput ="false";
      }

         if($userinput == "true") {
         if(!isset($albumName) ||  $albumName== '') {
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

         if ($boolean =="true"){
          

  $link = mysql_connect('localhost','root','root');
$conn = new mysqli('localhost', 'root', 'root','picShare');

//get photo id
 $modelFunc = new albumAPI();

 $album_id = $modelFunc->getALBUMID($_SESSION['user_id'],$albumName);
 $userID =$_SESSION['user_id'];


 echo $album_id;
   $link2 = mysql_connect('localhost','root','root');
$conn2 = new mysqli('localhost', 'root', 'root','picShare');


 $userID =$_SESSION['user_id'];
 echo $userID;
$query2 = "DELETE FROM albums WHERE userid ='$userID' AND name = '$albumName'";

//we connect here to  the database to execute our query
$result2 = $conn2->query($query2);

             if (!$result2) {
                echo "Problem deleting album.";
              }
               
             else  {

             echo "Album deleted successfully!";
             echo "<br>";
             echo "<br>";

}


        $query = "DELETE FROM photo WHERE albumid ='$album_id'";

        $result = $conn->query($query);



             if (!$result) {
                echo "Problem deleting album2.";
              }
               
             else  {

             echo "Pictures deleted successfully!";
          
  
        }
      }


?>