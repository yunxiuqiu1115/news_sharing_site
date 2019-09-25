
<!-- This file uploads a picture to the story -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        

        

<?php
session_start();
$yourid = $_SESSION["userid"];
$sid = $_SESSION["idofstory"];
$path = "pictures/"; //substitute by your path, create a new directory to store the pictures and gained path
$path2 = "pictures/";
    $file = $_FILES['file'];

    move_uploaded_file($file['tmp_name'],$path.$file['name']);

    $paths = $path.$file['name'];

    require 'database.php';

                        $sql = "DELETE from pictures where storyid='$sid'";
                        //when we upload a new picture, the previous ones will be deleted so we can achieve the overwrite function
                        //of pictures.
                        /* so you need to create a table pictures with two columns: storyid and paths to store pics*/
                        
                        $result = $conn -> query($sql);
                        $sql2 = "INSERT INTO pictures(storyid,paths) VALUES('$sid','$paths')";
                        //we insert the new path of pictures into our 

                        $result = $conn -> query($sql2);

                        $conn -> close();


header("Location:storyindex.php");
?>



</body>
</html>