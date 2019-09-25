<?php
session_start();
require 'database.php';
$yourid = $_SESSION["userid"];

$title = $_POST["title"];
$link = $_POST["link"];
$content = $_POST["content"];
$storyid = $_POST['storyid'];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
    die("Request forgery detected");
}


$sql = "UPDATE story SET title='$title',link='$link',content='$content' where id='$storyid'";

$result = $conn -> query($sql);


$conn -> close();

header("Location:storyindex.php");

?>