<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//session
session_start();
if(!isset($_SESSION['login_user']))
{
    header("Location: index");
}
$login_session=$_SESSION['login_user'];
$user_id = $_SESSION['id'];

//get id

$users_id =$_GET['id'];

//db config
require 'includes/config.php';
require 'user_profile.php';


//functions
require 'includes/functions.php';
//page name
$mainpage = 'users';
$page = 'add-user';

//user info
$view_result =  $connect->query("SELECT * FROM sp_users WHERE id ='$users_id'");

// display records if there are records to display

$view_row=mysqli_fetch_array($view_result);

$first_name = $view_row['fname'];
$last_name = $view_row['lname'];
$user_name = $view_row['username'];
$user_mobile = $view_row['phone_no'];
$user_email_add = $view_row['email'];
$user_roles = $view_row['role'];
$user_task = $view_row['user_desc'];
$user_state = $view_row['status'];


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
<body class="sidebar-wide">
<!--navigation-->
<?php
//top navigation
require 'includes/top-menu.php';

?>
<!-- Page container -->
<div class="page-container">
    <!-- side bar-->
    <?php require 'includes/side-menu.php'; ?>
    <!--ennd of side bar-->
    <!-- Page content -->
    <div class="page-content">
        <!-- Page header -->
        <?php require 'includes/breadcrumb.php'; ?>
        <!-- end Page header-->
        <!-- Default panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title">Default panel</h6>
            </div>
            <div class="panel-body">

                <?php

                //script to save
                if (isset($_POST['save'])) {
                    // get the form data

                    $fname = htmlentities($_POST['f_name'], ENT_QUOTES);
                    $lname= htmlentities($_POST['l_name'], ENT_QUOTES);
                    $user_number = htmlentities($_POST['phone_number'], ENT_QUOTES);
                    $user_email = htmlentities($_POST['email_add'], ENT_QUOTES);

                    $user_desc = htmlentities($_POST['user_desc'], ENT_QUOTES);
                    $user_status = htmlentities($_POST['status'], ENT_QUOTES);
                    $user_role = htmlentities($_POST['role'], ENT_QUOTES);
                    //generated automatic
                    $username = strtolower($fname).".".strtolower($lname);
                    $password = md5($user_number);

                    //sql
                    $sql="UPDATE `sp_users` SET `username`='$username',`fname`='$fname',`lname`='$lname',`email`='$user_email',`phone_no`='$user_number',`role`='$user_role',`status`='$user_status',`date_created`=NOW() WHERE id='$users_id'";

                    //email


                    $to = $_POST['email_add'];
                    $from = 'info@kanadsytemsltd.com';
                    $headers = "From:" . strip_tags($from) . "\r\n";
                    $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
                    //$headers = "From: Simpay Kenya <$email>";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                    $subject = 'Your Kanad invoice Account Has been created updated';
                    $message = 'Hello';
                    $message .=$fname;
                    $message .=',<br> Your Username for Kanad invoice system is<br>';
                    $message .='Username :';
                    $message .=$fname.".".$lname;
                    $message .='<br>Password :';
                    $message .=$user_number;
                    $message .='<br> Please do not Share';

                    mail($to, $subject, $message, $headers);

                    if( $connect->query($sql) === TRUE) {


                        echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Updated successfully
                                        </div>';


                    } else {
                        echo '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Error while updating
                                        </div>';
                    }
                }

                ?>


                <form role="form" method="post" action="" enctype="multipart/form-data">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Slide-title">First Name</label>
                            <input type="text" name="f_name" class="form-control" id="exampleInputEmail1" value="<?php echo $first_name?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Slide-title">Lats Name</label>
                            <input type="text" name="l_name" class="form-control" id="exampleInputEmail1" value="<?php echo $last_name?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Slide-title">Phone Number</label>
                            <input type="tel" name="phone_number" class="form-control" id="exampleInputEmail1" value="<?php echo $user_mobile?>">
                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="form-group">
                            <label for="Slide-title">Email Address</label>

                            <input class="form-control" type="email" name="email_add" value="<?php echo $user_email_add?>"/>

                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="form-group">
                            <label for="Slide-title">Privilege / Role</label>

                            <select class="form-control" name="role">
                                <option value="<?php echo $user_roles ?>">
                                    <?php
                                    if($user_roles==1){
                                        ?>
                                        Super Admin

                                    <?php
                                    }else if($user_roles==2){
                                        ?>
                                            Project Manager
                                    <?php
                                    }else{
                                        ?>
                                        User
                                    <?php
                                    }
                                    ?>

                                </option>

                                <option disabled>Select Role</option>
                                <option value="3">User</option>
                                <option value="2">Project Manager</option>
                                <option value="1">Super Admin</option>
                            </select>

                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Employee Role</label>
                            <textarea rows="5" cols="5" class="form-control" name="user_desc"><?php echo $user_task ?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="Slide-desc">Status</label>
                            <select name="status" class="form-control">
                                <option value="<?php echo $user_state ?>" selected>
                                    <?php
                                    if($user_state==1){
                                        ?>
                                        Active
                                    <?php
                                    }else{
                                        ?>
                                        Inactive
                                    <?php
                                    }
                                    ?>
                                </option>
                                <option disabled>Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>

                            </select>
                        </div>
                    </div>




                    <div class="col-lg-12">
                        <button type="submit" name="save" class="btn btn-primary  btn-square pull-right">Submit</button>
                    </div>
                </form>


            </div>
        </div>
        <!-- /default panel -->

        <!--footer-->
        <?php require 'includes/footer.php'; ?>
    </div>
</div>

<!-- end Page container -->
<!--JS-->
<script src="js/jquery.min.js"></script>
<?php require 'includes/js.php';?>
</body>
</html>

