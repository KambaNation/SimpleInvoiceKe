<?php
/**
 * Created by PhpStorm.
 * User: SparkWorld
 * Date: 12/4/2016
 * Time: 3:54 PM
 */



//connect to db
error_reporting(0);
//local db kanad_invoice
/*
$connection = mysqli_connect("localhost", "root", "", "kanad_final");

if(!$connection){
    echo "Cannot connect to the server: (" . mysqli_connect_errno(). ")";
    exit();
}

//remote db
$connection = mysqli_connect("localhost", "kanadsys_admin", "keny2015", "kanadsys_crm");

if(!$connection){
    echo "Cannot connect to the server: (" . mysqli_connect_errno(). ")";
    exit();

}
*/

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "kanad_final";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
    die("Connection Failed : " . $connect->connect_error);
} else {
    // echo "Successfully connected";
}

//remote
/*
$localhost = "localhost";
$username = "kanadsys_admin";
$password = "keny2015";
$dbname = "kanadsys_crm";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
    die("Connection Failed : " . $connect->connect_error);
} else {
    // echo "Successfully connected";
}
*/