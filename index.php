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
	            echo json_encode(
					array(
						array('2014-07',  33)          
						,array('2014-08',  34.95)          
						,array('2014-09',  33.85)          
						,array('2014-10',  19.09)          
						,array('2014-11',  17.24)          
						,array('2014-12',  13.668)          
						,array('2015-01',  0)          
						,array('2015-02',  9.704)          
						,array('2015-03',  24.052)          
						,array('2015-04',  30.872)          
						,array('2015-05',  32.65)          
						,array('2015-06',  15.66)          
						,array('2015-07',  17.75)          
						,array('2015-08',  24.85)          
						,array('2015-09',  14.2)          
						,array('2015-10',  15.3)          
						,array('2015-11',  7.38)          
						,array('2015-12',  3.55)          
						,array('2016-01',  0)    
						,array('2016-02',  17.484)          
						,array('2016-03',  10.1)          
						,array('2016-04',  33.25)          
						,array('2016-05',  37.33)          
						,array('2016-06',  33.784)          
						,array('2016-07',  22.57)          
						,array('2016-08',  37.85)          
						,array('2016-09',  26.48)          
					)
				);
	            exit;				
			case "stats":
	            echo json_encode(array("currentDate" => date("Y-m-d H:i:s"), "runCount" => 146, "lastRun" => "2016-09-23", "totalDistance" => 566.61));
	            exit;
			case "pb":
	            echo json_encode(
					array(
						array("track" => date("Błonia"), "time" => "23:21"),
						array("track" => date("Krynica"), "time" => "27:22"),
						array("track" => date("Lolów"), "time" => "25:48"),
						array("track" => date("Bulwary"), "time" => "33:23"),
						array("track" => date("Radziejowice"), "time" => "13:37")
					)
				);
	            exit;
			default:
				header("HTTP/1.1 500 Internal Server Error");
				echo "Entity not supported";
				exit;		
		}
    }
?>