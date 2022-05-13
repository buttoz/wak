<?php

// if (!have_permission('agent_list')) {
//     // show permission denied message
//     echo '<div class="permissiondenied">Permission Denied</div>';
//     exit();
// }

$db = getDbInstance();



$backofficedir = pathUrl(__DIR__ . '/../../');
$index_path = $backofficedir . 'index.php';


?>

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-md-2 p-2">
                                <a class="btn btn-block btn-success" href="<?php echo $index_path . '?sec=agents&action=addagent' ?>">+ <?php echo $lang['add_new_agent'] ?></a>
                            </div>
                            <br>
                            <table id="contractor" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><?php echo $lang['id'] ?></th>
                                        <th><?php echo $lang['business_id_number'] ?></th>
                                        <th><?php echo $lang['business_name'] ?></th>
                                        <th><?php echo $lang['username'] ?></th>
                                        <th><?php echo $lang['email'] ?></th>
                                        <th><?php echo $lang['full_name'] ?></th>
                                        <th><?php echo $lang['phone'] ?></th>
                                        <th><?php echo $lang['account_confirmation'] ?></th>
                                        <th><?php echo $lang['status'] ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $users = $db->get('agents');

                                    foreach ($users as $row) {
                                    ?>
                                        <tr <?php echo $row['c_status'] == 2 ? 'style="color:#ff0000;font-weight:bold"' : "" ?> onclick="window.location='<?php echo $index_path . '?sec=agents&action=agentplus&id=' . $row['c_id'] ?>'">
                                            <td>
                                                <?php echo $row['c_id'] ?>
                                            </td>
                                            <td><?php echo $row['business_id'] ?></td>
                                            <td>
                                                <?php echo $row['business_name'] ?>
                                            </td>
                                            <td><?php echo $row['a_username'] ?></td>
                                            <td><?php echo $row['a_email'] ?></td>
                                            <td><?php echo $row['a_firstname'] . " " . $row['a_lastname'] ?></td>
                                            <td>
                                                <?php echo $row['a_mobile'] ?>
                                            </td>
                                            <? $db->where('id_agent', $row['c_id'])->getOne('agent_checks'); ?>
                                            <td> <?= $db->count > 0 ? $lang['yes1'] : '<p style="color:red;font-weight:bold;">' . $lang['no1'] . "</p>" ?> </td>
                                            <td class="datetime">
                                                <?php //echo $row['a_lastlogin'] == '0000-00-00 00:00:00' ? '0000-00-00 00:00:00' : date_format($date,"Y/m/d H:i");
                                                echo $row['c_status'] == 0 ? $lang['active'] : ($row['c_status'] == 1 ? $lang['awaiting_inactive'] : ($row['c_status'] == 2 ? $lang['inactive'] : ''));
                                                ?>
                                            </td>
                                        </tr>
                                    <?php

                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>