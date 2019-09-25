<?php
    session_start();
    require 'database.php';

    if (!empty($_POST['signup_username'])
    && !empty($_POST['first_name'])
    && !empty($_POST['last_name'])
    && !empty($_POST['signup_password'])
    && !empty($_POST['signup_password2'])) {

        $signup_username = htmlentities($_POST['signup_username']);
        $firstname = htmlentities($_POST['first_name']);
        $lastname = htmlentities($_POST['last_name']);
        $password1 = htmlentities($_POST['signup_password']);
        $password2 = htmlentities($_POST['signup_password2']);

        $stmt1 = $conn->prepare("SELECT COUNT(*) FROM users WHERE username=?");

        $stmt1->bind_param('s', $signup_username);
        $stmt1->execute();

        $stmt1->bind_result($cnt);
        $stmt1->fetch();
        $stmt1->close();

        if ($cnt == 1) {
            
            $_SESSION['error_signup'] = "The username you entered already exists!";
            header("Location: index.php");
            exit;

        } elseif ($password1 != $password2){
            
            $_SESSION['error_signup'] = "The passwords you entered don't match!";
            header("Location: index.php");
            exit;

        } else {

            $stmt2 = $conn->prepare("insert into users (username, first_name, last_name, password) values (?, ?, ?, ?)");
            if(!$stmt2) {
                printf("Query Prep Failed: %s\n", $conn->error);
                exit;
            }

            $password1 = password_hash($password1, PASSWORD_BCRYPT);

            $stmt2->bind_param('ssss', $signup_username, $firstname, $lastname, $password1);
            $stmt2->execute();
            $stmt2->close();

            $stmt3 = $conn->prepare("SELECT  id FROM users WHERE username=?");

            $stmt3->bind_param('s', $signup_username);
            $stmt3->execute();

            $stmt3->bind_result($user_id);
            $stmt3->fetch();

            
            $_SESSION['userid'] = $user_id;
            header("Location: storyindex.php");
            exit;
        }
    } else {
        
        $_SESSION['error_signup'] = "All fields are required!";
        header("Location: index.php");
        exit;

    }
?>
