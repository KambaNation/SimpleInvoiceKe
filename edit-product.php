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
//product ID
$product_id = $_GET['id'];

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
          //picck Script
          $view_result =  $connect->query("SELECT * FROM product WHERE product_id ='$product_id'");

          // display records if there are records to display

          $view_row= $view_result->fetch_assoc();

          $product_name = $view_row['product_name'];
          $prod_desc= $view_row['product_desc'];
          $prod_brand= $view_row['brand_id'];
          $prod_cat= $view_row['categories_id'];
          $prod_status= $view_row['status'];
          $prod_price= $view_row['rate'];
          $prod_qty= $view_row['quantity'];
          $prod_img= $view_row['product_image'];
          $prod_serial= $view_row['serial_number'];
          //product brand
          $brand_query = $connect->query("SELECT * FROM brands WHERE brand_id='$prod_brand'");
          $brand_row = $brand_query->fetch_assoc();
          $brand_name = $brand_row['brand_name'];
          $brand_id = $brand_row['brand_id'];

          //categories
          $category_query = $connect->query("SELECT * FROM categories WHERE categories_id='$prod_cat'");
          $category_row = $category_query->fetch_assoc();
          $category_name = $category_row['categories_name'];
          $category_id = $category_row['categories_id'];
//SELECT `id`, `product_name`, `brand`, `serial_number`, `price`, `product_desc`, `product_image`, `status`, `date_created` FROM `sp_products` WHERE 1
          //script to update
          if (isset($_POST['update'])) {
              // get the form data

              $product_title = htmlentities($_POST['product_name'], ENT_QUOTES);
              $product_price = htmlentities($_POST['price'], ENT_QUOTES);

              $product_status = htmlentities($_POST['status'], ENT_QUOTES);
              $product_brand = htmlentities($_POST['brand'], ENT_QUOTES);

              $category =$_POST['category'];
              $product_qty =$_POST['quantity'];

$sql="UPDATE `product` SET `product_name`='$product_title',`brand_id`='$product_brand',`categories_id`='$category',`quantity`='$product_qty',`rate`='$product_price',`status`='$product_status' WHERE product_id='$product_id'";


              if( $connect->query($sql) === TRUE) {
                  echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                           Product Updated successfully <a href="products.php">Back To Product Listing</a>
                                        </div>';


              } else {
                  echo '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Error while Updating Product
                                        </div>';
              }
          }

          ?>


          <form role="form" method="post" action="" enctype="multipart/form-data">

              <div class="col-lg-12">
                  <div class="form-group">
                      <label for="Slide-title">Product Name</label>
                      <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="<?php echo $product_name ?>">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Price</label>
                      <input type="number" name="price" class="form-control" id="exampleInputEmail1" value="<?php echo $prod_price ?>">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Brand</label>
                      <select class="form-control" name="brand">

                          <option value="<?php echo $brand_id ?>" SELECTED><?php echo $brand_name ?></option>
                          <?php
                          $brands_query = $connect->query("SELECT * FROM brands ORDER BY brand_id ASC");
                          While($brands_row = $brands_query->fetch_assoc()){
                              $brands_name = $brands_row['brand_name'];
                              $brands_id = $brands_row['brand_id'];
                              ?>
                              <option value="<?php echo $brands_id ?>"><?php echo $brands_name?></option>

                          <?php
                          }

                          ?>
                      </select>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Category</label>
                      <select class="form-control" name="category">

                          <option value="<?php echo $category_id ?>" SELECTED><?php echo $category_name ?></option>
                          <?php
                          $cat_query = $connect->query("SELECT * FROM categories ORDER BY categories_id ASC");
                          While($cat_row = $cat_query->fetch_assoc()){
                              $cat_name = $cat_row['categories_name'];
                              $cat_id = $cat_row['categories_id'];
                              ?>
                              <option value="<?php echo $cat_id ?>"><?php echo $cat_name?></option>

                              <?php
                          }

                          ?>
                      </select>
                  </div>
              </div>

              <div class="col-lg-4 col-md-4">
                  <div class="form-group">
                      <label>product Quantity</label>
                      <input type="number"  class="form-control" name="quantity" value="<?php echo $prod_qty ?>" >
                  </div>
              </div>



              <div class="col-lg-4 col-md-4">
                  <div class="form-group">
                      <label for="Slide-desc">Status</label>
                      <select name="status" class="form-control">

                          <option value="<?php echo $prod_status ?>" selected><?php
                              if($prod_status==1){
                                  echo'Active';
                              }else{
                                  echo'InActive';
                              }

                              ?></option>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>

                      </select>
                  </div>
              </div>





              <div class="col-lg-12">
                  <button type="submit" name="update" class="btn btn-primary  btn-square pull-right">Update </button>
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

