<?php
session_start();
?>


<html>
<form method="POST" action="LoginAction.php">

   <head> <center> <h1 style="color:#00688B;font-family:Arial;">picShare </h1></center></head>
       <body>
		<center>
            <div style="background-color: #B4EEB4; border-radius: 25px; 
            border: 2px solid #8AC007;padding: 20px;  width: 400px; height: 165px;">
            
            <center> <h1 style="font-family:Arial;font-size:20px;">  LOG IN </h1>  </center>
            <table>
               <tbody><tr>
                            <td>Email-address: </td>
                            <td><input type="text" name="email" value="" size="40">
                                <br>
                
                            </td>
                        </tr>
                        <td>Password: </td>
                            <td><input type="text" name="passw" value="" size="40">
                                <br>                                                   
                            </td>
                        </tr>
                    </tbody>
             </table>
             <br>
		   	  <div>


            <script type="text/javascript"> 
            function visit() {
              <?php

               $_SESSION['user_id'] = -1;

              ?>
              window.location.assign("http://localhost:8888/picShare/mainPage/mainpage.php")
            }
            
            </script>

	               <input type="submit" value="Log in" name="submit" style="background-color:#0EBFE9;color:white;font-size:16px;"> &nbsp; 
                 <input type="button" onclick ="visit()" value="Visitor" name="submit" style="background-color:#0EBFE9;color:white;font-size:16px;">


	            </div>


        </div>
        <br>
         Dont have an account? Register <a href="http://localhost:8888/picShare/Registration/RegistrationAction.php"> here. </a>
			</center>
        </body>
          </form>

</html>

<?php
//include 'loginStub.php';
include 'loginAPI.php';

			$userName= ($_POST["email"]);
			$passWord = ($_POST["passw"]);
			$boolean ="";
			$userinput ="";


			if(isset($_POST["email"])) {
				$userinput = "true";
			}
			else {
				$userinput ="false";
			}

            if($userinput == "true") {
            	if((!isset($userName)|| $userName  == '') || (!isset($passWord) ||  $passWord== '')) {
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
                //	$data_model = new LoginStub(); //create object of model 
 		    $modelFunc = new loginAPI();
              //check against model functions
 				//$res = $data_model->addLogin($userName, $passWord);
 				$res = $modelFunc->checksLogin($passWord, $userName);
 				if($res == "login success")
 				//if($res == "login successful.")

 				{
 		             $_SESSION['user_id'] = $modelFunc -> getUserID($userName);
 					?>
 					<meta http-equiv="refresh" content="0; url=http://localhost:8888/picShare/Dashboard/DashboardAction.php" /> 
 					<?php
 				}

 				else
 				{
 					echo $res;
 				}

             }



            }






?>