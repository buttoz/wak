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
    $last_id = $db->insert ('ipban', $data);

    if ($last_id)
    {
        $path = pathUrl(__DIR__ . '/../../');
        redirect($path . 'index.php?sec=ipban&action=manageip');
    }else{
        $_SESSION['failure'] = $db->getLastError();

    }




}
?>

<div class="content-wrapper" >
    <section class="content">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New IP</h3>


                    </div>
                    <div class="card-body">
                        <?php
                                      ?>
                        <form autocomplete="false" class="well form-horizontal" action=" " method="post"  id="addip" enctype="multipart/form-data">
                            <?php include_once 'add_ip_form.php'; ?>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
</div>
