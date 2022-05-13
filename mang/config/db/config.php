<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
define('BASE_PATH', dirname(dirname(__FILE__)));
define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));
date_default_timezone_set('Asia/Jerusalem');


require_once BASE_PATH . '../../../vendor/autoload.php';
require_once BASE_PATH . '../../inc/MysqliDb.php';
require_once BASE_PATH . '../../inc/helpers.php';

$rootpath = dirname(__DIR__, 3);
$dotenv = Dotenv\Dotenv::createImmutable($rootpath);
$dotenv->load();


/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION
|--------------------------------------------------------------------------
 */

define('DB_HOST', $_ENV['DB_HOST']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_NAME', $_ENV['DB_NAME']);



// $db = getDbInstance();
// $client = $db->where('url', $_SERVER['SERVER_NAME'])->getOne('clients');
// if ($db->count > 0) {
// 	define('DATA_PATH', $_ENV['DATA_PATH'] . "/" . $client['datafolder']);
// 	define('DATA_URL', $_ENV['DATA_URL'] . "/" . $client['datafolder']);
// }


define('DATA_FOLDER', '');
define('DATA_SYSTEM_URL', $_ENV['DATA_SYSTEM_URL']);
$db = getDbInstance();
$client = $db->where('url', $_SERVER['SERVER_NAME'])->getOne('clients');


define('DATA_PATH', $_ENV['DATA_PATH']);
define('DATA_URL', $_ENV['DATA_URL']);

define('DATE_FOLDER', date("Y") . "/" . date("m") . "/");



/**
 * Get instance of DB object
 */
function getDbInstance()
{
	return new MysqliDb(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
}
