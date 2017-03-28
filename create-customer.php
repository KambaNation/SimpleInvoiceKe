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

//db config
require 'includes/config.php';
require 'user_profile.php';


//functions
require 'includes/functions.php';
//page name
$mainpage = 'customers';
$page = 'add-customer';


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




                    //posting to DB
                    $sql= "INSERT INTO `sp_clients`(`id`, `client_names`,`client_desc`,`clients_email`,`clients_phone`,`postal_code`,`address`,`status`, `owner`,`date_created`) VALUES (NULL,'$customer_title','$customer_desc','$customer_email','$customer_number','$customer_postal','$customer_address','$customer_status','$user_id',NOW())";
                    // $sql= "INSERT INTO `sp_clients`(`id`, `client_number`, `client_names`, `client_desc`, `clients_email`, `clients_phone`, `postal_code`, `address`, `status`, `owner`, `date_created`) VALUES (NULL,[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11])";




                    if($connect->query($sql) === TRUE) {
                        echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            New customer created successfully <a href="customers.php">Back to customers</a>
                                        </div>';


                    } else {
                        echo '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Error while Adding New customer
                                        </div>';
                    }
                }

                ?>


                <form role="form" method="post" action="" enctype="multipart/form-data">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="Slide-title">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1" placeholder="Customer Title">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Slide-title">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" id="exampleInputEmail1" placeholder="+254700000000">
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
                            <label for="Slide-title">Postal Code</label>

                            <input class="form-control" type="text" name="postal_code" placeholder="00100"/>

                        </div>
                    </div>

                    <div class="col-lg-6">


                        <div class="form-group">
                            <label for="Slide-desc">Company Address</label>
                            <textarea name="address" class="form-control" ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Company Description</label>
                            <textarea rows="5" cols="5" class="form-control" name="comp_desc"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="Slide-desc">Status</label>
                            <select name="status" class="form-control">

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

