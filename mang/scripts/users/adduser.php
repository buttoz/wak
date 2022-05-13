<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<?php

$backoofice_path = dirname(__DIR__, 2);

if ($_SESSION['admin_type'] !== 'admin') {
    // show permission denied message
    echo '<div class="permissiondenied">Permission Denied</div>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form_data = filter_input_array(INPUT_POST);
    $db = getDbInstance();
    $db->where('u_email',$form_data['user_email']);
    $db->get('users');

    if($db->count >=1){
        $_SESSION['failure'] = $lang['email_exists'];
    }
    $db = getDbInstance();
    $db->where('u_username',$form_data['user_name']);
    $db->get('users');

    if($db->count >=1){
        $_SESSION['failure'] = $lang['user_exists'];
    }


    if($form_data['password'] != $form_data['confirmpassword'])
        $_SESSION['failure'] = "Password Doesn't Match";

    if($form_data['password'] == $form_data['confirmpassword']){
        $pass = password_hash($form_data['password'],PASSWORD_DEFAULT);
        $log = Array(
            "action_time"=> date('Y-m-d H:i:s'),
            "user_name" => get_current_login_username(),
            "user_full_name" => get_current_login_user_full_name(),
            "script_name" => "User",
            "action_type" => "Add"
        );
        $db = getDbInstance();
        $db->insert ('logs', $log);
        $db = getDbInstance();

        $data = Array (
            "createdtime" => date('Y-m-d H:i:s'),
            "lastupdatime" => date('Y-m-d H:i:s'),
            "lastupdate_ip" => getuserip(),
            "u_userrole" => $form_data['admin_type'],
            "u_firstname" => $form_data['first_name'],
            "u_lastname" =>  $form_data['last_name'],
            "u_idnumber" => $form_data['user_id'],
            "u_mobile" => $form_data['mobile'],
            "u_email" => $form_data['user_email'],
            "u_username" => $form_data['user_name'],
            "password" => $pass,
            "u_lastlogin" => '0000-00-00 00:00:00',
            "series_id" => null,
            "remember_token" => null,
            "expires" => null,
            "status"=> 0,
            "user_full_name"=> get_current_login_user_full_name()
        );
        $last_id = $db->insert ('users', $data);

        if($last_id)
        {
            $_SESSION['success'] = "Admin user added successfully!";
            $path = pathUrl(__DIR__ . '/../../');
            redirect($path . 'index.php?sec=users&action=manageuser');
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
                        <h3 class="card-title"><?php echo $lang['add_new_user']?></h3>


                    </div>
                    <div class="card-body">
                        <?php
                        ?>
                        <form autocomplete="false" class="well form-horizontal" action=" " method="post"  id="usermanage" enctype="multipart/form-data">
                            <?php include_once 'add_admin_form.php'; ?>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
</div>
