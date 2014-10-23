<?php
session_start();

//if ( !isset($_COOKIE['user_id']) ) {
if ( !isset($_SESSION['user_id']) ) {
	require_once ('includes/login_functions.inc.php');
	
	$url = absolute_url('login.php');
	
	header("location: $url");
	exit();
} elseif ( isset($_SESSION['user_id']) ) {
	require_once ('includes/login_functions.inc.php');
	
	$url = absolute_url('index.php');
	
	header("location: $url");
	exit();
}

?>