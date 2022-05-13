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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form_data = filter_input_array(INPUT_POST);
    $db = getDbInstance();
    $db->where('a_email', $form_data['agent_email']);
    $db->get('agents');

    if ($db->count >= 1) {
        $_SESSION['failure'] = $lang['email_exists'];
    }
    $db = getDbInstance();
    $db->where('business_id', $form_data['business_id_number_agent']);
    $db->get('agents');

    if ($db->count >= 1) {
        $_SESSION['failure'] = $lang['business_id_exists'];
    }
    $db = getDbInstance();
    $db->where('a_username', $form_data['agent_user']);
    $db->get('agents');
    $count = $db->count;

    if ($count > 0) {
        $_SESSION['failure'] = $lang['user_exists'];
    }


    if ($form_data['password'] != $form_data['confirmpassword'])
        $_SESSION['failure'] = "Password Doesn't Match";

    if ($form_data['password'] == $form_data['confirmpassword']) {
        $pass = password_hash($form_data['password'], PASSWORD_DEFAULT);
        $log = array(
            "action_time" => date('Y-m-d H:i:s'),
            "user_name" => get_current_login_username(),
            "user_full_name" => get_current_login_user_full_name(),
            "script_name" => "User",
            "action_type" => "Add"
        );
        $db = getDbInstance();
        $db->insert('logs', $log);
        $db = getDbInstance();

        $business_number = $form_data['mobile3num1'] . $form_data['business_tel'];
        $mobile_number = $form_data['mobile3num2'] . $form_data['mobile'];

        $data = array(
            "c_insertdate" => date('Y-m-d H:i:s'),
            "a_firstname" => $form_data['first_name'],
            "a_lastname" =>  $form_data['last_name'],
            "a_mobile" => $mobile_number,
            "a_email" => $form_data['agent_email'],
            "a_username" => $form_data['agent_user'],
            "a_password" => $pass,
            "business_id" => $form_data['business_id_number_agent'],
            "business_address" => $form_data['business_add'],
            "business_name" => $form_data['business_name'],
            "business_tel" => $business_number,
            "agent_type" => $form_data['agent_type'],
            "user_full_name" => $form_data['first_name'] . " " . $form_data['last_name'],
            "city" => $_POST['city'],
            "description" => $_POST['description'],
            "mailbox" => $_POST['mailbox'],
            "postal_code" => $_POST['postal_code'],
            "house_num" => $_POST['house_num'],
            "street" => $_POST['street'],
        );





        $db->escape($data['business_name']);
        $db->escape($data['business_address']);
        $db->escape($data['a_firstname']);
        $db->escape($data['a_lastname']);

        $last_id = $db->insert('agents', $data);
        $data = array(
            "id_md5" => md5($last_id)
        );
        $db->where('c_id', $last_id)->update('agents', $data);
        if ($last_id) {
            $path = pathUrl(__DIR__ . '/../../');
            redirect($path . 'index.php?sec=agents&action=manageagent');
        }
    }
}
?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $lang['add_new_agent']  ?></h3>


                    </div>
                    <div class="card-body">
                        <?php
                        ?>
                        <form autocomplete="false" class="well form-horizontal" action=" " method="post" id="agentmanage" enctype="multipart/form-data">
                            <?php include_once 'add_agent_form.php'; ?>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
</div>