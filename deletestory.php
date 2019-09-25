<?php
session_start();
require 'database.php';
$yourid = $_SESSION["userid"];

$storyid = $_GET["storyid"];


$sql = "DELETE FROM story where id='$storyid'";

$result = $conn -> query($sql);
$conn -> close();

echo"Succesfully deleted!";
?>

<form action="storyindex.php" method="POST">
        
        <button type="submit" name="back">BACK</button>
</form>