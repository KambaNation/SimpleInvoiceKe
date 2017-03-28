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
   
             <div class="panel panel-default">
		        <div class="panel-heading">
			        <h6 class="panel-title"><i class="icon-coin"></i> New invoice</h6>
                	<div class="dropdown pull-right">
                    	<a href="#" class="dropdown-toggle panel-icon" data-toggle="dropdown">
	                    	<i class="icon-cog3"></i> 
	                    	<b class="caret"></b>
                    	</a>
						<ul class="dropdown-menu icons-right dropdown-menu-right">
							<li><a href="#"><i class="icon-print2"></i> Print invoice</a></li>
							<li><a href="#"><i class="icon-download"></i> Download invoice</a></li>
							<li><a href="#"><i class="icon-file-pdf"></i> View .pdf</a></li>
							<li><a href="#"><i class="icon-stack"></i> Archive</a></li>
						</ul>
                	</div>
		        </div>

				<div class="panel-body">

					<div class="row invoice-header">
						<div class="col-sm-6">
							<h3>The Romulan Empire</h3>
							<span>Building a Better Tomorrow Through Your Destruction</span>
						</div>

						<div class="col-sm-6">
 							<ul class="invoice-details">
								<li>Invoice # <strong class="text-danger">4759</strong></li>
								<li>Date of Invoice: <strong>01-24-2012</strong></li>
								<li>Due Date: <strong>02-10-2012</strong></li>
							</ul>
						</div>
					</div>


					<div class="row">
						<div class="col-sm-5">
							<h6>Invoice To:</h6>
 							<ul>
								<li><a href="#">Hiram Roth</a></li>
								<li>United Federation of Planets</li>
								<li><a href="#">president.roth@ufop.uni</a></li>
								<li>2269 Elba Lane</li>
								<li>Paris</li>
								<li>France</li>
								<li>888-555-2311</li>
							</ul>
						</div>


						<div class="col-sm-4">
							<h6>Invoice From:</h6>
 							<ul>
								<li><a href="#">Admiral Valdore</a></li>
								<li>Romulan Empire</li>
								<li><a href="#">admiral.valdore@theempire.uni</a></li>
								<li>5151 Pardek Memorial Way</li>
								<li>Krocton Segment</li>
								<li>Romulus</li>
								<li>000-555-9988</li>
							</ul>
						</div>


						<div class="col-sm-3">
							<h6>Invoice Details:</h6>
							<ul>
								<li>Total hours spent: <strong class="pull-right">379</strong></li>
								<li>Responsible: <a href="#" class="pull-right">Eugene Kopyov</a></li>
								<li>Issued by: <a href="#" class="pull-right">Jennifer Notes</a></li>
								<li>Payment method: <strong class="pull-right">Wire transfer</strong></li>
								<li class="invoice-status"><strong>Current status:</strong> <div class="label label-danger pull-right">Unpaid</div></li>
							</ul>
						</div>
					</div>

				</div>


				<div class="table-responsive">
				    <table class="table table-striped table-bordered">
				        <thead>
				            <tr>
				                <th>Product</th>
				                <th>Descrition</th>
				                <th>Discount</th>
				                <th>Total</th>
				            </tr>
				        </thead>
				        <tbody>
				            <tr>
				                <td>Concept</td>
				                <td>Creating project concept and logic</td>
				                <td>0</td>
				                <td><strong>$1,100</strong></td>
				            </tr>
				            <tr>
				                <td>General design</td>
				                <td>Design prototype</td>
				                <td>0</td>
				                <td><strong>$2,000</strong></td>
				            </tr>
				            <tr>
				                <td>Front end development</td>
				                <td>Coding and connecting front end</td>
				                <td>0</td>
				                <td><strong>$1,600</strong></td>
				            </tr>
				            <tr>
				                <td>Database</td>
				                <td>Creating and connecting database</td>
				                <td>0</td>
				                <td><strong>$890</strong></td>
				            </tr>
				        </tbody>
				    </table>
				</div>

				<div class="panel-body">
					<div class="row invoice-payment">
						<div class="col-sm-8">
							<h6>Payment method:</h6>
							<label class="radio">
								<input type="radio" name="payment-unpaid" class="styled">
								Checkout with Google
							</label>
							<label class="radio">
								<input type="radio" name="payment-unpaid" class="styled">
								Checkout with Amazon
							</label>
							<label class="radio">
								<input type="radio" name="payment-unpaid" class="styled" checked="checked">
								Wire transfer
							</label>
							<label class="radio">
								<input type="radio" name="payment-unpaid" class="styled">
								Checkout with Paypal
							</label>
							<label class="radio">
								<input type="radio" name="payment-unpaid" class="styled">
								Checkout with Skrill
							</label>
						</div>

						<div class="col-sm-4">
							<h6>Total:</h6>
							<table class="table">
								<tbody>
									<tr>
										<th>Subtotal:</th>
										<td class="text-right">$103,850</td>
									</tr>
									<tr>
										<th>Tax:</th>
										<td class="text-right">$5,192</td>
									</tr>
									<tr>
										<th>Total:</th>
										<td class="text-right text-danger"><h6>$109,042</h6></td>
									</tr>
								</tbody>
							</table>
							<div class="btn-group pull-right">
								<button type="button" class="btn btn-success"><i class="icon-checkbox-partial"></i> Confirm payment</button>
								<button type="button" class="btn btn-primary"><i class="icon-print2"></i> Print</button>
							</div>
						</div>
					</div>

					<h6>Notes &amp; Information:</h6>
					This invoice contains a incomplete list of items destroyed by the Federation ship Enterprise on Startdate 5401.6 in an unprovked attacked on a peaceful &amp; wholly scientific mission to Outpost 775.
					The Romulan people demand immediate compensation for the loss of their Warbird, Shuttle, Cloaking Device, and to a lesser extent thier troops.
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
        <script src="js/jquery.min.js"></script>
    </body>
</html>

