<?php
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_http_input('UTF-8');
mb_language('uni');
mb_regex_encoding('UTF-8');
ob_start('mb_output_handler');

require_once('helpers/utility.php');
// require_once('helpers/router.php');
require_once('config/config.php');
require_once('controllers/controller.php');
require_once('config/routes.php');



function __autoload($className) {
	$className = ltrim($className, '\\');
	$fileName  = '';
	$namespace = '';
	if ($lastNsPos = strripos($className, '\\')) {
		$namespace = substr($className, 0, $lastNsPos);
		$className = substr($className, $lastNsPos + 1);
		$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}
	$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
	if (file_exists($fileName.".php")) {

	    require $fileName;
	    return;
	}
	
	if (file_exists(SITE_PATH."/models/".$className.".php")) {
		require_once(SITE_PATH."/models/".$className.".php");
		return;
	} elseif (file_exists(SITE_PATH."/helpers/".$className.".php")) {
		require_once(SITE_PATH."/helpers/".$className.".php");
		return;
	}
	throw new Exception("Cannot find class '$className'");

}

/*
function __autoload($class) {
echo '* '.$class.'<br />';
	if (file_exists(SITE_PATH."/models/".$class.".php")) {
		require_once(SITE_PATH."/models/".$class.".php");
		return;
	} elseif (file_exists(SITE_PATH."/helpers/".$class.".php")) {
		require_once(SITE_PATH."/helpers/".$class.".php");
		return;
	}
	throw new Exception("Cannot find class '$class'");
}
*/

session_start();

