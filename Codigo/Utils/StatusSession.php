<?php
if(!isset($_SESSION))
{
	session_start();
}

if(!isset($_SESSION['username']))
{
?>
	<script language="javascript" type="text/javascript">
    	document.location.href="index.php";
   </script>
   <?php
}
else {
	echo "Bienvenido".$_SESSION['username'].PHP_EOL;
}
?>