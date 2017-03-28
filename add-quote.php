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
                <div class="col-md-12">
                    <?php
                  

                    if(isset($_POST['save'])){
                        $quote_id = htmlentities($_POST['clients-name'], ENT_QUOTES);
                        $client_id = htmlentities($_POST['clients-name'], ENT_QUOTES);
                        $project_name = htmlentities($_POST['project-name'], ENT_QUOTES);
                        $status= 0;

                        $query = "INSERT INTO `sp_quotes`(`id`, `qoute_id`, `client_id`,`project_name`, `user_id`, `status`, `date_created`) VALUES (NULL,'$quote_id','$client_id','$project_name','$user_id','$status',NOW())";
                        if($connect->query($query)){
                            $quote_id = $connect->insert_id;
                            $cquery="";
                            $count = count($_POST['product_name']);
                            for($i=0;$i<$count;$i++){

                                $cquery .= "INSERT INTO `quote_details`(`id`, `quote_id`, `product_id`, `quantity`, `vat`, `prices`, `labour`, `total_price`, `date_created`) VALUES (NULL,'$quote_id','".$_POST['product_name'][$i]."','".$_POST['qty'][$i]."','".$_POST['qty'][$i]."','".$_POST['price'][$i]."','".$_POST['price'][$i]."','".$_POST['price'][$i]."',NOW());";
                            }
                            if($connect->multi_query($cquery))
                                echo "Record Saved";
                            else
                                echo "Shirts Details Saved to failed";
                        }
                        else{
                            echo "Person Details Saved to failed";
                        }
                    }
                    ?>


                <form role="form" method="post" action="" enctype="multipart/form-data" name="add_me" id="add_me">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Slide-title">Customer Name</label>
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
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Slide-title">project Name</label>
                            <input type="text" name="project-name" placeholder="Project Name" class="form-control">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6 col-md-6 col-sm-12 cool-xs-12">
                        <button type="button" class="btn btn-primary" name="add" id="add_input">
                            <span class="fa fa-search"></span>   Add product from Catalog
                        </button>


                    </div>
                    <br>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-stripped table-condensed" id="dynamic">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><select name="product_name[]" class="form-control">
                                        <option disabled selected>Select Product</option>
                                        <?php
                                        $productSql = "SELECT * FROM sp_products WHERE status = 1 ";
                                        $productData =mysqli_query( $connection,$productSql);

                                        while($row = mysqli_fetch_array($productData)) {
                                            echo "<option value='".$row['id']."' id='changeProduct".$row['id']."'>".$row['product_name']."</option>";
                                        } // /while

                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="price[]" class="form-control">

                                </td>
                                <td>
                                    <input type="number" name="qty[]" class="form-control" min="1">

                                </td>
                                <td>
                                    <input type="text" name="total[]" class="form-control">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" name="add" id="add_input">
                                        Add product
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" name="save" class="btn btn-primary  btn-square pull-right">Submit</button>
                    </div>
                </form>



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
<script src="js/jquery.min.js"></script>
<script>

    $(document).ready(function(){
        var i=1;
        $('#add_input').click(function(){
            i++;

            $('#dynamic').append('<tr id="row'+i+'"><td>'+
                '<select name="product_name[]" class="form-control">'+
                '<option disabled selected>Select Product</option>'+
                '<option value="">'+
                '</option>'+
                '</select></td>'+
                '<td><input type="text" name="price[]" class="form-control"></td>'+
                '<td><input type="number" name="qty[]" class="form-control" min="1"></td>'+
                '<td><input type="text" name="total[]" class="form-control"></td>'+
                '<td><button type="button" name="remove" id="'+i+'" class="btn_remove btn btn-danger">Remove</button></td>'
                +'</tr>');
        });
        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
        $('#submit').click(function(){
            $.ajax({
                url:"insert.php",
                method:"POST",
                data:$('#add_me').serialize(),
                success: function(data)
                {
                    alert(data);
                    $('#add_me')[0].reset();
                }
            });
        });
    });
</script>




</body>
</html>

