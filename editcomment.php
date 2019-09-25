
<form action="action-comment.php" method="post">

<?php
session_start();
$yourid = $_SESSION["userid"];

$commentid = $_GET["commentid"];

$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));

$conn = mysqli_connect("localhost","root","1047deqingsu","story");
if ($conn->connect_error){
        die("Connection failed:".$conn->connect_error);}

$sql = "SELECT * FROM comment where id_of_comment='$commentid'";


$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)) {
    $comment = $row['comment'];

 }




?>

<textarea name="comment" cols="50" rows="10">  
<?php echo "$comment";?>
    </textarea> 
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
<input type="hidden" name="commentid" value='<?php echo "$commentid";?>'>
<input type="submit" value="submit">

</form>


<form action="storyindex.php" method="POST">
        
        <button type="submit" name="back">BACK</button>
</form>