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

//db config
require 'includes/config.php';
require 'user_profile.php';


//functions
     require 'includes/functions.php';
//page name
$mainpage = 'users';
$page = 'add-user';


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


              //posting to DB
             $sql= "INSERT INTO `sp_users`(`id`, `username`, `fname`, `lname`, `email`, `phone_no`, `password`, `role`, `status`, `date_created`) VALUES (NULL,'$username','$fname','$lname','$user_email','$user_number','$password','$user_role','$user_status',NOW())";

                //email


              $to = $_POST['email_add'];
              $from = 'info@kanadsytemsltd.com';
              $headers = "From:" . strip_tags($from) . "\r\n";
              $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
              //$headers = "From: Simpay Kenya <$email>";
              $headers .= "MIME-Version: 1.0\r\n";
              $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
              $subject = 'Your Kanad invoice Account Has been created Successfully';
              $message = 'Hello';
              $message .=$fname;
              $message .=',<br> Your Username for Kanad invoice system is<br>';
              $message .='Username :';
              $message .=$fname.".".$lname;
              $message .='<br>Password :';
              $message .=$user_number;
              $message .='<br> Please do not Share';

              mail($to, $subject, $message, $headers);

              if($connect->query($sql) === TRUE) {


                  echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                             created successfully <a href="users.php">Back to users</a>
                                        </div>';


              } else {
                  echo '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Error while Creating
                                        </div>';
              }
          }

          ?>


          <form role="form" method="post" action="" enctype="multipart/form-data">

              <div class="col-lg-6">
                  <div class="form-group">
                      <label for="Slide-title">First Name</label>
                      <input type="text" name="f_name" class="form-control" id="exampleInputEmail1" placeholder="First Name">
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                      <label for="Slide-title">Lats Name</label>
                      <input type="text" name="l_name" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Phone Number</label>
                      <input type="tel" name="phone_number" class="form-control" id="exampleInputEmail1" placeholder="+254700000000">
                  </div>
              </div>
              <div class="col-lg-4">

                  <div class="form-group">
                      <label for="Slide-title">Email Address</label>

                      <input class="form-control" type="email" name="email_add" placeholder="email@domain.com"/>

                  </div>
              </div>
              <div class="col-lg-4">

                  <div class="form-group">
                      <label for="Slide-title">Privilege / Role</label>

                      <select class="form-control" name="role">
                          <option value="">Select Role</option>
						  <option value="3">User</option>
                          <option value="2">Project Manager</option>
                          <option value="1">Super Admin</option>
                      </select>

                  </div>
              </div>




              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label for="Slide-desc">Status</label>
                      <select name="status" class="form-control">
                          <option value="">Select Status</option>
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

