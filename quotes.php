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
$mainpage ='reports';
$page = 'qoute-report';


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
      <div class="panel-body"><div class="table-responsive">
              <div id="success-messages"></div>

              <table class="table" id="manageOrderTable">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Order Date</th>
                      <th>Client Name</th>
                      <th>Project Name</th>
                      <th>Total Order Item</th>
                      <th>Payment Status</th>
                      <th>Option</th>
                  </tr>
                  </thead>
                  <?php
                  $sql = "SELECT order_id, order_date, client_name, project_name, payment_status FROM orders WHERE order_status = 1";
                  $result = $connect->query($sql);
                  $count = $result->num_rows;
                  ?>
                  <tbody>
                  <?php
                    if($count==0){
                        echo'No records';
                    }else{
                        while($row=$result->fetch_assoc()){
                            //variables from the ordertable

                            $order_id = $row['order_id'];
                            $order_client = $row['client_name'];
                            $order_project = $row['project_name'];
                            $order_payment = $row['payment_status'];
                            $order_date = $row['order_date'];
                            //client name

                            $client_sql = "SELECT * FROM sp_clients WHERE id = '$order_client'";
                            $client_res = $connect->query($client_sql);
                            $client_row = $client_res ->fetch_assoc();

                            $client_name = $client_row['client_names'];
                            //count orders
                            $countOrderItemSql = "SELECT count(*) FROM order_item WHERE order_id = $order_id";
                            $itemCountResult = $connect->query($countOrderItemSql);
                            $itemCountRow = $itemCountResult->fetch_assoc();

                    ?>
                  <tr>
                      <td><?php echo $order_id ?></td>
                      <td><?php echo $order_date?></td>
                      <td><?php echo $client_name?></td>
                      <td><?php echo $order_project?></td>
                      <td><?php echo $itemCountRow ?></td>
                      <td><?php ?></td>
                      <td><div class="btn-group">
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                  <li><a href="orders.php?o=editOrd&i='.$orderId.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>

                                  <li><a type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder('.$orderId.')"> <i class="glyphicon glyphicon-save"></i> Create Invoice</a></li>

                                  <li><a type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder('.$orderId.')"> <i class="glyphicon glyphicon-save"></i> Payment</a></li>

                                  <li><a type="button" onclick="printOrder('.$orderId.')"> <i class="glyphicon glyphicon-print"></i> Print </a></li>

                                  <li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
                              </ul>
                          </div></td>
                  </tr>
                  <?php    }
                    }
                  ?>
                  </tbody>
              </table>
              <table id="example-table" class="table table-striped">
                  <thead>
                  <tr>
                      <th><input type="checkbox" > </th>

                      <th>Quote Serial</th>
                      <th>Project Name</th>
                      <th>Client</th>
                      <th>User Posted</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
                  </thead>

                  <?php
                  $quote_query  = "select * from quote_details ORDER BY id DESC";
                  $quote_res    = mysqli_query($connection,$quote_query);
                  $quote_count  =   mysqli_num_rows($quote_res);

                  ?>
                  <?php
                  if (mysqli_num_rows($quote_res) > 0) {

                      while($quote_row=mysqli_fetch_array($quote_res)) {

                          $quote_serial = $quote_row['quote_id'];
                          $quote_user = $quote_row['user_id'];
                          $quote_amount= $quote_row['total_price'];
                          $quote_status = $quote_row['status'];
                          $quote_client= $quote_row['client_id'];
                          $quote_project= $quote_row['project_name'];
                          //user Table

                          //client Table

                          $quote_id = $quote_row['id'];?>
                          <tr>
                              <td><input type="checkbox" > </td>
                              <td><a href='view_user?id=<?php echo $quote_id ?>'><?php echo $quote_serial; ?></a></td>
                              <td><a href='view_user?id=<?php echo $quote_id ?>'><?php echo $quote_project; ?></a></td>

                              <td ><a href="tel:<?php echo $quote_client; ?>"> <?php echo $quote_client; ?></a></td>
                              <td ><?php echo $quote_user    ?></td>
                              <td ><?php if($quote_status==1){
                                      echo'<span class="label label-success">Ongoing</span>';

                                  }else{
                                      echo'<span class="label label-danger">Completed</span>';
                                  } ?></td>
                              <td width="15%"><div class="btn-group"><a href='edit-user?id=<?php echo $quote_id ?>' data-toggle="tooltip" title="Edit" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>
                                      &nbsp;<a href='delete?id=<?php echo $quote_id ?>&type=user' data-toggle="tooltip" title="Delete" data-placement="top" onclick="return confirm('Are you sure you wish to move this record to trash?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </a>
                                      <a href='view_user?id=<?php echo $quote_id ?>' class="btn btn-success btn-xs" data-toggle="tooltip" title="View Project" data-placement="top" ><i class="fa fa-eye"></i></a>
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
        <script src="js/jquery.min.js"></script>
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