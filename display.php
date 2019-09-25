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
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        $yourid = $_SESSION['userid'];
        $sid = $_GET["storyid"];
        $_SESSION['idofstory']=$sid;

        

    ?>

    <table border="1" width="500" align="center">
                    
                        <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Id of creater</th>

                        </tr>
                        <?php
                        $conn = mysqli_connect("localhost","root","1047deqingsu","story");
                        if ($conn->connect_error){
                        die("Connection failed:".$conn->connect_error);
                        }
                        $sql = "SELECT id,title,id_of_creater from story where id='$sid'";
                        $result = $conn -> query($sql);
                
                        
                
                        if($result->num_rows>0){
                            while($row = $result -> fetch_assoc()){
                                
                                echo "<tr>";
                                
                                echo"<td>".$row["id"]."</td>";
                                
                                echo"<td>".$row["title"]."</td>";
                                
                                echo"<td>".$row["id_of_creater"]."</td>";
                                echo"</tr>";
                            }
                            
                        }
                        
                        $conn -> close();

                        ?>
        
                    
    </table>
    <br><br><br><br>
    <table border="1" width="500" align="center">
    <tr>
                        <th>Content</th>
                        </tr>

                        <?php
                        $conn = mysqli_connect("localhost","root","1047deqingsu","story");
                        if ($conn->connect_error){
                        die("Connection failed:".$conn->connect_error);
                        }
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
    

    <table border="1" width="1000" align="center">
                        <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th></th>
                        <th></th>
                        </tr>

                        <?php
                        $conn = mysqli_connect("localhost","root","1047deqingsu","story");
                        if ($conn->connect_error){
                        die("Connection failed:".$conn->connect_error);
                        }

                        $sql = "SELECT distinct user.username,user.userid,id_of_story,comment,id_of_comment,date_posted from user,story,comment 
                        where comment.id_of_story='$sid' and user.userid = comment.userid";

                        $result = $conn -> query($sql);
                
                        
                
                        if($result->num_rows>0){
                            while($row = $result -> fetch_assoc()){
                                
                                echo "<tr>";

                                echo"<td>".$row["id_of_comment"]."</td>";
                                
                                echo"<td>".$row["username"]."</td>";
                                
                                echo"<td>".$row["comment"]."</td>";

                                echo"<td>".$row["date_posted"]."</td>";

                                if($row["userid"]==2){
                                    echo"<td><a href='deletecomment.php?commentid=".$row["id_of_comment"]."'>Delete</a></td>";
                                    echo"<td><a href='editcomment.php?commentid=".$row["id_of_comment"]."'>Edit</a></td>";
                                }
                                
                                echo"</tr>";
                            }
                            
                        }
                        
                        $conn -> close();
                        
                        ?>
    </table>


    <form action='insertcomment.php' method='post'>
    content:<br>
    <textarea name="comment" cols="50" rows="10">  
    </textarea> 
    <br>
    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
    <input type = "hidden" name="stid", value='<?php echo "$sid";?>'/>
    <input type="submit" value="post">
    
</form>

<br><br><br><br><br><br>

<form action="storyindex.php" method="POST">
        
        <button type="submit" name="back">BACK</button>
</form>

    

</body>
</html>