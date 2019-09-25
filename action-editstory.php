<?php
session_start();
$yourid = $_SESSION["userid"];

$title = $_POST["title"];
$link = $_POST["link"];
$content = $_POST["content"];
$storyid = $_POST['storyid'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
    die("Request forgery detected");
}



$conn = mysqli_connect("localhost","root","1047deqingsu","story");
if ($conn->connect_error){
    die("Connection failed:".$conn->connect_error);
}

$sql = "UPDATE story SET title='$title',link='$link',content='$content' where id='$storyid'";

$result = $conn -> query($sql);


$conn -> close();

header("Location:storyindex.php");

?>