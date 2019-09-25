<!-- This file displays the stry the user selectsed and gives the user the option to upload pictures and to add comments-->
<?php
        session_start();
        require 'database.php';
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        $yourid = $_SESSION['userid'];
        $sid = $_GET["storyid"];
        $_SESSION['idofstory'] = $sid;

        $stmt = $conn->prepare("SELECT users.first_name as first, users.last_name as last, title, link, content, id_of_creater from story join users on (id_of_creater = users.id)
        where story.id=?");

        $stmt->bind_param('i', $sid);
        $stmt->execute();

        $stmt->bind_result($first, $last, $title, $external_link, $content, $uid);
        $stmt->fetch();
        $stmt->close();
       

        echo'<!DOCTYPE html>';
        echo'<html lang="en">';
        echo'<head>';
        echo'    <meta charset="UTF-8">';
        echo'    <meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo'    <meta http-equiv="X-UA-Compatible" content="ie=edge">';
        echo'    <title>'.$title.'</title>';
        echo'    <link rel="stylesheet" type="text/css" href="home.css">';
        echo'</head>';
        echo'<body>';
        echo'    <div class="welcome">';

     
        echo "<h2><b>".$title."</b></h2><p> by ".$first." ".$last."<br><a href='$external_link'>".$external_link."</a>";
        if($uid == $yourid){
            echo"<br><a href='deletestory.php?storyid=".$sid."'>Delete</a>||<a href='editstory.php?storyid=".$sid."'>Edit</a></p>";
        }
        echo '<form action="storyindex.php" method="POST">';
        echo '<button type="submit" name="back">BACK</button>';
        echo '</form>';
        echo "</div>";
        echo '<div class="comments">';
        echo "<h2>Content</h2><p>".$content."</p><hr>";


       




             
        $stmt2 = $conn->prepare("SELECT users.id, users.first_name as first, users.last_name as last, comment, id_of_comment, date_posted from comment join users on (userid = users.id) where id_of_story=?");

        $stmt2->bind_param('i', $sid);
        $stmt2->execute();

        $stmt2->bind_result($id, $first, $last, $comment, $cid, $date);
        while($stmt2->fetch()){
            echo "<p><b>by ".$first." ".$last."</b> on ".$date."<br>".$comment;
        if($id == $yourid){
            $_SESSION['sid'] = $sid;
            echo"<br><a href='deletecomment.php?commentid=".$cid."'>Delete</a>||<a href='editcomment.php?commentid=".$cid."'>Edit</a>";
            
        }      
        echo "</p><hr>";
        }
        $stmt2->close();
           
    ?>




<!-- *************************This part is to show the images************************* -->
<table border="1" width="1000" align="center">
                        <tr>
                        <td>Picture</td>

                        </tr>
                        <?php

                                //change lines below to your require database.php blablabla
                                require 'database.php';
                                $sql = "SELECT * from pictures where storyid='$sid'";
                                $result = $conn -> query($sql);



                                if($result->num_rows>0){
                                    while($row = $result -> fetch_assoc()){


                                        $image = $row["paths"];

                                        echo"<tr>";
                                        echo "<td>";
                                        echo"<img src='$image' width='300' height='100'>";
                                        echo"</td>";

                                        echo"</tr>";
                                    }

                                }

                                $conn -> close();






                        ?>

    </table>
<!-- *************************This part is to show the images************************* -->

    <table border="1" width="500" align="center">
    <tr>
                        <th>Content</th>
                        </tr>

                        <?php
                        require 'database.php';
                        $sql = "SELECT content from story where id='$sid'";
                        $result = $conn -> query($sql);



                        if($result->num_rows>0){
                            while($row = $result -> fetch_assoc()){

                                echo "<tr>";



                                echo"<td>".$row["content"]."</td>";

                                echo"</tr>";
                            }

                        }

                        $conn -> close();

                        ?>
    </table>
<!-- *************************This part is to upload the images************************* -->
<?php
require 'database.php';

$sql = "SELECT users.id as id from users,story where story.id='$sid'and users.id=story.id_of_creater";

$result = $conn -> query($sql);



if($result->num_rows>0){
    while($row = $result -> fetch_assoc()){
        if($row["id"]==$yourid) //remember to change "2" in this line to "$yourid"
        {echo"<form action='upload.php' method='POST' enctype='multipart/form-data'>";
         echo"<input type='file' name='file'>";
         echo"<button type='submit' name='submit'>UPLOAD</button>";
         echo"</form>";
        }
    }}
    $conn -> close();

?>




    <div class = "insert_story">
    <form action='insertcomment.php' method='post'>
        <p>
            <label for="comment">Comment:</label> <br>
            <textarea id="comment" name="comment" cols="50" rows="10" placeholder="Please write your comment here!"></textarea> 
        </p>
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        <input type = "hidden" name="stid" value='<?php echo "$sid";?>'/>
        <p>
            <input type="submit" value="Post">
        </p>
    </form>
    
    </div>
    
    </div>

</body>
</html>