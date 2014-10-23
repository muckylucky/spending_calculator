<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

//$fromDateMonth = date("m," . $day, m . ", Y", strtotime("last month"));
$day = 12;
$month = date("m", strtotime("last month") );
$year = date("Y", strtotime("last month") );
$now = date('Y-m-d H:i:s');
$currentDay = date('d');

//$formattedDate = $fromDateMonth->format('Y, n, j'); 
//echo '<p>' . $formattedDate . '</p>';
if ( checkdate($month, $day, $year) ) {
	$fromDateMonth = date('Y-m-d', strtotime('last day of last month'));
	echo '<h2>' . $fromDateMonth . '</h2>';	
} if  ( !checkdate($month, $day, $year) ) {

	while ( !checkdate($month, $day, $year) ) {
		$day--;
		echo '<p>' . $day . '</p>';
	}
	//$newDate = setDate($year, $month, $day);
	//$newDate->format('F jS, Y');
	
}

	echo '<h1>' . $day . '</h1>';	


if ( $currentDay < $day ) {
	echo '<p>You got paid last month.</p>';	
} elseif ( $currentDay == $day ) {
	echo '<p>You got paid today!</p>';	
} elseif ( $currentDay > $day ) {
	echo '<p>You last got paid on the ' . $day . ' of this month</p>';	
	
}

?>
</body>
</html>