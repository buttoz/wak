<?php
require_once './languages/he.lang.php';
require_once './config/db/config.php';
require_once './api/sms/sms.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form_data = filter_input_array(INPUT_POST);
    $db = getDbInstance();
    $numbers = $db->where("import_id", $form_data['group_numbers'])->get('import_customers');
    foreach ($numbers as $row) {
        send_sms($form_data['msg_content'], $row['number']);
    }
    $data = array(
        "c_insertdate" => date("Y-m-d H:i:s"),
        'import_id' => $form_data['group_numbers'],
        'number_of_msgs' => $db->count,
        'client_id' => $_SESSION['client_id'],
        'description' => $form_data['msg_content'],
    );
    $db->insert("group_msg_history", $data);

    $path = pathUrl(__DIR__ . '/../../');
    redirect($path . 'index.php?sec=msg&action=group_msg');
}

?>
<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div class="col-md-4">
                <h2>שליחה לקבוצה</h2>
                <br>
                <div class="outer-container">
                    <form action="" method="post" name="send_group_msg" id="send_group_msg" enctype="multipart/form-data">
                        <div>
                            <div class="form-group">
                                <label>בחר קבוצה</label>
                                <select name="group_numbers" id="group_numbers" class="form-control">
                                    <option value="">בחר קבוצה</option>
                                    <?
                                    $db = getDbInstance();
                                    $history = $db->get("import_history");
                                    foreach ($history as $row) {
                                    ?>
                                        <option value="<?= $row['c_id'] ?>"><?= $row['description'] ?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <textarea name="msg_content" class="form-control" id="msg_content" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="<?= $lang['send'] ?>">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?= $lang['history'] ?></div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><?= $lang['id'] ?></th>
                                    <th><?= $lang['date'] ?></th>
                                    <th><?= $lang['description'] ?></th>
                                    <th>שם קבוצה</th>
                                    <th><?= $lang['user_name'] ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                $db = getDbInstance();
                                $history = $db->get('group_msg_history');
                                foreach ($history as $row) {
                                    $user = $db->where('c_id', $row['client_id'])->getOne('agents');
                                    $import = $db->where('c_id', $row['import_id'])->getOne('import_history');
                                ?>
                                    <tr>
                                        <td><?= $row['c_id'] ?></td>
                                        <td><?= $row['c_insertdate'] ?></td>
                                        <td><?= $row['description'] ?></td>
                                        <td><?= $import['description'] ?></td>
                                        <td><?= $user['a_firstname'] . " " . $user['a_lastname'] ?></td>
                                    </tr>
                                <?
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>