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

//brand ID
$brand_id = $_GET['id'];



//db config
require 'includes/config.php';
require 'user_profile.php';


//functions
require 'includes/functions.php';
//page name
$mainpage = 'catalog';
$page = 'add-product';

//brand
$view_result = $connect->query("SELECT * FROM brands WHERE brand_id ='$brand_id'");

// display records if there are records to display

$view_row=$view_result->fetch_assoc();

$brand_name = $view_row['brand_name'];
$brand_status = $view_row['brand_status'];


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

                    $brand_name = htmlentities($_POST['brand_name'], ENT_QUOTES);
                    $brand_status = htmlentities($_POST['status'], ENT_QUOTES);


                    $sql="UPDATE `brands` SET `brand_name`='$brand_name',`brand_status`='$brand_status' WHERE brand_id='$brand_id'";

                    if($connect->query( $sql) === TRUE) {
                        echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Updated successfully <a href="brands.php"> Back to Brands</a>
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

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Slide-title">brand Name</label>
                            <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" value="<?php echo  $brand_name?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Slide-title">brand Status</label>
                            <select name="status" class="form-control">
                                <option selected value="<?php echo $brand_status ?>"><?php
                                    if($brand_status==1){
                                        ?>
                                    Active
                                    <?php
                                    }else{
                                        ?>
                                    Inactive
                                    <?php
                                    }?></option>

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

