<?php

if (!isset($_COOKIE['hash']) ) {
	setcookie('hash', '1234', time()+10);
	echo '<h2>Cookie NOT set: </h2>';
} else {
	echo '<h2>Cookie set</h2>
		<p>' . $_COOKIE['hash'] . '</p>';
}

?>

