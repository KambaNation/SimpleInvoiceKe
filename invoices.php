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
$mainpage ='invoices';
$page = 'invoices';


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
    
	        <!-- Invoice list -->
      <div class="block">
          <h6 class="heading-hr"><i class="icon-stack"></i> Invoice list</h6>
          <div class="datatable-invoices">
              <table class="table table-striped table-bordered">
                  <thead>
                  <tr>
                      <th class="invoice-number">Invoice #</th>
                      <th>Description</th>
                      <th class="invoice-amount">Amount</th>
                      <th>Status</th>
                      <th class="invoice-date">Issue date</th>
                      <th class="invoice-date">Due date</th>
                      <th class="invoice-expand text-center">View</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <?php
                      //select from invoice table
                      $invoice_sql="SELECT * FROM sp_invoices ORDER BY id DESC";
                      $invoice_query =mysqli_query($connection,$invoice_sql);
                      $invoice_count=mysqli_num_rows($invoice_query);

                      if (mysqli_num_rows($invoice_query) > 0) {
                          //fetch dat for invoice
                      while($invoice_row=mysqli_fetch_array($invoice_query)) {
                          //invice id.client.quote.project
                          $invoice_id=$invoice_row['id'];
                          $client_id=$invoice_row['customer_id'];
                          $quote_id=$invoice_row['quote_id'];
                          $status=$invoice_row['status'];
                          $date_posted=$invoice_row['date_created'];
                          //pick customer name
                          $customer_sql="SELECT * FROM sp_clients WHERE id='$client_id'";
                          $customer_query =mysqli_query($connection,$customer_sql);
                          $customer_row=mysqli_fetch_array($customer_query);

                          $customer_name = $customer_row['client_names'];


                          //pick details from quote
                          ?>
                          <td><a href="invoice<?php echo $invoice_id ?>"><strong>#00124</strong></a></td>
                          <td><?php echo $customer_name?></td>
                          <td><h4>$30.267</h4></td>
                          <td><span class="label label-success">Paid on 12 Jan, 2014</span></td>
                          <td><span class="text-semibold">December 12, 2013</span></td>
                          <td><span class="text-semibold">January 15, 2014</span></td>
                          <td class="text-center"><a data-toggle="modal" role="button" href="#default-modal" class="btn btn-default btn-xs btn-icon"><i class="icon-file6"></i></a></td>


                      <?php }
                      }else{ echo 'No Records found';}
                      ?>
                       </tr>



                  </tbody>
              </table>
          </div>
      </div>
			<!-- /invoice list -->


            <!-- Default modal -->

			<!-- /default modal -->
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

