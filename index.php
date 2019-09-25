<?php
    session_start();
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

    <div class="welcome">
        <h1>Welcome to the News Site!</h1>
    </div>
    
    <div class="connect">
        <!-- This form is used to get the username and password of an existing user
        and sends them to the login.php file -->
        <div id="login">
            <h1>Existing User</h1>
            <form action="login.php" method="POST">
                <p>
                    <label for="usernamelogin">Username</label> <br>
                    <input type="text" name="login_username" id="usernamelogin" maxlength="20"  placeholder="username" />
                </p>
                <p>
                    <label for="passwordlogin">Password</label> <br>
                    <input type="password" name="login_password" id="passwordlogin" maxlength="20" placeholder="password" />
                </p>
                <?php

                    //checks if there is an error from a previous log in or sign up process
                    //and prints the exact error if there is one
                    if (isset($_SESSION['error'])) {
                        $error = $_SESSION['error'];
                        echo "<p class='error'>$error</p>";
                    }
                ?>
                <p>
                    <input type="submit" value="Log in"/>
                </p>
            </form>
        </div>

        <!-- This form gets the username, first name, last name, the password and its verification for a new user
        and sends them to the signup.php file -->
        <div id="signup">
            <h1>New User</h1>
            <form action="signup.php" method="POST">
                <p>
                    <label for="usernamesignup">Username</label> <br>
                    <input type="text" name="signup_username" id="usernamesignup" maxlength="20" placeholder="username" />
                </p>
                <p>
                    <label for="firstname">First Name</label> <br>
                    <input type="text" name="first_name" id="firstname" maxlength="20" placeholder="first name" />
                </p>
                <p>
                    <label for="lastname">Last Name</label> <br>
                    <input type="text" name="last_name" id="lastname" maxlength="20" placeholder="last name" />
                </p>
                <p>
                    <label for="passwordsignup">Password</label> <br>
                    <input type="password" name="signup_password" id="passwordsignup" maxlength="20" placeholder="password" />
                </p>
                <p>
                    <label for="password2signup">Retype Password</label> <br>
                    <input type="password" name="signup_password2" id="password2signup" maxlength="20" placeholder="retype password" />
                </p>
                <?php

                    //checks if there is an error from a previous sign up or sign up process
                    //and prints the exact sign up error if there is one

                    if (isset($_SESSION['error_signup'])) {
                        $error = $_SESSION['error_signup'];
                        echo "<p class='error'>$error</p>";
                    }
                    if (isset($_POST['login_username'])){
                        $x = $_POST['login_username'];
                    echo $x;
                    echo "1000";
                    }
                    
                    //erases the error or disconnects the user if he is redirected to this page
                    session_destroy();
                ?>
                <p>
                    <input type="submit" value="Sign up"/>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
