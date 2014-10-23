<?php 

session_start();

if ( !isset($_SESSION['user_id']) ) {
		require_once('includes/login_functions.inc.php');
		$url = absolute_url();
		header("Location: $url");
		exit();
} else {
	/*
	setcookie ('user_id', '', time()-3600, '/', '', 0, 0);	
	setcookie ('first_id', '', time()-3600, '/', '', 0, 0);	
	*/
	
	// Clear the session variables
	$_SESSION = array();
	// DESTROY the session
	session_destroy();
	// DESTROY the cookie
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0);
	// DESTROY the 'remember me' cookie
	setcookie ('elephant', md5($_SERVER['HTTP_USER_AGENT']), time()-2629743, '/', '', 0, 0);
}

$page_title = 'Logged out!';
$link = 'login.php';
$linkText = 'Log in';

include ('includes/header.html');
echo '<h1>Logged out!</h1>
	<p>You are now logged out!</p>
	<a href="login.php" class="btn btn-primary">Login</a>
	<span> Or </span>
	<a href="register.php" class="btn">Register</a>';

include ('includes/footer.html');

?>