<?php
session_start();

$yourid = $_SESSION["userid"];

$commentid = $_GET["commentid"];




$conn = mysqli_connect("localhost","root","1047deqingsu","story");
if ($conn->connect_error){
        die("Connection failed:".$conn->connect_error);}

$sql = "DELETE FROM comment where id_of_comment='$commentid'";

$result = $conn -> query($sql);
$conn -> close();

echo"Succesfully deleted!";
?>

<form action="storyindex.php" method="POST">
        
        <button type="submit" name="back">BACK</button>
</form>