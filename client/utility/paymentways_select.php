<?php
require_once '../config/db/config.php';

use \Gumlet\ImageResize;

$db = getDbInstance();
session_start();
if ($_POST) {

    if ($_POST['new_del_code']) {
        $db = getDbInstance();

        $data = array(
            "setting_value" => $_POST['new_del_code']
        );
        $newdata = array(
            "setting_name" => 'del_code',
            "setting_value" => $_POST['new_del_code']
        );
        $db->where('setting_name', 'del_code');
        $row = $db->getOne('settings');
        if ($db->count > 0) {
            $ser = $db->where('setting_name', 'del_code')->update('settings', $data);
        } else {
            $db->insert('settings', $newdata);
        }
        if ($ser) {
            echo 1;
        } else {
            echo 0;
        }
    }



    if ($_FILES['logo']) {
        $backoofice_path = dirname(__DIR__, 2);

        $target_dir = DATA_PATH . '/logo/';
        $target_file = $target_dir . basename($_FILES['logo']["name"]);
        $file_name = get_date_time_randomnumber();
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $replace_extension_file_name = str_replace('.' . $imageFileType, "", basename($_FILES['logo']["name"]));
        if ($_FILES['logo']["tmp_name"]) {
            move_uploaded_file($_FILES['logo']["tmp_name"], $target_dir .  $file_name . "." . $imageFileType);
            $_FILES['logo']['name'] = $file_name . "." . $imageFileType;
        }
        if ($_FILES['logo']['name']) {
            $db = getDbInstance();

            $data = array(
                "setting_value" => $_FILES['logo']['name']
            );
            $newdata = array(
                "setting_name" => "companylogo",
                "setting_value" => $_FILES['logo']['name']
            );
            $db->where('setting_name', 'companylogo');
            $row = $db->getOne('settings');
            if ($db->count > 0) {
                $ser = $db->where('setting_name', 'companylogo')->update('settings', $data);
            } else {
                $db->insert('settings', $newdata);
            }
            if ($ser) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }
    if ($_FILES['favicon']) {
        $backoofice_path = dirname(__DIR__, 2);

        $target_dir = DATA_PATH . '/favicon/';
        $target_file = $target_dir . basename($_FILES['favicon']["name"]);
        $file_name = get_date_time_randomnumber(); //basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $replace_extension_file_name = str_replace('.' . $imageFileType, "", basename($_FILES['favicon']["name"]));
        if ($_FILES['favicon']["tmp_name"]) {
            move_uploaded_file($_FILES['favicon']["tmp_name"], $target_dir .  $file_name . "." . $imageFileType);
            $_FILES['favicon']['name'] = $file_name . "." . $imageFileType;
        }
        if ($_FILES['favicon']['name']) {
            $db = getDbInstance();

            $data = array(
                "setting_value" => $_FILES['favicon']['name']
            );
            $newdata = array(
                "setting_name" => "favicon",
                "setting_value" => $_FILES['favicon']['name']
            );
            $db->where('setting_name', 'favicon');
            $row = $db->getOne('settings');
            if ($db->count > 0) {
                $ser = $db->where('setting_name', 'favicon')->update('settings', $data);
            } else {
                $db->insert('settings', $newdata);
            }
            if ($ser) {
                echo 3;
            } else {
                echo 0;
            }
        }
    }
}
