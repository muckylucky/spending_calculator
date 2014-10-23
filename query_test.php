<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
	require_once ('includes/mysqli_connect.php');
	$page_title = 'Login';
	
	include('includes/header.html');
	
    if ( !empty($errors) ) {
        echo '<h1>Error!</h1>
              <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) {
            echo " - $msg<br />\n";	
        }
    }
	if( isset($_COOKIE['elephant']) ) {
		echo '<h1>Cookie Set</h1>';
		$querycookie = "SELECT SUM(amount) AS 'sum2' FROM monthly_spends_23";
		$result = @mysqli_query($dbc, $querycookie);	
		$row3 = mysqli_fetch_array($result, MYSQLI_ASSOC);	
		print_r($row3);
		if ($row3) {
			echo '<h1>' . $row3['sum2'] . '</h1>';
		} else {
			echo 'Pish';	
		}
	}
?>

</body>
</html>