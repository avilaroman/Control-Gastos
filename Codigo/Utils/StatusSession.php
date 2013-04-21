<?php
if(!isset($_SESSION))
{
	session_start();
}

if(!isset($_SESSION['username']))
{
	header("Location: index.php");
   	die();
}
else {
	echo "Bienvenido".$_SESSION['username'].PHP_EOL;
}
?>