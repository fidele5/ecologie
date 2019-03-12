<?php
	session_name("inscription");
	session_start();
	session_destroy();
	header('location: index.php');
?>
