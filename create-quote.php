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
include 'includes/functions.php';
//page name
$mainpage = 'quotes';
$page = 'add-quote';
//new db classes



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


                    <div class="success-messages"></div> <!--/success-messages-->

                    <form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">

                        <div class="form-group">
                            <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" value="<?php echo date('d-m-Y')?>" required/>
                            </div>
                        </div> <!--/form-group-->
                        <div class="form-group">
                            <label for="clientName" class="col-sm-2 control-label">Client Name</label>
                            <div class="col-sm-10">
                                <?php
                                $clients_query  = "select * from sp_clients ORDER BY id ASC";
                                $clients_res    = $connect->query($clients_query);

                                ?>
                                <select id="clientName" name="clientName" class="form-control"  onchange="clientDetails(this.value)" required>
                                    <option disabled selected>
                                        Select Customer Name
                                    </option>
                                    <?php
                                    while($clients_row=$clients_res->fetch_assoc())
                                    {
                                        $clients_name = html_entity_decode($clients_row['client_names']);

                                        $clients_id = html_entity_decode($clients_row['id']);
                                        //$bank_code = html_entity_decode($bank_row['bank_code']);


                                        ?>
                                        <option value="<?php echo $clients_id ?>">
                                            <?php echo $clients_name ?>
                                        </option>
                                    <?php }?>
                                </select>
                                  </div>
                        </div> <!--/form-group-->
                        <div class="form-group">
                            <label for="orderDate" class="col-sm-2 control-label">Project Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="projectName" name="projectName" autocomplete="off"  required/>
                            </div>
                        </div>
                        <!--/form-group-->

                        <table class="table" id="productTable">
                            <thead>
                            <tr>
                                <th style="width:40%;">Product</th>
                                <th style="width:20%;">Rate</th>
                                <th style="width:15%;">Quantity</th>
                                <th style="width:15%;">Total</th>
                                <th style="width:10%;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $arrayNumber = 0;
                            for($x = 1; $x < 4; $x++) { ?>
                                <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                                    <td style="margin-left:20px;">
                                        <div class="form-group">

                                            <select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" required>
                                                <option value="">~~SELECT~~</option>
                                                <?php
                                                $productSql = "SELECT * FROM product WHERE status = 1 AND quantity != 0";
                                                $productData = $connect->query($productSql);

                                                while($row = $productData->fetch_array()) {
                                                    echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
                                                } // /while

                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td style="padding-left:20px;">
                                        <input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />
                                        <input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                    </td>
                                    <td style="padding-left:20px;">
                                        <div class="form-group">
                                            <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
                                        </div>
                                    </td>
                                    <td style="padding-left:20px;">
                                        <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />
                                        <input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                    </td>
                                    <td>

                                        <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                                    </td>
                                </tr>
                                <?php
                                $arrayNumber++;
                            } // /for
                            ?>
                            </tbody>
                        </table>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
                                    <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
                                </div>
                            </div> <!--/form-group-->
                            <div class="form-group">
                                <label for="vat" class="col-sm-3 control-label">VAT 13%</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
                                    <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
                                </div>
                            </div> <!--/form-group-->
                            <div class="form-group">
                                <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
                                    <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
                                </div>
                            </div> <!--/form-group-->
                            <div class="form-group">
                                <label for="discount" class="col-sm-3 control-label">Discount</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" />
                                </div>
                            </div> <!--/form-group-->
                            <div class="form-group">
                                <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
                                    <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
                                </div>
                            </div> <!--/form-group-->
                        </div> <!--/col-md-6-->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
                                </div>
                            </div> <!--/form-group-->
                            <div class="form-group">
                                <label for="due" class="col-sm-3 control-label">Due Amount</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="due" name="due" disabled="true" />
                                    <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
                                </div>
                            </div> <!--/form-group-->
                            <div class="form-group">
                                <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="paymentType" id="paymentType">
                                        <option value="">~~SELECT~~</option>
                                        <option value="1">Cheque</option>
                                        <option value="2">Cash</option>
                                        <option value="3">Credit Card</option>
                                    </select>
                                </div>
                            </div> <!--/form-group-->
                            <div class="form-group">
                                <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="paymentStatus" id="paymentStatus">
                                        <option value="">~~SELECT~~</option>
                                        <option value="1">Full Payment</option>
                                        <option value="2">Advance Payment</option>
                                        <option value="3">No Payment</option>
                                    </select>
                                </div>
                            </div> <!--/form-group-->
                        </div> <!--/col-md-6-->


                        <div class="form-group submitButtonFooter">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

                                <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

                                <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
                            </div>
                        </div>
                    </form>

</div>
        </div>
        <!--footer-->
        <?php require 'includes/footer.php'; ?>
    </div>
</div>

<!-- end Page container -->
<!--JS-->
<!-- end Page container --><!-- jquery -->
<script src="assests/jquery/jquery.min.js"></script>
<!-- jquery ui -->
<link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
<script src="assests/jquery-ui/jquery-ui.min.js"></script>

<?php require 'includes/js.php';?>
<script src="custom/js/product.js"></script>
<script src="custom/js/brand.js"></script>
<script src="custom/js/categories.js"></script>
<script src="custom/js/order.js"></script>
<script src="custom/js/setting.js"></script>
<script src="custom/js/report.js"></script>


</body>
</html>

