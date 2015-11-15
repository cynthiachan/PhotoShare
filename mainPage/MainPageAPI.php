<?php

class mainPageAPI {


	 public function displayALLPhotos($column){

        $array = array();
        $counter = 0;

         $link = mysql_connect('localhost','root','root');
     $conn = new mysqli('localhost', 'root', 'root','picShare');
       $query = "SELECT * FROM photo ";
       $result = $conn->query($query);

       for ($row =$result->fetch_assoc(); $row !=FALSE; $row = $result->fetch_assoc()){

        
        $array[$counter] = stripslashes($row[$column]);
        $counter++;



       }
       $index = count($array);

       return $array;



    }
	
}

?>