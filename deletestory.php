<?php
session_start();
$yourid = $_SESSION["userid"];

$storyid = $_GET["storyid"];
$conn = mysqli_connect("localhost","root","1047deqingsu","story");
if ($conn->connect_error){
        die("Connection failed:".$conn->connect_error);}

$sql = "DELETE FROM story where id='$storyid'";

$result = $conn -> query($sql);
$conn -> close();

echo"Succesfully deleted!";
?>

<form action="storyindex.php" method="POST">
        
        <button type="submit" name="back">BACK</button>
</form>