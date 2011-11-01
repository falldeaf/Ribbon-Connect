<?php

$url = $_GET['url'];

$var = trim(  str_replace( "\n", "",  file_get_contents("http://" . $url) ), "<html><li>/" );

if($var == "Error")
{
	echo "0";
} else {
	echo $var;
}

?> 