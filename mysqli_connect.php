<?php 
//ini_set('display_errors', '1');

session_start();

/*
DEFINE ('DB_SERVER', 'db2756.oneandone.co.uk');
DEFINE ('DB_USER', 'dbo339610176');
DEFINE ('DB_PASSWORD', 'Glasgow21');
DEFINE ('DB_NAME', 'db339610176');
*/

DEFINE ('DB_USER', 'test');
DEFINE ('DB_PASSWORD', 'been21');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'spending_calc');


$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Cold not connect to MySQL: ' . mysqli_connect_error() ); //@ = error suppression 


