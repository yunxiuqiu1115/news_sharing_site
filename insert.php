<!-- session of userid should be add here to substitute the values --> 
<?php
session_start();
require 'database.php';
$yourid = $_SESSION['userid'];
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}


$newtitle = $_POST['newtitle'];
$newlink = $_POST['newlink'];
$newcontent = $_POST['newcontent'];


$sql = "INSERT INTO story(id_of_creater,title,link,content) VALUES('2','$newtitle','$newlink','$newcontent')";


$result = $conn -> query($sql);


$conn -> close();

echo"Successfully posted!"



?>

<form action="storyindex.php" method="POST">
        
        <button type="submit" name="goback">BACK</button>
</form>