
<form action="action-editstory.php" method="post">

<?php
session_start();
$yourid = $_SESSION["userid"];
$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
$storyid = $_GET["storyid"];
$conn = mysqli_connect("localhost","root","1047deqingsu","story");
if ($conn->connect_error){
        die("Connection failed:".$conn->connect_error);}

$sql = "SELECT * FROM story where id='$storyid'";


$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)) {
    $title = $row['title'];
    $link = $row['link'];
    $content = $row['content'];

 }




?>

<label>Title: </label><input type="text" name="title" value='<?php echo "$title";?>'><br><br>
<label>Link: </label><input type="text" name="link" value='<?php echo "$link";?>'><br><br>
<label>Content: </label><br>

<textarea name="content" cols="50" rows="10">
<?php echo "$content";?>  
</textarea> 

<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
<input type="hidden" name="storyid" value='<?php echo "$storyid";?>'>
<input type="submit" value="submit">

</form>


<form action="storyindex.php" method="POST">
        
        <button type="submit" name="back">BACK</button>
</form>