
<form action="action-editstory.php" method="post">

<?php
session_start();
require 'database.php';
$yourid = $_SESSION["userid"];
$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
$storyid = $_GET["storyid"];


$sql = "SELECT * FROM story where id='$storyid'";


$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)) {
    $title = $row['title'];
    $link = $row['link'];
    $content = $row['content'];

 }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Story</title>
    <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
        <div class="insert_story">
                <label>Title: </label><input type="text" name="title" value='<?php echo "$title";?>'><br><br>
                <label>Link: </label><input type="text" name="link" value='<?php echo "$link";?>'><br><br>
                <label>Content: </label><br>

                <textarea name="content" cols="50" rows="10"><?php echo "$content";?></textarea> 

                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                <input type="hidden" name="storyid" value='<?php echo "$storyid";?>'>
                <br><br>
                <input type="submit" value="submit">

                </form>
                <br><br>

                <form action="display.php?storyid="<?php echo $storyid; ?> method="POST">
                        
                        <button type="submit" name="back">BACK</button>
                </form>
        </div>
</body>
</html>