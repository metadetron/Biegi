<?php
	session_start();
	header("Access-Control-Allow-Orgin: *");
    header("Access-Control-Allow-Methods: *");
    header("Content-Type: application/json");
	$method = $_SERVER['REQUEST_METHOD'];
	if ($method == "GET") {
		if (is_null($_GET['entity'])) {
			header("HTTP/1.1 406 Missing entity information");
			return;
		}
		$entity = $_GET['entity'];
		if ($entity == "auth") {
            echo json_encode(1);
            exit;
        }
		header("HTTP/1.1 500 Internal Server Error");
		echo "Entity not supported";
		exit;		
    }
?>