<?php
    session_start();
    require 'database.php';
    //initializing the variables
    $signup_username = $password1 = $password2 = $error = $username = "";

    //this if statement verifies that the new user entered their username, password and the verification of the password
    if (isset($_POST['signup_username']) && isset($_POST['signup_password']) && isset($_POST['signup_password2'])) {


        //the following block checks if the new username already exists in the usernames file
        //the variable userexists_isnew is true if the username has not been used before
        $signup_username = htmlentities($_POST['signup_username']);
        $username_isnew = true;
        $stmt = $mysqli->prepare("select username from users");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }

        $stmt->execute();

        $stmt->bind_result($username);
        while($stmt->fetch()){
            if (htmlspecialchars($username) == $signup_username) {
                $username_isnew = false;
                break;
            }
        }
        $stmt->close();

        //the following block checks if the password matches with its verification
        //the variable passwords_are_equal is true if the passwords match
        $password1 = htmlentities($_POST['signup_password']);
        $password2 = htmlentities($_POST['signup_password2']);
        $passwords_are_equal = false;
        if ($password1 == $password2){
            $passwords_are_equal = true;
        }
    }

    //the following if statements record the type of error that happened to inform the user in case there was a mistake
    //if there was no error, the else block register the new user in the usernames and passwords file
    //and assigns the username and password to 2 session variables
    if ($signup_username == "") {
        $error = "You didn't enter your username.";
    } elseif ($password1 == "") {
        $error = "You didn't enter your password."; 
    } elseif ($password2 == "") {
        $error = "You didn't verify your password."; 
    } elseif ($username_isnew == false) {
        $error = "The username you entered already exists!";
    } /*elseif (!preg_match('/^[\w_\-]+$/', $signup_username)) {
        $error = "Invalid username! Don't use special characters.";
    }*/ elseif ($passwords_are_equal == false) {
        $error = "The passwords didn't match";
    } else {

        $stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }

        $password1 = password_hash($password1, PASSWORD_BCRYPT);

        $stmt->bind_param('ss', $signup_username, $password1);

        $stmt->execute();

        $stmt->close();

        $_SESSION['user'] = $signup_username;

    }

    //This if statement takes the user to the Dashboard if there was no error
    //and takes him back to the sign up page if there was one and prints the error for them
    if ($error == "" && isset($_SESSION['user'])) {
        header("Location: news.php");
        exit;
    } else {
        $_SESSION['error_signup'] = $error;
        header("Location: index.php");
        exit;
    }
?>
