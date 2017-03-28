<?php

/* 
 * To change this license header, choose License Headers in customerect Properties.
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
//cutomer id
$cust_id = $_GET['id'];
//db config
require 'includes/config.php';
require 'user_profile.php';


//functions
   require 'includes/functions.php';
//page name
$mainpage = 'customers';
   $page = 'add-customer';

   //cutomer details
//brand
$view_result = $connect->query("SELECT * FROM sp_clients WHERE id ='$cust_id'");

// display records if there are records to display

$view_row=$view_result->fetch_assoc();
$cust_name = $view_row['client_names'];
$cust_desc= $view_row['client_desc'];
$cust_email= $view_row['clients_email'];
$cust_phone= $view_row['clients_phone'];
$cust_postal= $view_row['postal_code'];
$cust_address= $view_row['address'];
$cust_status= $view_row['status'];


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
        <h6 class="panel-title">Add Customer</h6>
      </div>
      <div class="panel-body">
          <!--content here -->
          <?php
          //script to save
          if (isset($_POST['save'])) {
              // get the form data

              $customer_title = htmlentities($_POST['customer_name'], ENT_QUOTES);
              $customer_number = htmlentities($_POST['phone_number'], ENT_QUOTES);
              $customer_email = htmlentities($_POST['email_add'], ENT_QUOTES);
              $customer_postal = htmlentities($_POST['postal_code'], ENT_QUOTES);
              $customer_desc = htmlentities($_POST['comp_desc'], ENT_QUOTES);
              $customer_status = htmlentities($_POST['status'], ENT_QUOTES);
              $customer_address = htmlentities($_POST['address'], ENT_QUOTES);
              //$customer_logo = $_POST['company_logo'];
              //Images
              //new code to upload image 1

 $sql="UPDATE `sp_clients` SET `client_names`='$customer_title',`client_desc`='$customer_desc',`clients_email`='$customer_email',`clients_phone`='$customer_number',`postal_code`='$customer_postal',`address`='$customer_address',`status`='$customer_status',`date_created`=NOW() WHERE id='$cust_id'";


              if($connect->query( $sql) === TRUE) {
                  echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                           Updated successfully
                                        </div>';


              } else {
                  echo '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Error while Updating
                                        </div>';
              }
          }

          ?>


          <form role="form" method="post" action="" enctype="multipart/form-data">

              <div class="col-lg-12">
                  <div class="form-group">
                      <label for="Slide-title">Customer Name</label>
                      <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1" value="<?php echo $cust_name?>">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Phone Number</label>
                      <input type="text" name="phone_number" class="form-control" id="exampleInputEmail1" value="<?php echo $cust_phone?>">
                  </div>
              </div>
              <div class="col-lg-4">

                  <div class="form-group">
                      <label for="Slide-title">Email Address</label>

                          <input class="form-control" type="email" name="email_add" value="<?php echo $cust_email?>"/>

                  </div>
              </div>
              <div class="col-lg-4">

                  <div class="form-group">
                      <label for="Slide-title">Postal Code</label>

                          <input class="form-control" type="text" name="postal_code"  value="<?php echo $cust_postal?>"/>

                  </div>
              </div>

              <div class="col-lg-6">


                  <div class="form-group">
                      <label for="Slide-desc">Company Address</label>
                      <textarea name="address" class="form-control" ><?php echo  $cust_address?></textarea>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label>Company Description</label>
                      <textarea rows="5" cols="5" class="form-control" name="comp_desc"><?php echo $cust_desc ?></textarea>
                  </div>
              </div>

              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label for="Slide-desc">Status</label>
                      <select name="status" class="form-control">
                          <option selected value="<?php echo $cust_status?>">
                          <?php
                          if($cust_status==1){
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

