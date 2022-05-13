<?

if (isset($_POST['dept_add']))
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $form_data = filter_input_array(INPUT_POST);

        $id = $_GET['id'];

        $db = getDbInstance();

        $db->where('user_id', $id)->delete('deparment_user');

        $db = getDbInstance();
        $depts = $db->get('deparment_define');

        foreach ($depts as $dept)
            if (isset($form_data[$dept['id']])) {
                $deptdata = array(
                    "createdtime" => date('Y-m-d H:i:s'),
                    "lastupdate_ip" => getuserip(),
                    "user_id" => $id,
                    "deptid" =>  $dept['id'],
                );
                $db->insert('deparment_user', $deptdata);
            }
    }


?>
<div style="padding-top: 2em;">
    <form id="deparment_list" name="deparment_list" action="index.php?sec=users&action=user_plus&id=<? echo $_GET['id'] ?>" method="POST">
        <?php include_once 'deparments_form.php'; ?>
    </form>
</div>