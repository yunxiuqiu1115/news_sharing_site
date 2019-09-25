<?php
    
    session_start();
    require 'database.php';
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
    
    $id = $_SESSION['userid'];
    $newcomment = $_POST['comment'];
    $sid2 = $_POST['stid'];
    date_default_timezone_set('America/Chicago');
    
    $date = date_create()->format('Y-m-d H:i:s');


    $sql = "INSERT INTO comment(userid,id_of_story,comment,date_posted) VALUES('$id','$sid2','$newcomment','$date')";


    $result = $conn -> query($sql);


    $conn -> close();

    echo"Successfully posted!";
    ?>


<form action="storyindex.php" method="POST">
        
        <button type="submit" name="goback">BACK</button>
</form>