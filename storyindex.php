<!-- This file displays all the stories and gives the user the possibility to delete, edit and logout -->
<?php
    session_start();
    require 'database.php';
    $yourid = $_SESSION['userid'];
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News Site</title>
    <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
    <?php
        $stmt = $conn->prepare("SELECT first_name FROM users WHERE id=?");

        $stmt->bind_param('s', $yourid);
        $stmt->execute();

        $stmt->bind_result($first);
        $stmt->fetch();
        $stmt->close();
    ?>

    <div class="welcome">
        <h1>Welcome <?php echo $first; ?></h1>
        <form action="index.php" method="POST">
            <button type="submit" name="back">Logout</button>
        </form>
    </div>
    <div class = 'stories'>
        <form action='display.php' method='get'>
        <?php
            
            $sql = "SELECT users.first_name as first, users.last_name as last, story.id, id_of_creater, title, link from story join users on (id_of_creater = users.id)";
            $result = $conn -> query($sql);
            if($result){
                if($result->num_rows>0){
                    echo "<h1>List of the Stories</h1>";
                    while($row = $result -> fetch_assoc()){
                        $first = $row["first"];
                        $last = $row["last"];
                        $external_link = $row["link"];
                        $title = $row["title"];
                        $storyid = $row["id"];

                        echo "<h2><a href='display.php?storyid=".$storyid."'><b>".$title."</b></a></h2><p> by ".$first." ".$last."<br><a href='$external_link'>".$external_link."</a>";
                        if($row["id_of_creater"]==$yourid){
                            echo"<br><a href='deletestory.php?storyid=".$storyid."'>Delete</a>||<a href='editstory.php?storyid=".$storyid."'>Edit</a></p>";
                        }
                        echo "<hr>";
                    }
                }
            }
            $conn -> close();
        ?>
        </form>
        <div class = "insert_story">
        <form action='insert.php' method='post'>
            <p>
                <label for="title">Title:</label> <br>
                <input type="text" name="newtitle" id="title" placeholder="Title of Story" />
            </p>
            <p>
                <label for="link">Link:</label> <br>
                <input type="text" name="newlink" id="link" placeholder="External Link" />
            </p>
            <p>
                <label for="content">Content:</label> <br>
                <textarea name="newcontent" cols="50" rows="10" placeholder="Please write your story!"></textarea> 
            </p>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
            <p>
                <input type="submit" value="Post">
            </p>
        </form>
        </div>
    </div>

</body>
</html>