<?php 

session_start();

require_once '../includes/config.php';

// echo $_SESSION['userId'];

if(!$_SESSION['id']) {
	header('location: index.php');
} 



?>