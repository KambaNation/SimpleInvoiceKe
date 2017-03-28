<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//database
require 'includes/config.php';
//login - sessions

//functions
require 'includes/functions.php';

$id=$_REQUEST['id'];
$type=$_REQUEST['type'];
switch($type)
{
	//delete sliders
case 'user':
    $connect->query("delete from  sp_users where id=$id");
header("location:users.php");
break;	
case 'customers':
//delete projects
$connect->query("delete from  sp_clients where id=$id");
header("location:customers.php");
break;
case 'projects':
//delete images
        $connect->query("delete from  sp_projects where id=$id");
header("location:projects.php");
break;
    case 'products':
//delete images
        $connect->query("delete from  product where product_id=$id");
        header("location:products.php");
        break;
    case 'brands':
//delete images
        $connect->query("delete from  brands where brand_id=$id");
        header("location:brands.php");
        break;
    case 'category':
//delete images
        $connect->query("delete from  categories where categories_id=$id");
        header("location:category.php");
        break;
}



?>
