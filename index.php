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
		switch ($entity) {
			case "auth":
	            echo json_encode(1);
	            exit;
			case "month":
	            echo json_encode(array(array('2015-07', 100), array('2015-08', 105), array('2015-09', 120), array('2015-10', 80)));
	            exit;				
			default:
				header("HTTP/1.1 500 Internal Server Error");
				echo "Entity not supported";
				exit;		
		}
    }
?>