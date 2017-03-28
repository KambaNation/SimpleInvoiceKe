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
$mainpage ='';
$page = 'dashboard';


?>
<?php

//number of products

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;


$sql_users = "SELECT * FROM sp_users WHERE status = 1";
$query_users = $connect->query($sql_users);
$countUsers = $query_users->num_rows;
//if Admin show all orders



//if user show only by that user



//if user admin see all customers
$sql_customers = "SELECT * FROM sp_customers WHERE status = 1";
$query_customers = $connect->query($sql_customers);
$countCustomers = $query_customers->num_rows;

//if user view own contacts
$sql_contact = "SELECT * FROM sp_customers WHERE owner='$user_id'";
$query_contact = $connect->query($sql_contact);
$countContact = $query_contact->num_rows;

//orders

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = "";
while ($orderResult = $orderQuery->fetch_assoc()) {
    $totalRevenue += $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$connect->close();

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
        <ul class="info-blocks">
            <li class="bg-primary">
                <div class="top-info">
                    <a href="settings">Low Stock</a>
                    <small>System management</small>
                </div>
                <a href="settings"><i class="icon-cogs"></i></a>
                <span class="bottom-info bg-danger"><?php echo $countLowStock; ?></span>
            </li>
            <?php if($_SESSION['user']=="admin") { ?>
            <li class="bg-success">
                <div class="top-info">
                    <a href="customers">Customers</a>
                    <small>view</small>
                </div>
                <a href="customers"><i class="icon-users"></i></a>
                <span class="bottom-info bg-primary"><?php echo $countCustomers;?> customers</span>
            </li>
            <?php }else{
                ?>
                <li class="bg-success">
                    <div class="top-info">
                        <a href="customers">Customers</a>
                        <small>view</small>
                    </div>
                    <a href="customers"><i class="icon-users"></i></a>
                    <span class="bottom-info bg-primary"><?php echo $countContact;?> customers</span>
                </li>

            <?php
            }
            ?>
            <li class="bg-danger">
                <div class="top-info">
                    <a href="quotes">Quote</a>
                    <small>stats</small>
                </div>
                <a href="quotes"><i class="icon-stats2"></i></a>
                <span class="bottom-info bg-primary"><?php echo $countOrder; ?> Quotes</span>
            </li>
            <?php if($_SESSION['user']=="admin") { ?>
            <li class="bg-info">
                <div class="top-info">
                    <a href="users">Users</a>
                    <small>View</small>
                </div>
                <a href="users"><i class="icon-bubbles3"></i></a>
                <span class="bottom-info bg-primary"><?php echo $countUsers ?> Users</span>
            </li>
            <?php } ?>
            <li class="bg-warning">
                <div class="top-info">
                    <a href="products">Products</a>
                    <small>Views</small>
                </div>
                <a href="products"><i class="icon-cart2"></i></a>
                <span class="bottom-info bg-primary"><?php echo $countProduct ?> Products</span>
            </li>
            <li class="bg-primary">
                <div class="top-info">
                    <a href="invoices">Invoices stats</a>
                    <small>invoices archive</small>
                </div>
                <a href="invoices"><i class="icon-coin"></i></a>
                <span class="bottom-info bg-danger"><?php ?>invoices</span>
            </li>
            <li class="bg-primary">
                <div class="top-info">
                    <a href="invoices">Revenues</a>
                    <small>invoices archive</small>
                </div>
                <a href="invoices"><i class="icon-coin"></i></a>
                <span class="bottom-info bg-danger">KSH. <?php if($totalRevenue) {
                        echo number_format($totalRevenue);
                    } else {
                        echo '0';
                    } ?></span>
            </li>

        </ul>
        <!-- /default panel -->

        <!--footer-->
        <?php require 'includes/footer.php'; ?>
    </div>
</div>

<!-- end Page container -->
<!--JS-->

<?php require 'includes/js.php';?>
</body>
</html>

