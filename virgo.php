<?php
	error_reporting(E_ERROR);
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
		$className = "event\\virgo" . $entityName;
		require_once(PORTAL_PATH.DIRECTORY_SEPARATOR.'portlets/event/virgo' . $entityName . '/controller.php');
		return new $className;		
	}

    class VirgoAccessLayer {
        public static function callVirgoClassMethod($entityName, $methodName, &$errorMessage) {
            $instance = getInstanceByName($entityName);
            if (is_null($instance)) {

            } 
            return 1;
        }
    }

/****************** Unit tests ***********************/
    if ($_GET["ut"] == "y") {
        $error = "";
        $ret = getInstanceByName("", "", $error);
        echo "<div>" . $error . "</div>";
    }
?>