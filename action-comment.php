<?php
session_start();
$yourid = $_SESSION["userid"];
$commentid = $_POST["commentid"];
$comment = $_POST["comment"];
if(!hash_equals($_SESSION['token'], $_POST['token'])){
    die("Request forgery detected");
}

date_default_timezone_set('America/Chicago');
    
$date = date_create()->format('Y-m-d H:i:s');
$conn = mysqli_connect("localhost","root","1047deqingsu","story");
if ($conn->connect_error){
    die("Connection failed:".$conn->connect_error);
}

$sql = "UPDATE comment SET comment='$comment',date_posted='$date' where id_of_comment='$commentid'";

$result = $conn -> query($sql);


$conn -> close();

header("Location:storyindex.php");

?>