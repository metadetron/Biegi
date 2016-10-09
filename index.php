<?php
/*
	This is URL/JSON layer and we only care about this here
 */ 

	session_start();
	date_default_timezone_set('Europe/Warsaw');
	header("Access-Control-Allow-Orgin: *");
    header("Access-Control-Allow-Methods: *");
    header("Content-Type: application/json");

	include_once "virgo.php";

	// TODO handle this properly
//	$_SESSION['current_role_id'] = "biegacz";
//	$_SESSION['user_id'] = 10;

	// Jednak errory musza byc poprzez kody HTTP zwracane a nie jak w HP!
	// Bo to nie my obslugujemy ich odbior tylko backbone! 
	function returnJson($res, $error) {
		if ($error == "") {
			echo json_encode($res);
		} else {
			header("HTTP/1.1 406 $error");
		}
		exit;
	}

	$method = $_SERVER['REQUEST_METHOD'];
	if (is_null($_GET['entity'])) {
		header("HTTP/1.1 406 Missing entity information");
		return;
	}
	$entity = $_GET['entity'];
	$id = $_GET['id'];
	$error = "";
	$res = VirgoAccessLayer::callVirgoClassMethod($entity, $method, $id, $error);	
	returnJson($res, $error);
?>