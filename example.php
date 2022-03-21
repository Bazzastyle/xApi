<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	require_once __DIR__ . "/vendor/autoload.php";

	use xApi\Xbox;

	$xbox = new Xbox("f787fbc2c7167053ebcc4ff572302131cb61691f", "en-EN");
	
	echo json_encode($xbox->account_profile());
	exit();