<?php

    //where all the functions are
class Model { 

        var $link;

    //variables start with dollar sigh
        //echo is used to print
public function makeDBTables(){


    //connect to dataase
    $link = mysql_connect('localhost', 'root', 'root');
if (!$link) {
    die('Could not connect: ' . mysql_error());
            }
else{

    echo"Connected to Database!";
    echo"<br>";
    echo"<br>";
    }




echo"<br>";

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "$query";

$sql = 'CREATE DATABASE picShare';
if (mysql_query($sql, $link)) {
    echo "Database created successfully\n";
    echo"<br>";
                                }
 else {
    echo 'Cannot create database, Error Message: ' . mysql_error() . "\n";
    echo"<br>";
}


$conn = new mysqli('localhost', 'root', 'root','picShare');

//REGISTERED USERS:
$users="CREATE TABLE `table_Users`
(`userid` int NOT NULL auto_increment,
`email`text NOT NULL,
 `password` text NOT NULL,
 `firstName`text NOT NULL, 
 `lastName`text NOT NULL,
 `birthDay`text NOT NULL,
 `birthAddress`text NOT NULL, 
 `currentAddress` text NOT NULL,
 `levelofEdu`text NOT NULL,
 PRIMARY KEY(`userid`)
 )";

//checks if table is created successfully
 if ($conn->query($users)) {
    echo "User table created successful\n";
    echo "<br>";
} else {
    echo 'Error creating user table: ' . $conn->error ;
     echo "<br>";

}


//FRIENDS:
$friend="CREATE TABLE `friends`
( `userid` int NOT NULL auto_increment,
 `friendid`int NOT NULL,
 FOREIGN KEY(`userid`) REFERENCES table_Users(`userid`)
)";

//create tables, if exists don't create
//checks if table is created successfully
 if ($conn->query($friend)) {
    echo "Friend Table created successful\n";
    echo "<br>";
} else {
    echo 'Error creating friend table: ' . $conn->error ;
    echo "<br>";
}


//ALBUMS:
$albums="CREATE TABLE `albums`
(`albumid`int NOT NULL auto_increment, 
`userid` int NOT NULL,
 `name` text NOT NULL,
 `date` text NOT NULL,
 PRIMARY KEY(`albumid`),
  FOREIGN KEY(`userid`) REFERENCES table_Users(`userid`)

)";
 //FOREIGN KEY(`userid`) REFERENCES table_Users(`userid`)

//create tables, if exists don't create
//checks if table is created successfully
 if ($conn->query($albums)) {
    echo "Album Table created successful\n";
    echo "<br>";
} else {
    echo 'Error creating album table: ' . $conn->error ;
    echo "<br>";
}


//PHOTOS:

$photo="CREATE TABLE `photo`
(`photoid`int NOT NULL auto_increment, 
`albumid` int NOT NULL,
 `caption` text NOT NULL,
 `binary` int NOT NULL,
 PRIMARY KEY(`photoid`),
 FOREIGN KEY(`albumid`) REFERENCES albums(`albumid`)
)";

//create tables, if exists don't create
//checks if table is created successfully
 if ($conn->query($photo)) {
    echo "Photo Table created successful\n";
    echo "<br>";
} else {
    echo 'Error creating photo table: ' . $conn->error ;
    echo "<br>";
}




//TAGS:
$tags="CREATE TABLE `tag`
( `photoid` int NOT NULL,
 `tags` text NOT NULL
)";

//create tables, if exists don't create
//checks if table is created successfully
 if ($conn->query($tags)) {
    echo "Tags Table created successful\n";
    echo "<br>";
} else {
    echo 'Error creating tag table: ' . $conn->error ;
    echo "<br>";
}

//COMMENTS:

$comments="CREATE TABLE `comment`
( `userid` int NOT NULL,
 `photoid`int NOT NULL,
 `text` text NOT NULL,
 `date` text NOT NULL
)";

//create tables, if exists don't create
//checks if table is created successfully
 if ($conn->query($comments)) {
    echo "Comment Table created successful\n";
    echo "<br>";
} else {
    echo 'Error creating comment table: ' . $conn->error ;
    echo "<br>";
}

//LIKES:

$likes="CREATE TABLE `likes`
( `userid` int NOT NULL,
 `photoid`int NOT NULL
)";

//create tables, if exists don't create
//checks if table is created successfully
 if ($conn->query($likes)) {
    echo "Like Table created successful\n";
    echo "<br>";
} else {
    echo 'Error creating like table: ' . $conn->error ;
    echo "<br>";
}




}


}




    $model=new Model();

    
    echo "$return";
    //makes new line
    echo "<br>";

    $model->makeDBTables();

    ?>