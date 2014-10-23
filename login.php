<?php
$link = "register.php";
$linkText = "Register";
// Check to see if either:
// 1 - form has been submitted with logon data
// 2 - Remember me cookie has been set
if ( isset($_POST['submitted']) || isset($_COOKIE['elephant']) ) {
	require_once ('includes/login_functions.inc.php');
	require_once ('includes/mysqli_connect.php');
	
	// COOKIE MONSTER!
	// Check for the remember me cookie
	// If we detect the cookie then we check for the corresponding hash in the DB
	// If both those hashes match then we can proceed stright to the calc
	if( isset($_COOKIE['elephant']) ) {
		session_start();

		// Query to check if browser info hash is stored against the uer
		// IE they HAVE clicked remember me
		$qq = 'SELECT user_id, username, first_name, FROM users WHERE remember = md5("' . $_SERVER['HTTP_USER_AGENT'] .'") ';
		$rr = @mysqli_query ($dbc, $qq);	
		$rowrow = mysqli_fetch_array($rr, MYSQLI_ASSOC);
		
		if ($rowrow) {
			// If the hash check was succsessful populate session info
			$_SESSION['user_id'] = $rowrow['user_id'];
			$_SESSION['first_name'] = $rowrow['first_name'];
			$_SESSION['username'] = $rowrow['username'];
			
			//redirect them to the loogged in page
			$url = absolute_url('loggedin.php');
			header("Location: $url");
			exit();
		} 
	}
	
	//Sanitise the inputs for html
	function sanitise_values($value) {
		$value = strip_tags($value);
		return trim($value);
	}	
	
	//map the above to each element in POST array
	$sanitised = array_map('sanitise_values', $_POST);
		
	// If cookie not set then run check on the login info
	list ($check, $data) = check_login($dbc, $sanitised['email'], $sanitised['password']);
	
	if ($check) {
		session_start();
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['first_name'] = $data['first_name'];
		$_SESSION['username'] = $data['username'];
		
		// Initiate remember me code
		if ( $_POST['remember'] == 'yes' ) {
			
			// Set cookie - uses hash of users system set to expire in one month (2629743 seconds)
			setcookie ('elephant', md5($_SERVER['HTTP_USER_AGENT']), time()+2629743, '/', '', 0, 0);
			
			// Now to enter a hash into the DB to cross-check
			// These hashes must match to auto-login
			$qu = 'UPDATE  users SET  remember = md5("' . $_SERVER['HTTP_USER_AGENT'] .'") WHERE  user_id = ' . $data['user_id'] .' ';
			$ru = @mysqli_query ($dbc, $qu);		
		} else {
			
			// If not checked on login then delete the cookie
			setcookie ('elephant', md5($_SERVER['HTTP_USER_AGENT']), time()-2629743, '/', '', 0, 0);	
		}

		
		//Redirect if user not logged in
		$url = absolute_url('loggedin.php');
		header("Location: $url");
		exit();
	} else {
		$errors = $data;	
	}
	
	mysqli_close($dbc);
	
}

include('includes/login_page.inc.php');

?>