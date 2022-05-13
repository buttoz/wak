<?php

require_once '../../config/db/config.php';

class Settings {

    public function get_settings(){
        $db = getDbInstance();
        $settings = $db->get('settings');

        if($settings){
            return json_encode($settings);
        }else{
            // set response code - 404 Not found
            http_response_code(404);

            // tell the user no category found
            return json_encode(
                array("message" => "No setting found.")
            );
        }

    }

    public function get_settings_by_name($name){
        $db = getDbInstance();
        $db->where('setting_name', $name);
        $settingArray = $db->get('settings');

        if($settingArray){
            return json_encode($settingArray[0]);
        }else{
            // set response code - 404 Not found
            http_response_code(404);

            // tell the user no category found
            return json_encode(
                array("message" => "No setting found.")
            );
        }

    }



}

?>