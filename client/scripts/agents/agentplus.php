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
// if (!have_permission('agent_edit')) {
//     echo '<div class="permissiondenied">Permission Denied</div>';
//     exit();
// }

$backoofice_path = dirname(__DIR__, 2);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = getDbInstance();
    $db->where('c_id', $id);
    $user = $db->getOne('agents');
} else {
    echo '<div class="permissiondenied">Permission Denied</div>';
    exit();
}

$updateuseractive1 = 'active';
$updateuseractive2 = 'show active';
if (isset($_GET['tab']) || array_key_exists('choose_supplier', $_POST) || array_key_exists('update_all_prices', $_POST) ||  array_key_exists('precent_desc', $_POST) || array_key_exists('car_type', $_POST) || array_key_exists('serv_type', $_POST) || array_key_exists('suppliersagent', $_POST) || array_key_exists('copy_from_agent_select', $_POST)) {
    $updateprice1 = 'active';
    $updateprice2 = 'show active';
    $updateuseractive1 = '';
    $updateuseractive2 = '';
} else {
    $updateprice1 = '';
    $updateprice2 = '';
}
?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title"><?PHP echo $lang['update_agent'] ?></h3>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <h6><? echo $lang['name'] . ": " . $user['business_name']; ?></h6>
                            </div>
                            <div class="col-md">
                                <h6><? echo $lang['phone'] . ": " . $user['a_mobile']; ?></h6>
                            </div>
                            <div class="col-md">
                                <h6><? echo $lang['email'] . ": " . $user['a_email']; ?></h6>
                            </div>
                            <div class="col-md">
                                <h6><?= $lang['joined_date'] . " : " . date("d/m/Y", strtotime($user['c_insertdate']))  ?></h6>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <? echo $updateuseractive1; ?>" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo $lang['private_details']; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Agreements-tab" data-toggle="tab" href="#Agreements" role="tab" aria-controls="Agreements" aria-selected="false"><?php echo $lang['Agreements']; ?></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="docs-tab" data-toggle="tab" href="#docs" role="tab" aria-controls="" aria-selected="false"><?php echo $lang['docs']; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="checks_tab-tab" data-toggle="tab" href="#checks_tab" role="tab" aria-controls="" aria-selected="false"><?php echo $lang['checks_tab']; ?></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="Trading_conditions-tab" data-toggle="tab" href="#Trading_conditions" role="tab" aria-controls="Trading_conditions" aria-selected="false"><?php echo $lang['Trading_conditions']; ?></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="false"><?php echo $lang['payments']; ?></a>
                            </li>



                        </ul>
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade <? echo $updateuseractive2; ?>" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <form autocomplete="false" class="well form-horizontal" action=" " method="post" id="manageagent" enctype="multipart/form-data">
                                    <?php include_once 'update_agent_form.php'; ?>
                                </form>

                            </div>
                            <div class="tab-pane" id="Agreements" role="tabpanel" aria-labelledby="Agreements-tab">
                                <?php include_once 'Agreements.php'; ?>
                            </div>
                            <div class="tab-pane fade" id="docs" role="tabpanel" aria-labelledby="docs-tab">
                                <?php include_once "docs.php";
                                ?>
                            </div>
                            <div class="tab-pane fade" id="checks_tab" role="tabpanel" aria-labelledby="checks_tab-tab">
                                <?php include_once "checks_tab.php";
                                ?>
                            </div>
                            <div class="tab-pane fade" id="Agent_users" role="tabpanel" aria-labelledby="Agent_users-tab">
                                <?php //include_once 'agent_users.php';
                                ?>
                            </div>
                            <div class="tab-pane fade" id="Trading_conditions" role="tabpanel" aria-labelledby="Trading_conditions-tab">
                                <?php include_once "Trading_conditions.php";
                                ?>
                            </div>
                            <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                                <?php include_once "payments.php"; ?>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
</div>