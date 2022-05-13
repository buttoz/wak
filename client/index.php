<?php
session_start();
require_once './config/db/config.php';
require_once './inc/auth_validate.php';
require_once './inc/helpers.php';

//var_dump(preg_match('/\bindex\b/', CURRENT_PAGE));
$db = getDbInstance();
$db->where("c_id", $_SESSION['client_id']);
$user = $db->getOne("agents");
if ($user) {
    $first_name = $user['a_firstname'];
    $last_name = $user['a_lastname'];
}
$backofficedir = pathUrl(__DIR__ . '/');

$uri =  $_SERVER['REQUEST_URI'];

$index_path = $backofficedir . 'index.php';

$currentpagesplit = explode('/', $uri);

$db = getDbInstance();
$db->where("setting_name", 'change_language');
$res = $db->getOne("settings");
$changelanguage = $res['setting_value'];


$db = getDbInstance();
$db->where("setting_name", 'small_image_size');
$res = $db->getOne("settings");
$small_image_size = $res['setting_value'];

$db = getDbInstance();
$db->where("setting_name", 'large_image_size');
$res = $db->getOne("settings");
$large_image_size = $res['setting_value'];

define("SMALL_IMAGE_SIZE", $small_image_size);
define("LARGE_IMAGE_SIZE", $large_image_size);


include('./languages/lang_config.php');

include_once('./inc/header.php');


if (empty($_GET) || !isset($_GET['sec']) || !isset($_GET['action'])) {
    include './scripts/dashboard/dashboard.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'msg' && $_GET['action'] == 'one_msg') {
    include './scripts/msg/one_msg.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'msg' && $_GET['action'] == 'group_msg') {
    include './scripts/msg/group_msg.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'msg' && $_GET['action'] == 'import_customers') {
    include './scripts/msg/import_customers.php';
}

include_once('./inc/footer.php');
