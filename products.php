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
$page = 'products';


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
        <h6 class="panel-title">Products</h6>
          <a class="btn btn-primary pull-right" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal">Add Product</a>
      </div>
      <div class="panel-body">
          <div class="remove-messages"></div>
          <div class="table-responsive">
              <table class="table table-stripped table-bordered" id="manageProductTable">
                  <thead>
                  <tr>
                      <th><input type="checkbox"></th>
                      <th>Product Name</th>
                      <th>Rate</th>
                      <th>Quantity</th>
                      <th>Brand</th>
                      <th>Category</th>
                      <th>Status</th>
                      <th style="width:15%;">Options</th>
                  </tr>
                  </thead>
                  <tbody>

                      <?php
                      //select all from product where status = 1
                      $sql = "SELECT * FROM product WHERE status = 1";

                      $result = $connect->query($sql);
                     while($row_product = $result ->fetch_assoc()){
                         //product variables
                         $productId = $row_product['product_id'];
                         $product_image = $row_product['product_image'];
                         $product_name = $row_product['product_name'];
                         $product_cat = $row_product['categories_id'];
                         $product_brand= $row_product['brand_id'];
                         $product_rate = $row_product['rate'];
                         $product_quantity = $row_product['quantity'];
                         $product_status= $row_product['status'];
                         //brand name
                         $brand_sql = "SELECT * FROM `brands` WHERE brand_id='$product_brand'";
                         $brand_res =$connect->query($brand_sql);
                         $brand_row = $brand_res->fetch_assoc();

                         $brand_name = $brand_row['brand_name'];

                         //category
                         $category_sql = "SELECT * FROM `categories` WHERE categories_id='$product_cat'";
                         $category_res =$connect->query($category_sql);
                         $category_row = $category_res->fetch_assoc();

                         $category_name = $category_row['categories_name'];

                         ?>
                         <tr>
                         <td><input type="checkbox"></td>
                         <td><?php echo $product_name?></td>
                         <td><?php echo $product_rate?></td>
                         <td><?php echo $product_quantity?></td>
                         <td><?php echo $brand_name?></td>
                         <td><?php echo $category_name?></td>
                         <td>
                             <?php if($product_status==1){
                                 echo'<span class="label label-success">Active</span>';

                             }else{
                                 echo'<span class="label label-danger">suspended</span>';
                             } ?></td>
                         <td><div class="btn-group">
                                 <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Action <span class="caret"></span>
                                 </button>
                                 <ul class="dropdown-menu">
                                     <li><a href='edit-product?id=<?php echo $productId ?>' data-toggle="tooltip" title="Edit" data-placement="top" ><i class="fa fa-edit"></i> Edit</a></li>
                                     <li><a href='delete?id=<?php echo $productId ?>&type=products' data-toggle="tooltip" title="Delete" data-placement="top" onclick="return confirm('Are you sure you wish to move this record to trash?');" ><i class="fa fa-trash-o"></i> Remove</a></li>
                                 </ul>
                             </div></td>

                  </tr>

                    <?php }
                      ?>


                  </tbody>
              </table>
          </div>


      </div>
    </div>
      <!-- /default panel -->

      <!--footer-->
      <?php require 'includes/footer.php'; ?>
  </div>
        </div>

        <?php require 'includes/js.php';?>
        <!-- DataTables -->

        <script>
            //DataTables Initialization
            $(document).ready(function() {
                $('#example-table').dataTable();
            });
            $(document).ready(function() {
                $('#ongoing-table').dataTable();
            });
            $(document).ready(function() {
                $('#completed-table').dataTable();
            });

        </script>
    </body>
</html>