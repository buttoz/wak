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
use \Gumlet\ImageResize;
//if ($_SESSION['admin_type'] !== 'admin') {
//    echo '<div class="permissiondenied">Permission Denied</div>';
//    exit();
//}

$backoofice_path = dirname(__DIR__, 2);

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $db = getDbInstance();
    $db->where('id', $id);
    $ip = $db->getOne('ipban');




}else{
    echo '<div class="permissiondenied">Permission Denied</div>';
    exit();
}

//if ($_SESSION['admin_type'] !== 'admin') {
//    echo 'Permission Denied';
//    exit();
//}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form_data = filter_input_array(INPUT_POST);



    if(isset($form_data['active_inactive'])){
        $stat = 0;
    }
    else{
        $stat = 1;
    }







    $data = Array (
        "status"=> $stat,
        "ip" => $form_data['ip_add']
    );

    $db = getDbInstance();

    $db->where ('id', $id);


    if ($db->update ('ipban', $data)){
        $path = pathUrl(__DIR__ . '/../../');
        redirect($path . 'index.php?sec=ipban&action=manageip');
    }else{
        $_SESSION['failure'] = $db->getLastError();

    }
}
?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update IP</h3>
                    </div>
                    <div class="card-body">
                        <?php
                                      ?>
                        <form autocomplete="false" class="well form-horizontal" action=" " method="post"  id="ipupdate" enctype="multipart/form-data">
                            <?php include_once 'update_ip_form.php'; ?>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
</div>
