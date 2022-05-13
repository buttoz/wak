
<?php


$db = getDbInstance();

$users = $db->get('users');

$backofficedir = pathUrl(__DIR__ . '/../../');
$index_path = $backofficedir . 'index.php';


?>

<div class="content-wrapper" >

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class=" col-md-2 p-2">
                                <a class="btn btn-block btn-success" href="<?php echo $index_path . '?sec=users&action=adduser' ?>">+ <?php echo $lang['add_new_user']?></a>
                            </div>
                        <table id="example1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th><?php echo $lang['full_name']?></th>
                                <th><?php echo $lang['username']?></th>
                                <th><?php echo $lang['phone']?></th>
                                <th><?php echo $lang['email']?></th>
                                <th><?php echo $lang['last_login']?></th>
                                <th><?php echo $lang['role']?></th>
                                <th><?php echo $lang['status']?></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($users as $user){
                                    $date=date_create($user['u_lastlogin']);

                                    ?>

                                    <tr <?php echo $user['status'] == 1 ? 'style="color:#ff0000;font-weight:bold"' : "" ?> onclick="window.location='<?php echo $index_path . '?sec=users&action=user_plus&id=' . $user['id'] ?>'">
                                        <td>
                                            <?php echo $user['u_firstname'] . ' ' . $user['u_lastname']?>
                                        </td>
                                        <td>
                                            <?php echo $user['u_username']?>
                                        </td>
                                        <td>
                                            <?php echo $user['u_mobile'] ?>
                                        </td>
                                        <td>
                                            <?php echo $user['u_email'] ?>
                                        </td>
                                        <td class="datetime">
                                            <?php echo $user['u_lastlogin'] == '0000-00-00 00:00:00' ? '0000-00-00 00:00:00' : date_format($date,"Y/m/d H:i"); ?>
                                        </td>

                                        <td>
                                            <?php echo $user['u_userrole'] ?>
                                        </td>
                                        <td>
                                        <?php echo $user['status'] == 0 ? $lang['active'] : $lang['inactive'] ?>
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

