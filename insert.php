<!-- This file gets the user inputs and creates a new story --> 
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


$sql = "INSERT INTO story(id_of_creater,title,link,content) VALUES('$yourid','$newtitle','$newlink','$newcontent')";


$result = $conn -> query($sql);


$conn -> close();


header("Location: storyindex.php");

?>