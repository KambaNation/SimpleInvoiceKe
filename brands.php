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
        <h6 class="panel-title">Default panel</h6>
          <span class="pull-right"><a href="create-brands.php" class="btn btn-danger btn-sm">Add New Brand</a> </span>
      </div>
      <div class="panel-body">

          <div class="remove-messages"></div>


          <div class="table-responsive">


              <table class="table" id="manageBrandTable">
                  <thead>
                  <tr>
                      <th><input type="checkbox" ></th>
                      <th>Brand Name</th>
                      <th>Status</th>
                      <th style="width:15%;">Options</th>
                  </tr>
                  </thead>

                  <tbody>
                  <?php
                  $brand_query  = "select * from brands";
                  $brand_res    = $connect->query($brand_query);
                  $brand_count  =  $brand_res->num_rows;

                  ?>
                  <?php
                  if ($brand_count > 0) {

                      while($brand_row=$brand_res->fetch_assoc()) {

                          $brand_names = $brand_row['brand_name'];
                          $brand_status = $brand_row['brand_status'];

                          $brand_id = $brand_row['brand_id'];?>
                          <tr>
                              <td><input type="checkbox" > </td>
                              <td><?php echo $brand_names; ?></td>

                              <td ><?php if($brand_status==1){
                                      echo'<span class="label label-success">Active</span>';

                                  }else{
                                      echo'<span class="label label-danger">suspended</span>';
                                  } ?></td>
                              <td width="15%"><div class="btn-group"><a href='edit-brand?id=<?php echo $brand_id ?>' data-toggle="tooltip" title="Edit" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>
                                      &nbsp;<a href='delete?id=<?php echo $brand_id ?>&type=brands' data-toggle="tooltip" title="Delete" data-placement="top" onclick="return confirm('Are you sure you wish to move this record to trash?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </a>

                                  </div>
                              </td>
                          </tr>


                      <?php }
                  }  else {
                      echo 'No Records';
                  }

                  ?>


                  </tbody>
              </table>
              <!-- /table -->
          </div>


      </div>
    </div>
      <!-- /default panel -->

      <!--footer-->
      <?php require 'includes/footer.php'; ?>
  </div>
        </div>

        <!-- end Page container -->
        <!--JS-->
        <?php require 'includes/js.php';?>

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