<?php
    session_start();
    require 'database.php';


    //this if statement verifies that the user entered their username and password
    if (isset($_POST['login_username']) && isset($_POST['login_password'])) {

        // Use a prepared statement
        $stmt = $conn->prepare("SELECT COUNT(*), id, password FROM users WHERE username=?");

        // Bind the parameter
        $stmt->bind_param('s', $user);
        $user = htmlentities($_POST['login_username']);
        $stmt->execute();

        // Bind the results
        $stmt->bind_result($cnt, $user_id, $pwd_hash);
        $stmt->fetch();

        $password = htmlentities($_POST['login_password']);        

        // Compare the submitted password to the actual password hash

        if($cnt == 1 && password_verify($password, $pwd_hash)){
            // Login succeeded!
            $_SESSION['userid'] = $user_id;
            header("Location: storyindex.php");
            exit;
            // Redirect to your target page
        } else{
            $_SESSION['error'] = "Wrong Username and/or Password";
            header("Location: index.php");
            exit;
            // Login failed; redirect back to the login screen

        }
    } else {
        $_SESSION['error'] = "You didn't enter your username and/or password!";
        header("Location: index.php");
        exit;
    }
?>