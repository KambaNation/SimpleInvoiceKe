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
$mainpage = 'invoices';
   $page = 'add-invoice';


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


          <form role="form" method="post" action="" enctype="multipart/form-data">
              <div class="col-lg-12">
                  <div class="form-group">
                      <label for="Slide-title">Select Quote</label>
                      <select name="invoice-serial" class="form-control" required  data-live-search="true">
                          <option>Select Quote Here</option>
                          <?php
                          //select Descending/with customer name
                          //from quotes table
                          $quote_sql = "SELECT * FROM orders ORDER BY order_id DESC";
                          $quote_res = $connect->query($quote_sql);
                          $quote_count = $quote_res->num_rows;
                          if($quote_count ==0){
                              echo'no data fount';
                          }else{
                              while($quote_row=$quote_res->fetch_assoc()){
                                  $quote_id = $quote_row['order_id'];
                                  $quote_customer = $quote_row['client_name'];
                                  //select from Customer Table
                                  $customer_sql ="SELECT * FROM sp_clients WHERE id ='$quote_customer'";
                                  $customer_res = $connect->query($customer_sql);
                                  $cust_row = $customer_res ->fetch_assoc();

                                  $customer_name = $cust_row['client_names'];
                                  ?>
                            <option value="<?php  echo  $quote_id ?>"><?php echo $quote_id ."-".$customer_name ?></option>

                          <?php
                              }

                          }


                          //from customers table - name match


                          ?>
                          <option>Select Quote Here</option>
                      </select>
                  </div>
              </div>

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

              <div class="col-lg-6">
                  <div class="form-group">
                      <label for="exampleInputFile">Company Logo</label>
                      <input type="file" id="exampleInputFile" name="company_logo" class="form-control">
                      <p class="help-block">Image Size Here (0 x 0)</p>
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

