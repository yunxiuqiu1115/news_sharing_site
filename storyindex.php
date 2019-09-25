<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>link</th>
        <th></th>
        <th></th>
</tr>

    
<form action='display.php' method='get'>
<?php
    session_start();
    $yourid = $_SESSION['userid'];
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));

$conn = mysqli_connect("localhost","root","1047deqingsu","story");
if ($conn->connect_error){
    die("Connection failed:".$conn->connect_error);
}
$sql = "SELECT id,id_of_creater,title,link from story";
$result = $conn -> query($sql);

if($result->num_rows>0){
    while($row = $result -> fetch_assoc()){
        $storyid = $row["id"];
        $external_link = $row["link"];

        
        
        echo "<tr><td>".$storyid."</td><td><a href='display.php?storyid=".$storyid."'>".$row["title"]."</a></td><td><a href='$external_link'>link</a></td>";
        if($row["id_of_creater"]==2){
        
            echo"<td><a href='deletestory.php?storyid=".$row["id"]."'>Delete</a></td>";
            echo"<td><a href='editstory.php?storyid=".$row["id"]."'>Edit</a></td>";
        }

    
    }
    echo "</table>";
}

$conn -> close();
?>
</form>
<br><br><br><br><br><br>
<form action='insert.php' method='post'>
    title:<input type="text" name="newtitle"><br><br>
    link:<input type="text" name="newlink"><br><br>
    content:<br>
    <textarea name="newcontent" cols="50" rows="10">  
    </textarea> 
    <br>
    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
    <input type="submit" value="post">
</form>

</body>
</html>