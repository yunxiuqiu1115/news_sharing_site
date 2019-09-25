<?php
session_start();
require 'database.php';

$yourid = $_SESSION["userid"];

$commentid = $_GET["commentid"];

$sid2 = $_SESSION['sid'];



$sql = "DELETE FROM comment where id_of_comment='$commentid'";

$result = $conn -> query($sql);
$conn -> close();

header("Location: display.php?storyid=".$sid2);
?>