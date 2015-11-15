<?php
session_start();

?>



<html>
<form method="POST" action="RegistrationAction.php">
			<head> <center> <h1 style="color:#00688B;font-family:Arial;">picShare </h1></center></head>
			<body>
				<center>
				<div style="
				background-color: #B4EEB4;
    border-radius: 25px;
    border: 2px solid #8AC007;
    padding: 20px; 
    width: 400px;
    height: 350px;">
				<center> <h1 style="font-family:Arial;font-size:20px;"> Sign Up </h1></center>
                    <table>
	
						<tbody><tr>
                            <td>First Name: </td>
                            <td><input type="text" name="firstname" value="" size="40">
                                <br>
                                                                   
                                </div>
                            </td>
                        </tr>
                        <td>Last Name: </td>
                            <td><input type="text" name="lastname" value="" size="40">
                                <br>
                                                                   
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>E-mail Address: </td>
                            <td><input type="text" name="emailAdd" value="" size="40">
                                <br>
                                
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="password" value="" size="40">
                                <br>
                                
                                </div>
                            </td>
                        </tr>
                       <td>Date of birth: </td>
                            <td><input type="text" name="dob" value="" size="40">
                                <br>
                                                                   
                                </div>
                            </td>
                        </tr>
                         <td>Home Address: </td>
                            <td><input type="text" name="haddr" value="" size="40">
                                <br>
                                                                
                                </div>
                            </td>
                        </tr>
                        <td>Current Address: </td>
                            <td><input type="text" name="caddr" value="" size="40">
                                <br>
                                                                 
                                </div>
                            </td>
                        </tr>
                        <td>Education: </td>
                            <td><input type="text" name="education" value="" size="40">
                                <br>
                                                                
                                </div>
                            </td>
                        </tr>
                        <tr> <td></td>
                            <td>
                                <br>
                                <div style="font-size:11px; color:red; top:2px">
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                    <div>
                       <!-- <input type="reset" value="Reset" name="reset" size="10"> &nbsp;-->
                        <input type="submit" value="Create Account" name="submit" style="background-color:#0EBFE9;color:white;font-size:22px;">
                        <br>
                        <br>
                        Or <a href="http://localhost:8888/picShare/Login/LoginAction.php"> log in here</a>
                    </div>
                </div>
            </center>
                </body>
             </form>
</html>
<!--end of html code-->

<!--start of php code-->
<?php
include 'regAPIfunctions.php';

 
			$firstName = ($_POST["firstname"]);
			$lastName = ($_POST["lastname"]);
			$emailAddress = ($_POST["emailAdd"]);
			$passWord= ($_POST["password"]);
			$birthDate = ($_POST["dob"]);
			$homeAddress = ($_POST["haddr"]);
			$currentAddress = ($_POST["caddr"]);
			$education = ($_POST["education"]);
			$booleanFlag="";
			$userinput="";

			if(isset($_POST["firstname"])){
				$userinput="true";
    
			}
			else{
			$userinput="false";
			//echo $this->context;

		}



			if ($userinput=="true"){
  

	if((!isset($education )|| $education  == '') || (!isset($currentAddress) || 
$currentAddress== '')|| (!isset($homeAddress) || $homeAddress == '') ||
 (!isset($birthDate) || $birthDate == '') || (!isset($passWord) || 
 $passWord == '')|| (!isset($emailAddress) || $emailAddress == '')|| 
 (!isset($lastName) || $lastName == '')|| (!isset($firstName)) ||
  $firstName == ''){
			echo "<html>";
            echo "<center>";
			echo "<div style=color:red;>Fields were filled in incorrectly. Please try again!</div>";
            echo "</center>";
			echo "</html>";

				
			$booleanFlag="false";
			}
			else {
         $booleanFlag="true";

			}


      
			if ($booleanFlag=="true"){


			$modelFunc = new APIstructure();
			$result = $modelFunc->addUserPerson($passWord,$emailAddress, $firstName, $lastName, $birthDate, $homeAddress ,$currentAddress, $education);
							if($result == "Registration successful."){
				//	echo "<script type='text/javascript'>alert('Welcome to picShare! You're registered! );history.back();</script>";	

                 //    set session["userid"] to the get id function from the API using the emailAddress
                   $_SESSION['user_id'] = $modelFunc -> getUserID($emailAddress);
					?>
					<meta http-equiv="refresh" content="0; url=http://localhost:8888/picShare/Dashboard/DashboardAction.php" /> 
	               <?php		
	               }
	               else {

	               	echo $result;



	               }	
	      }
	 }	



?>
	

