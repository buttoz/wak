<?php


require_once 'class-settings.php';

header('Access-Control-Allow-Origin: *');

$setting = new Settings();

if(isset($_GET['name'])){
    echo $setting->get_settings_by_name($_GET['name']);
}else{
    echo $setting->get_settings();
}