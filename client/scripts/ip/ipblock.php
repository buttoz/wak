<?php

$backoofice_path = dirname(__DIR__, 2);

$db = getDbInstance();
$ipban = $db->get('ipban');
$backofficedir = pathUrl(__DIR__ . '/../../');
$index_path = $backofficedir . 'index.php';

$db = getDbInstance();
$db->where ("setting_name", 'change_ip');
$res = $db->getOne("settings");
$changeip = $res['setting_value'];

?>
<style>
    label.btn.btn-danger.toggle-off {
        font-size: 15px;
    }
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                           <div class="ipbanbuttons" style="display: flex;justify-content: space-between;">
                               <div class="">
                                   <a class="btn btn-block btn-success" href="<?php echo $index_path . '?sec=ipban&action=addip' ?>">Add New IP</a>
                               </div>
                               <div class="form-group">
                                   <div class="changeip form-add-user">
                                       <input name="active_inactive_ip" <?php echo $changeip == 0 ? 'checked' : '' ?> type="checkbox"  data-toggle="toggle" data-on="Enable" data-off="Disable" data-onstyle="success" data-offstyle="danger">
                                   </div>
                               </div>
                           </div>
                            <table id="category" class="table table-bordered" >
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>IP</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
<?php foreach ($ipban as $ip){
    ?>
    <tr <?php echo $ip['status'] == 1 ? "style='background-color: #ff6a6a'" : "" ?> onclick="window.location='<?php echo $index_path . '?sec=ipban&action=updateip&id=' . $ip['ID'] ?>'">
        <td>
<?php echo $ip['ID']?>
        </td>
        <td>
            <?php echo $ip['ip']?>
        </td>
        <td>
            <?php echo $ip['status'] == 0 ? ''.$lang['active'].'' : ''.$lang['inactive'].'' ?>
        </td>

    </tr>
<?php
} ?>



                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
