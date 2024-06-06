








<?php

	require_once("../library/session.php");

	$session = new Session();
	$session->destroyAdminSession();
	header("location:index.php");


?>