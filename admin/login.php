<?php
require_once('../includes/config.php');


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div id="login">

    <?php

    if(!empty($_POST["remember"])) {
        setcookie ("username",$_POST["username"],time()+ 3600);
        setcookie ("password",$_POST["password"],time()+ 3600);
        echo "Cookies Set Successfuly";
    } else {
        setcookie("username","");
        setcookie("password","");
        echo "Cookies Not Set";
    }


    if(isset($_POST['submit'])){

        $stmt = $db->query('SELECT username, password, isAdmin FROM blog_members');



        $admin = false;
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        while($row = $stmt->fetch()){
            if($username == $row['username']){
                $admin = $row['isAdmin'];
            }
        }

        $_SESSION["username"] = $username;

        if($user->login($username,$password)){

            if($admin) {
                header('Location: index.php');
                exit;
            }else{
                header('Location: user.php');
                exit;
            }

        } else {
            $message = '<p class="error">Wrong username or password</p>';
        }

    }

    if(isset($message)){ echo $message; }
    ?>

	<form action="" method="post">
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100 p-t-50 p-b-90">
                    <form class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-51">
						Login
					</span>


                        <div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
                            <input class="input100" type="text" name="username" placeholder="Username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>">
                            <span class="focus-input100"></span>
                        </div>


                        <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
                            <input class="input100" type="password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
                            <span class="focus-input100"></span>
                        </div>


                        <div class="container-login100-form-btn m-t-17">
                            <p><input type="checkbox" name="remember" /> Remember me
                            </p>
                            <input type="submit" name="submit" value="Login" class="login100-form-btn" />
                        </div>

                    </form>
                </div>
            </div>
        </div>
	</form>


    <div id="dropDownSelect1"></div>


    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="vendor/animsition/js/animsition.min.js"></script>

    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="vendor/select2/select2.min.js"></script>

    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>

    <script src="vendor/countdowntime/countdowntime.js"></script>

    <script src="js/main.js"></script>

</div>
</body>
</html>
