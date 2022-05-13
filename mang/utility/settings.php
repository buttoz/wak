<?php
require_once '../config/db/config.php';

$backoofice_path = pathUrl(__DIR__ . '/../');

$db = getDbInstance();
$db->where ("setting_name", 'business_name');
$res = $db->getOne("settings");
$business_name = $res['setting_value'];

$db = getDbInstance();
$db->where ("setting_name", 'business_tel');
$res = $db->getOne("settings");
$business_tel = $res['setting_value'];

$db = getDbInstance();
$db->where ("setting_name", 'category_design_option');
$res = $db->getOne("settings");
$category_option = $res['setting_value'];

$db = getDbInstance();
$db->where ("setting_name", 'sub_category_design_option');
$res = $db->getOne("settings");
$subcategory_option = $res['setting_value'];

$db = getDbInstance();
$db->where ("setting_name", 'product_design_option');
$res = $db->getOne("settings");
$product_option = $res['setting_value'];

$db = getDbInstance();
$db->where ("setting_name", 'companylogo');
$res = $db->getOne("settings");
$logo = $res['setting_value'];

$db = getDbInstance();
$db->where ("setting_name", 'default_language');
$res = $db->getOne("settings");
$defaultlanguage = $res['setting_value'];

$db = getDbInstance();
$db->where ("setting_name", 'change_language');
$res = $db->getOne("settings");
$changelanguage = $res['setting_value'];

$db = getDbInstance();
$db->where ("setting_name", 'small_image_size');
$res = $db->getOne("settings");
$small_image_size = $res['setting_value'];

$db = getDbInstance();
$db->where ("setting_name", 'large_image_size');
$res = $db->getOne("settings");
$large_image_size = $res['setting_value'];

$db = getDbInstance();
$db->where ("setting_name", 'showrows');
$res = $db->getOne("settings");
$showrows = $res['setting_value'];

$data = array(
    'businessname' => $business_name,
    'business_tel' => $business_tel,
    'subcategory_option' => $subcategory_option,
    'category_option' => $category_option,
    'product_option' => $product_option,
    'logo' => $backoofice_path . $logo,
    'defaultlanguage' => $defaultlanguage,
    'changelanguage' => $changelanguage,
    'smallimagesize' => $small_image_size,
    'largeimagesize' => $large_image_size,
    'showrows' => $showrows,

);

echo json_encode($data);



