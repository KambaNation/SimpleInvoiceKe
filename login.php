<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//session
error_reporting(0);
ob_start();
session_start();
//db config
require 'includes/config.php';

//functions
require 'includes/functions.php';
//page name
$page = '';

if(isset($_SESSION['id'])) {
    header('location: dashboard.php');
}
$errors = array();

if($_POST) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        if($username == "") {
            $errors[] = "Username is required";
        }

        if($password == "") {
            $errors[] = "Password is required";
        }
    } else {
        $sql = "SELECT * FROM sp_users WHERE username = '$username'";
        $result = $connect->query($sql);

        if($result->num_rows == 1) {
            $password = md5($password);
            // exists
            $mainSql = "SELECT * FROM sp_users WHERE username = '$username' AND password = '$password' AND status=1";
            $mainResult = $connect->query($mainSql);

            if($mainResult->num_rows == 1) {
                $value = $mainResult->fetch_assoc();
                $user_id = $value['id'];
                if ($value['role'] == 1) {
                    $_SESSION['login_user'] = $username;
                    $_SESSION['id'] = $user_id;
                    $_SESSION['user'] = "admin";
                    $today = date("F j, Y, g:i a");
                    $ip = $_SERVER['REMOTE_ADDR'];
                    // mysqli_query($connection,"INSERT INTO sp_history (user_id,last_login,ip_address) VALUES('$user_id','$today','$ip')");

                    header("location: dashboard.php");
                } else {
                    $_SESSION['login_user'] = $username;
                    $_SESSION['id'] = $user_id;
                    $_SESSION['user'] = "manager";

                    $today = date("F j, Y, g:i a");
                    $ip = $_SERVER['REMOTE_ADDR'];
                    //mysqli_query($connection,"INSERT INTO sp_history (user_id,last_login,ip_address) VALUES('$user_id','$today','$ip')");

                    header("location: dashboard.php");
                }
                // set session


                header('location: dashboard.php');
            } else{

                $errors[] = "Incorrect username/password combination";
            } // /else
        } else {
            $errors[] = "Username doesnot exists";
        } // /else
    } // /else not empty username // password

} // /if $_POST


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    //header
    require 'includes/header.php';
    //css
    require 'includes/css.php';

    ?>
</head>
<body class="full-width page-condensed">
<!-- Navbar -->
<div class="navbar navbar-inverse" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-right"><span class="sr-only">Toggle navbar</span><i class="icon-grid3"></i></button>
    </div>

</div>
<!-- /navbar -->
<!-- Login wrapper -->
<div class="login-wrapper">
    <div class="messages">
        <?php if($errors) {
            foreach ($errors as $key => $value) {
                echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';
            }
        } ?>
    </div>
    <div class="clearfix"></div>
    <br>
    <form action="" role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
        <div class="popup-header"><a href="#" class="pull-left"><i class="icon-user-plus"></i></a><span class="text-semibold">User Login</span>
            <div class="btn-group pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></a>

            </div>
        </div>
        <div class="well">
            <div class="form-group has-feedback">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Username" name="username" required  autocomplete="off">
                <i class="icon-users form-control-feedback"></i></div>
            <div class="form-group has-feedback">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password" required  autocomplete="off">
                <i class="icon-lock form-control-feedback"></i></div>
            <div class="row form-actions">
                <div class="col-xs-6">
                    <div class="checkbox checkbox-success">
                        <label> <a href="recover-password">Forgot password?</a></label>
                    </div>
                </div>
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-warning pull-right"><i class="icon-menu2"></i> Sign in</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- /login wrapper -->
<!-- Footer -->
<?php require 'includes/footer.php'; ?>
<!-- /footer -->
<script src="js/jquery.min.js"></script>
<?php require 'includes/js.php';?>
</body>

</html>

