<?php
/*
	This is URL/JSON layer and we only care about this here
 */ 

	session_start();
	header("Access-Control-Allow-Orgin: *");
    header("Access-Control-Allow-Methods: *");
    header("Content-Type: application/json");

	include_once "virgo.php";

	function returnJson($res, $error) {
		if ($error == "") {
			echo json_encode(array("success" => true, "result" => $res));
		} else {
			echo json_encode(array("success" => false, "result" => $error));
		}
		exit;
	}

	$method = $_SERVER['REQUEST_METHOD'];
	if ($method == "GET") {
		if (is_null($_GET['entity'])) {
			header("HTTP/1.1 406 Missing entity information");
			return;
		}
		$entity = $_GET['entity'];
		$id = $_GET['id'];
		$error = "";
		$res = VirgoAccessLayer::callVirgoClassMethod($entity, $method, $id, $error);	
		returnJson($res, $error);
    }
?>