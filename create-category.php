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

              $category_name = htmlentities($_POST['category_name'], ENT_QUOTES);
              $category_status = htmlentities($_POST['status'], ENT_QUOTES);

              //
              $category_query =$connect->query("SELECT categories_name FROM categories WHERE categories_name='$category_name'");
              $category_result = $category_query -> fetch_assoc();
              $category_count = $category_query->num_rows;

                //check duplicate
              if($brand_count==1){
                  echo '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Alraedy Exists please Rename
                                        </div>';
              }else{
              $sql= "INSERT INTO `categories`(`categories_id`, `categories_name`, `categories_status`)"
                  ." VALUES (NULL,'$category_name','$category_status')";



              if($connect->query( $sql) === TRUE) {
                  echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          Created successfully <a href="category.php">Back to Categories</a>
                                        </div>';


              } else {
                  echo '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Error while Adding New Product
                                        </div>';
              }
          }
          }

          ?>


          <form role="form" method="post" action="" enctype="multipart/form-data">

              <div class="col-lg-6">
                  <div class="form-group">
                      <label for="Slide-title">Category Name</label>
                      <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Category Name" required>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                      <label for="Slide-title">brand Status</label>
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

