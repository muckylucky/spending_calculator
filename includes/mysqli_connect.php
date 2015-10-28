<?php # Script 8.2 - mysqli_connect.php

//Contains database access info
//Establishes connection to MySQL & selects the database

//Set access info as constants

DEFINE ('DB_SERVER', 'db2756.oneandone.co.uk');
DEFINE ('DB_USER', 'dbo339610176');
DEFINE ('DB_PASSWORD', 'Glasgow21');
DEFINE ('DB_NAME', 'db339610176');

$dbc = @mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Cold not connect to MySQL: ' . mysqli_connect_error() ); //@ = error suppression 

