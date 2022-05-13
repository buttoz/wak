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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = getDbInstance();
    $db->where('id', $id);
    $user = $db->getOne('users');
} else {
    echo '<div class="permissiondenied">Permission Denied</div>';
    exit();
}
// if (array_key_exists('updateuser', $_POST)) {
//     $updateuseractive1 = 'active';
//     $updateuseractive2 = 'show active';
// } else {
//     $updateuseractive1 = '';
//     $updateuseractive2 = '';
// }
$updateuseractive1 = 'active';
$updateuseractive2 = 'show active';
if (array_key_exists('profile_list', $_POST)) {
    $profile_list1 = 'active';
    $profile_list2 = 'show active';
    $updateuseractive1 = '';
    $updateuseractive2 = '';
    $updatedeptsactive1 = '';
    $updatedeptsactive2 = '';
} else {
    $profile_list1 = '';
    $profile_list2 = '';
}
if (array_key_exists('dept_add', $_POST)) {
    $updatedeptsactive1 = 'active';
    $updatedeptsactive2 = 'show active';
    $profile_list1 = '';
    $profile_list2 = '';
    $updateuseractive1 = '';
    $updateuseractive2 = '';
} else {
    $updatedeptsactive1 = '';
    $updatedeptsactive2 = '';
}


?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title"><?php echo $lang['update_user'] ?></h3>
                        </div>

                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <? echo $updateuseractive1; ?>" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo $lang['private_details']; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <? echo $profile_list1; ?> " id="Agreements-tab" data-toggle="tab" href="#Agreements" role="tab" aria-controls="Agreements" aria-selected="false"><?php echo $lang['permissions']; ?></a>
                            </li>


                        </ul>
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade <? echo $updateuseractive2; ?>" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <?php include_once 'updateuser.php'; ?>
                            </div>

                            <div class="tab-pane <? echo $profile_list2; ?>" id="Agreements" role="tabpanel" aria-labelledby="Agreements-tab">
                                <? include_once "permissionedit.php" ?>

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