<?php
	/*
		Our only concern here is that the requested virgo object is invoked, method called and result returned.
		In general: we don't introduce custom actions like "addToCart" but try to define custom entities instead...
		Collection URL = /customers
		Specific Item URL = /customers/32
			POST Create (Collection URL)	
			GET	Read (Both)
			PUT	Update/Replace (Specific Item URL)
			PATCH Update/Modify (Specific Item URL)
			DELETE	Delete (Specific Item URL)
	*/

	/* error_reporting(E_ERROR); TODO uncomment */
	define( '_INDEX_PORTAL', 1 );
	define('PORTAL_PATH', '/home/sirjoe/portal_4');
	define('VIRGO_PORTAL_INSTANCE', 'biegi');
	define('APP_ROOT', dirname(__FILE__));	

	include_once(PORTAL_PATH.DIRECTORY_SEPARATOR.'libraries'.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'functions.php');
	include_once(PORTAL_PATH.DIRECTORY_SEPARATOR.'libraries'.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'core.php');

	function virgoAutoloader($classWithNamespace) {
		$elements = explode("\\", $classWithNamespace);
		if (count($elements) == 2) {
			$namespace = $elements[0];
			$class = $elements[1];
			if (!file_exists(PORTAL_PATH.DIRECTORY_SEPARATOR.'portlets'.DIRECTORY_SEPARATOR.$namespace.DIRECTORY_SEPARATOR.$class.DIRECTORY_SEPARATOR.'controller.php')) {
				ST();
	    	}
    		include PORTAL_PATH.DIRECTORY_SEPARATOR.'portlets'.DIRECTORY_SEPARATOR.$namespace.DIRECTORY_SEPARATOR.$class.DIRECTORY_SEPARATOR.'controller.php';
    	}
	}
	spl_autoload_register('virgoAutoloader');	

	function getInstanceByName($entity) {
		$entityName = ucfirst($entity);
		$className = VIRGO_PORTAL_INSTANCE."\\virgo" . $entityName;
		require_once(PORTAL_PATH.DIRECTORY_SEPARATOR.'portlets/'.VIRGO_PORTAL_INSTANCE.'/virgo' . $entityName . '/controller.php');
		return new $className;		
	}

    class VirgoAccessLayer {
        public static function callVirgoClassMethod($entityName, $methodName, $id, &$errorMessage) {
            $instance = getInstanceByName($entityName);
            if (is_null($instance)) {
				$errorMessage = "Unable to instantiate entity '$entityName'";
				return;
            }
			switch ($methodName) {
				case "GET":
					if (isset($id) && $id != "") {
						$instance->load($id);
						return $instance;
					} else {
						try {
							return $instance->selectAll('', '', null, null, $errorMessage);
						} catch (Exception $e) {
							$errorMessage = $e->getMessage();
							return;
						}
					}
					break;
				case "POST":
					try {
						return $instance->loadRecordFromRequest();
						$errMsg = $instance->store();
						if ($errMsg == "") {
							return;
						} 
						return $errMsg;
					} catch (Exception $e) {
						$errorMessage = $e->getMessage();
						return;
					}
					break;
			}
        }
    }
?>