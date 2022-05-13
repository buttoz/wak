<?php



if(!isset($_SESSION['lang']))
{
    $db = getDbInstance();
    $db->where ("setting_name", 'default_language');
    $res = $db->getOne("settings");
    $defaultlanguage = $res['setting_value'];
    if($defaultlanguage == 1){
        $_SESSION['lang'] = 'en';
    }elseif ($defaultlanguage == 2){
        $_SESSION['lang'] = 'ar';
    }
    elseif ($defaultlanguage == 3){
        $_SESSION['lang'] = 'he';
    }
}
else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])){
    if($_GET['lang'] == 'en'){
        $_SESSION['lang'] = 'en';
    }
    else if ($_GET['lang'] == 'ar') {
        $_SESSION['lang'] = 'ar';
    }
    else if ($_GET['lang'] == 'he') {
        $_SESSION['lang'] = 'he';
    }
}
require_once $_SESSION['lang']. '.lang.php';


