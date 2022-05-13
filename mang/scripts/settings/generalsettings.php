<?php
use \Gumlet\ImageResize;
$backoofice_path = dirname(__DIR__, 2);
if ($_SESSION['admin_type'] !== 'admin') {
    // show permission denied message
    echo '<div class="permissiondenied">Permission Denied</div>';
    exit();
}

$db = getDbInstance();
$db->where ("setting_name", 'change_language');
$res = $db->getOne("settings");
$changelanguage = $res['setting_value'];

$db = getDbInstance();
$db->where ("setting_name", 'change_ip');
$res = $db->getOne("settings");
$changeip = $res['setting_value'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$form_data = filter_input_array(INPUT_POST);




    if(isset($_FILES["files"]) && !empty($_FILES["files"]["name"])) {
        $target_dir = $backoofice_path . '/<?= DATA_URL ?>/';
        $target_file = $target_dir . basename($_FILES["files"]["name"]);
        $file_name = basename($_FILES["files"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $replace_extension_file_name = str_replace('.' . $imageFileType, "", basename($_FILES["files"]["name"]));
        try {
            $image = new ImageResize($_FILES["files"]["tmp_name"]);
            $image->resizeToWidth(300);
            if(file_exists($target_dir . $file_name )){
                $image->save($target_dir .  $replace_extension_file_name . get_date_time_randomnumber() . '.' . $imageFileType );
                $file_name = $replace_extension_file_name . get_date_time_randomnumber() . '.' . $imageFileType;
            }else{
                $image->save($target_dir .  $file_name);
            }
        } catch (\Gumlet\ImageResizeException $e) {
        }


        $db = getDbInstance();
        $db->where ("setting_name", 'logo');
        $result = $db->getOne("settings");
        if($db->count > 0){
            $db = getDbInstance();
            $data = Array (
                "setting_name" => 'logo',
                "setting_value" => '/<?= DATA_URL ?>/' . $file_name,
            );
            $db->where ('id', $result['id']);
            $db->update ('settings', $data);

        }else{
        $db = getDbInstance();
        $data = Array (
            "setting_name" => 'logo',
            "setting_value" => '/<?= DATA_URL ?>/' . $file_name,
        );

        $last_id = $db->insert ('settings', $data);
        }
    }

    if($form_data['business_name']){
        $db = getDbInstance();
        $db->where ("setting_name", 'business_name');
        $result = $db->getOne("settings");
        if($db->count > 0){
            $db = getDbInstance();
            $data = Array (
                "setting_name" => 'business_name',
                "setting_value" => $form_data['business_name'],
            );
            $db->where ('id', $result['id']);
            $db->update ('settings', $data);

        }else{
        $db = getDbInstance();
        $data = Array (
            "setting_name" => 'business_name',
            "setting_value" => $form_data['business_name'],
        );

        $last_id = $db->insert ('settings', $data);
        }
    }

    if($form_data['business_tel']){
        $db = getDbInstance();
        $db->where ("setting_name", 'business_tel');
        $result = $db->getOne("settings");
        if($db->count > 0){
            $db = getDbInstance();
            $data = Array (
                "setting_name" => 'business_tel',
                "setting_value" => $form_data['business_tel'],
            );
            $db->where ('id', $result['id']);
            $db->update ('settings', $data);
        }else{
        $db = getDbInstance();
        $data = Array (
            "setting_name" => 'business_tel',
            "setting_value" => $form_data['business_tel'],
        );
        $last_id = $db->insert ('settings', $data);
        }
    }


    if($form_data['cdo']){
        $db = getDbInstance();
        $db->where ("setting_name", 'category_design_option');
        $result = $db->getOne("settings");
        if($db->count > 0){
            $db = getDbInstance();
            $data = Array (
                "setting_name" => 'category_design_option',
                "setting_value" => $form_data['cdo'],
            );
            $db->where ('id', $result['id']);
            $db->update ('settings', $data);
        }else{
        $db = getDbInstance();
        $data = Array (
            "setting_name" => 'category_design_option',
            "setting_value" => $form_data['cdo'],
        );
        $last_id = $db->insert ('settings', $data);
        }
    }
    if($form_data['scdo']){
        $db = getDbInstance();
        $db->where ("setting_name", 'sub_category_design_option');
        $result = $db->getOne("settings");
        if($db->count > 0){
            $db = getDbInstance();
            $data = Array (
                "setting_name" => 'sub_category_design_option',
                "setting_value" => $form_data['scdo'],
            );
            $db->where ('id', $result['id']);
            $db->update ('settings', $data);
        }else{
        $db = getDbInstance();
        $data = Array (
            "setting_name" => 'sub_category_design_option',
            "setting_value" => $form_data['scdo'],
        );
        $last_id = $db->insert ('settings', $data);
        }
    }
    if($form_data['pdo']){
        $db = getDbInstance();
        $db->where ("setting_name", 'product_design_option');
        $result = $db->getOne("settings");
        if($db->count > 0){
            $db = getDbInstance();
            $data = Array (
                "setting_name" => 'product_design_option',
                "setting_value" => $form_data['pdo'],
            );
            $db->where ('id', $result['id']);
            $db->update ('settings', $data);
        }else{
        $db = getDbInstance();
        $data = Array (
            "setting_name" => 'product_design_option',
            "setting_value" => $form_data['pdo'],
        );
        $last_id = $db->insert ('settings', $data);
        }
    }
    if($form_data['small_image_size']){
        $db = getDbInstance();
        $db->where ("setting_name", 'small_image_size');
        $result = $db->getOne("settings");
        if($db->count > 0){
            $db = getDbInstance();
            $data = Array (
                "setting_name" => 'small_image_size',
                "setting_value" => $form_data['small_image_size'],
            );
            $db->where ('id', $result['id']);
            $db->update ('settings', $data);

        }else{
        $db = getDbInstance();
        $data = Array (
            "setting_name" => 'small_image_size',
            "setting_value" => $form_data['small_image_size'],
        );
        $last_id = $db->insert ('settings', $data);
        }
    }
    if($form_data['large_image_size']){
        $db = getDbInstance();
        $db->where ("setting_name", 'large_image_size');
        $result = $db->getOne("settings");
        if($db->count > 0){
            $db = getDbInstance();
            $data = Array (
                "setting_name" => 'large_image_size',
                "setting_value" => $form_data['large_image_size'],
            );
            $db->where ('id', $result['id']);
            $db->update ('settings', $data);

        }else{
        $db = getDbInstance();
        $data = Array (
            "setting_name" => 'large_image_size',
            "setting_value" => $form_data['large_image_size'],
        );
        $last_id = $db->insert ('settings', $data);
        }
    }
    if($form_data['showrows']){
        $db = getDbInstance();
        $db->where ("setting_name", 'showrows');
        $result = $db->getOne("settings");
        if($db->count > 0){
            $db = getDbInstance();
            $data = Array (
                "setting_name" => 'showrows',
                "setting_value" => $form_data['showrows'],
            );
            $db->where ('id', $result['id']);
            $db->update ('settings', $data);

        }else{
        $db = getDbInstance();
        $data = Array (
            "setting_name" => 'showrows',
            "setting_value" => $form_data['showrows'],
        );
        $last_id = $db->insert ('settings', $data);
        }
    }
    if($form_data['language']){
        $db = getDbInstance();
        $db->where ("setting_name", 'default_language');
        $result = $db->getOne("settings");
        if($db->count > 0){
            $db = getDbInstance();
            $data = Array (
                "setting_name" => 'default_language',
                "setting_value" => $form_data['language'],
            );
            $db->where ('id', $result['id']);
            $db->update ('settings', $data);

            $path = pathUrl(__DIR__ . '/../../');
            redirect($path . 'index.php?sec=settings&action=generalsettings');
        }else{
        $db = getDbInstance();
        $data = Array (
            "setting_name" => 'default_language',
            "setting_value" => $form_data['language'],
        );
        $last_id = $db->insert ('settings', $data);
        }
    }




}

?>
<div class="content-wrapper" >
    <section class="content">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $lang['general_settings']?></h3>


                    </div>
                    <div class="card-body">
                        <form autocomplete="false" class="well form-horizontal" action="" method="post"  id="generalsettings" enctype="multipart/form-data">
                            <?php include_once 'general_settings_form.php'; ?>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
</div>
