<?php
session_start();
echo $_SESSION['user_id'];
?>

<html>
<head>  <ul >
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
  <center> <h2>Add Friends: </h2></center>
	<form action="friendAction.php" method="post" enctype ="multipart/form-data">

	     Add a Friend: <input type="text" name="friend" value="" size="40">
   		 <br>
   		 <br>
   		 <br>

   		<center> <input type ="submit" name="Submit" value="Add Friend"> </center>
   	</form>
</body>
</html>
<?php

include 'friendAPI.php';

    $friend_Name = ($_POST["friend"]);

	$boolean ="";
	$userinput ="";


	if(isset($_POST["friend"])) {
		$userinput = "true";
	}
	else {
	     $userinput ="false";
	}

            if($userinput == "true") {
            	if((!isset($friend_Name)|| $friend_Name  == '')) {
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
            	
                $modelFunc = new friendAPI();
               //create object of model 
 				//$res = $data_model->addLogin($userName, $passWord);
 				//echo $_SESSION['user_id'];
 				$res = $modelFunc->addFriend($_SESSION['user_id'],$modelFunc->getUserID($friend_Name));

              //display friend

        $friend_id = $modelFunc->getFriendIDs($_SESSION['user_id'],"friendid");

        $friend = $modelFunc->getFRIENDID($_SESSION['user_id']);

        $emails = $modelFunc->getEmail($friend,"photoid");
       
        //if($res == "album name created");
        if($res == "You successfully added a friend.")

        {
             //    $_SESSION['user_id'] = $modelFunc -> getUserID($userName);
          echo $friend_Name." is now in your friend list!";
          echo "<br>";
          echo "<br>";
          echo "Your new list of friends:";
          echo "<br>";
          echo "<br>";
          $length = count($friend_id);
         for ($i=0; $i<$length; $i++){

             echo $modelFunc->getEmail($friend_id[$i])."<br>";
             
           }
           

 				}

 				else
 				{
 					echo $res;
 				}

       }
           }

?>