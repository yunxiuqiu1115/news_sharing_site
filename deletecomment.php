<?php
session_start();
require 'database.php';

$yourid = $_SESSION["userid"];

$commentid = $_GET["commentid"];





$sql = "DELETE FROM comment where id_of_comment='$commentid'";

$result = $conn -> query($sql);
$conn -> close();

echo"Succesfully deleted!";
?>

<form action="storyindex.php" method="POST">
        
        <button type="submit" name="back">BACK</button>
</form>