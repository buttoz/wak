<?

if (isset($_POST['btn_add']))
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $form_data = filter_input_array(INPUT_POST);

        $id = $_GET['id'];

        $db = getDbInstance();

        $db->where('user_id', $id)->delete('permission_user');

        $db = getDbInstance();
        $permissions = $db->get('permission_define');

        foreach ($permissions as $permission)

            if (isset($form_data[$permission['id']])) {
                $permissiondata = array(
                    "createdtime" => date('Y-m-d H:i:s'),
                    "lastupdate_ip" => getuserip(),
                    "user_id" => $id,
                    "permissionid" =>  $permission['id'],
                );
                $db->insert('permission_user', $permissiondata);
            }
        $profile_list = $form_data['profile_list'];
        $db->rawQuery("UPDATE `users` SET `profile_id` = $profile_list WHERE `id` = $id");
    }


?>
<form id="profile_list" name="profile_list" action="index.php?sec=users&action=user_plus&id=<? echo $_GET['id'] ?>" method="POST">
    <?php  include_once 'permission_edit_form.php'; ?>
</form>