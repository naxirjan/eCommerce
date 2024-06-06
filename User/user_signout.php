








<?php
	require_once("../library/session.php");

	$session = new Session();
	$session->destroyUserSession();
	header("location:index.php");
?>