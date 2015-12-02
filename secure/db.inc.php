<?php

error_reporting(0);

//determine if working on local or live server
$host = substr($_SERVER['HTTP_HOST'], 0, 5);
if (in_array($host, array('local', '127.0', '192.1'))){
$local = TRUE;
} else {
$local = FALSE;
}

//Determine location of files and the url of the site:
//Allow for development on different servers
if ($local) {

//Always debug when running locally
$debug = TRUE;

$username="root";
$password="";
$database="carl";
} else {
$username="name";
$password="pass";
$database="db";
	
}

?>