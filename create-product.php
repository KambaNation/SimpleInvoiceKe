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
$mainpage = 'catalog';
$page = 'add-product';


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

              $product_title = htmlentities($_POST['product_name'], ENT_QUOTES);
              $product_price = htmlentities($_POST['price'], ENT_QUOTES);
              $product_desc = htmlentities($_POST['product_desc'], ENT_QUOTES);
              $product_status = htmlentities($_POST['status'], ENT_QUOTES);
              $product_brand = htmlentities($_POST['brand'], ENT_QUOTES);
              //select from product last id
              $last_id_query ="SELECT * from sp_products ORDER BY id DESC LIMIT 0,1";
              $last_id_res    = mysqli_query($connection,$last_id_query);
              $last_id_row = mysqli_fetch_array($last_id_res);
              $last_id = $last_id_row['id'];

              $serial ='KSL-'.$last_id;
              //$product_logo = $_POST['product_image'];
              //Images
              //new code to upload image 1


              $sql= "INSERT INTO `sp_products`(`id`, `product_name`, `brand`, `serial_number`, `price`, `product_desc`, `status`, `date_created`)"
                  ." VALUES (NULL,'$product_title','$product_brand','$serial','$product_price','$product_desc','$product_status',NOW())";



              if(mysqli_query($connection, $sql) === TRUE) {
                  echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            New Product created successfully
                                        </div>';


              } else {
                  echo '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Error while Adding New Product
                                        </div>';
              }
          }

          ?>


          <form role="form" method="post" action="" enctype="multipart/form-data">

              <div class="col-lg-12">
                  <div class="form-group">
                      <label for="Slide-title">Product/ service Name</label>
                      <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Service / Product Name" required>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                      <label for="Slide-title">Price</label>
                      <input type="text" name="price" class="form-control" id="exampleInputEmail1" placeholder="1000">
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                      <label for="Slide-title">Brand / Service</label>
                      <select class="form-control" name="brand" required>
                          <option disabled selected>Select Brand / Services</option>
                          <option value="0">Service</option>
                          <optgroup label="brands">
                              <?php
                              //select from brand table
                              $brand_query  = "select * from sp_brands WHERE status =1 ORDER BY id ASC";
                              $brand_res    = mysqli_query($connection,$brand_query);
                              $brand_count  =   mysqli_num_rows($brand_res);

                              if (mysqli_num_rows($brand_res) > 0) {

                                  while ($brand_row = mysqli_fetch_array($brand_res)) {

                                      $brand_names = $brand_row['brand_name'];
                                      $brand_status = $brand_row['status'];

                                      $brand_id = $brand_row['id'];
                                      ?>
                                      <option value="<?php echo $brand_id ?>"><?php echo $brand_names; ?></option>
                                      <?php
                                  }
                              } else {
                                  echo 'No Records';
                              }
                              ?>
                          </optgroup>


                      </select>
                  </div>
              </div>




              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label>product Description</label>
                      <textarea rows="5" cols="5" class="form-control" name="product_desc"></textarea>
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

