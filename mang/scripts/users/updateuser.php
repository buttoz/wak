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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = getDbInstance();
    $db->where('id', $id);
    $user = $db->getOne('users');
} else {
    echo '<div class="permissiondenied">Permission Denied</div>';
    exit();
}

if (array_key_exists('user_name',$_POST)) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $form_data = filter_input_array(INPUT_POST);



        if (isset($form_data['active_inactive'])) {
            $stat = 0;
        } else {
            $stat = 1;
        }
        if (empty($form_data['password'])) {
            $pass = $user['password'];
        } else {
            $pass = password_hash($form_data['password'], PASSWORD_DEFAULT);
        }
        $data = array(
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
            "status" => $stat,
        );
        $log = array(
            "action_time" => date('Y-m-d H:i:s'),
            "user_name" => get_current_login_username(),
            "user_full_name" => get_current_login_user_full_name(),
            "script_name" => "User",
            "action_type" => "Update"
        );



        $db = getDbInstance();
        $db->insert('logs', $log);
        $db = getDbInstance();
        $db->where('id', $id);
        if ($db->update('users', $data)) {
            $_SESSION['success'] = "User updated successfully!";
            $path = pathUrl(__DIR__ . '/../../');
            redirect($path . 'index.php?sec=users&action=manageuser');
        } else {
            echo 'update failed: ' . $db->getLastError();
        }
    }
}
?>


<div class="row">
    <div class="col-md-12">

        <?php
        ?>
        <form autocomplete="false" class="well form-horizontal" action=" " method="post" id="updateuser" name="updateuser" enctype="multipart/form-data">
            <?php include_once 'update_admin_form.php'; ?>
        </form>


        <!-- /.card -->
    </div>


</div>