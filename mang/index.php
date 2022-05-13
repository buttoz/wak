<?php
session_start();
require_once './config/db/config.php';
require_once './inc/auth_validate.php';
require_once './inc/helpers.php';

//var_dump(preg_match('/\bindex\b/', CURRENT_PAGE));
$db = getDbInstance();
$db->where("id", $_SESSION['client_id']);
$user = $db->getOne("users");
if ($user) {
    $first_name = $user['u_firstname'];
    $last_name = $user['u_lastname'];
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
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'users' && $_GET['action'] == 'adduser') {
    include './scripts/users/adduser.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'users' && $_GET['action'] == 'manageuser') {
    include './scripts/users/manageuser.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'users' && $_GET['action'] == 'updateuser') {
    include './scripts/users/updateuser.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'settings' && $_GET['action'] == 'generalsettings') {
    include './scripts/settings/generalsettings.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'logs' && $_GET['action'] == 'view') {
    include './scripts/logs/logs.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'about' && $_GET['action'] == 'viewabout') {
    include './scripts/about/about.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'ipban' && $_GET['action'] == 'manageip') {
    include './scripts/ip/ipblock.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'ipban' && $_GET['action'] == 'addip') {
    include './scripts/ip/addip.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'ipban' && $_GET['action'] == 'updateip') {
    include './scripts/ip/updateip.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'agents' && $_GET['action'] == 'addagent') {
    include './scripts/agents/addagent.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'agents' && $_GET['action'] == 'manageagent') {
    include './scripts/agents/manageagent.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'agents' && $_GET['action'] == 'updateagent') {
    include './scripts/agents/updateagent.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'system_tables' && $_GET['action'] == 'system_tables') {
    include './scripts/system_tables/system_tables.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'agents' && $_GET['action'] == 'agentplus') {
    include './scripts/agents/agentplus.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'garage' && $_GET['action'] == 'garageplus') {
    include './scripts/garage/garageplus.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'permission' && $_GET['action'] == 'permissionmange') {
    include './scripts/permission/permissionmange.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'permission' && $_GET['action'] == 'permission_profile_add') {
    include './scripts/permission/permission_profile_add.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'users' && $_GET['action'] == 'user_plus') {
    include './scripts/users/user_plus.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'deparments' && $_GET['action'] == 'deparmentsmng') {
    include './scripts/deparments/deparmentsmng.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'subs' && $_GET['action'] == 'managesubs') {
    include './scripts/subs/managesubs.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'marketers' && $_GET['action'] == 'managemarketers') {
    include './scripts/marketers/managemarketers.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'marketers' && $_GET['action'] == 'addmarketer') {
    include './scripts/marketers/addmarketer.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'marketers' && $_GET['action'] == 'marketerplus') {
    include './scripts/marketers/marketerplus.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'suppliers' && $_GET['action'] == 'managesuppliers') {
    include './scripts/suppliers/managesuppliers.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'suppliers' && $_GET['action'] == 'addsupplier') {
    include './scripts/suppliers/addsupplier.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'suppliers' && $_GET['action'] == 'suppliersplus') {
    include './scripts/suppliers/suppliersplus.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'prodandprice' && $_GET['action'] == 'manageprodandprice') {
    include './scripts/prodandprice/manageprodandprice.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'prodandprice' && $_GET['action'] == 'importprod') {
    include './scripts/prodandprice/importprod.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'subs' && $_GET['action'] == 'managesubs') {
    include './scripts/subs/managesubs.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'subs' && $_GET['action'] == 'addsub') {
    include './scripts/subs/addsub.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'subs' && $_GET['action'] == 'searchlist') {
    include './scripts/subs/searchlist.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'subs' && $_GET['action'] == 'updatesub') {
    include './scripts/subs/updatesub.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'subs' && $_GET['action'] == 'addsubsection') {
    include './scripts/subs/addsubsection.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'pay' && $_GET['action'] == 'pay') {
    include './scripts/pay/pay.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'customers' && $_GET['action'] == 'customerinfo') {
    include './scripts/customers/customerinfo.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'health' && $_GET['action'] == 'managehealth') {
    include './scripts/health/managehealth.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'health' && $_GET['action'] == 'addhealthsection') {
    include './scripts/health/addhealthsection.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'health' && $_GET['action'] == 'addhealth') {
    include './scripts/health/addhealth.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'health' && $_GET['action'] == 'updatehealth') {
    include './scripts/health/updatehealth.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'settings' && $_GET['action'] == 'settingsplus') {
    include './scripts/settings/settingsplus.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'subs' && $_GET['action'] == 'renewsub') {
    include './scripts/subs/renewsub.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'acounting' && $_GET['action'] == 'agent_acc') {
    include './scripts/acounting/agent_acc.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'acounting' && $_GET['action'] == 'marketer_acc') {
    include './scripts/acounting/marketer_acc.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'acounting' && $_GET['action'] == 'supplier_acc') {
    include './scripts/acounting/supplier_acc.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'excel' && $_GET['action'] == 'dailyreports') {
    include './scripts/excel/dailyreports.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'excel' && $_GET['action'] == 'monthlyreports') {
    include './scripts/excel/monthlyreports.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'agents' && $_GET['action'] == 'import_cust') {
    include './scripts/agents/import_cust.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'about' && $_GET['action'] == 'about') {
    include './scripts/about/about.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'dashboard' && $_GET['action'] == 'onlineusers') {
    include './scripts/dashboard/onlineusers.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'settings' && $_GET['action'] == 'mangclients') {
    include './scripts/settings/mangclients.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'settings' && $_GET['action'] == 'addclient') {
    include './scripts/settings/addclient.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'settings' && $_GET['action'] == 'client_plus') {
    include './scripts/settings/client_plus.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'subs' && $_GET['action'] == 'managecanclled') {
    include './scripts/subs/managecanclled.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'agents' && $_GET['action'] == 'system_build') {
    include './scripts/agents/system_build.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'dashboard' && $_GET['action'] == 'itemstoreport') {
    include './scripts/dashboard/itemstoreport.php';
} elseif (isset($_GET['sec']) && isset($_GET['action']) && $_GET['sec'] == 'dashboard' && $_GET['action'] == 'itemsneededserv') {
    include './scripts/dashboard/itemsneededserv.php';
}

include_once('./inc/footer.php');
