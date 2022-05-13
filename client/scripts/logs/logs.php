    <?php

if ($_SESSION['admin_type'] !== 'admin') {
    // show permission denied message
    echo '<div class="permissiondenied">Permission Denied</div>';
    exit();
}

if(isset($_GET['product_category'])){
    $cat_selected_id = $_GET['product_category'];
}

$db = getDbInstance();

if(isset($_GET['log_view'])){
    $log_selected_id = $_GET['log_view'];
}else{
    $log_selected_id = 'all';
}




if(isset($_GET['log_view'])){

    if($_GET['log_view'] == 'products'){
        $db->where ('script_name', 'Product');

    }elseif ($_GET['log_view'] == 'categories'){
        $db->where ('script_name', 'Category');
    }
    elseif ($_GET['log_view'] == 'users'){
        $db->where ('script_name', 'User');
    }
}

$logs = $db->get('logs');


$backofficedir = pathUrl(__DIR__ . '/../../');
$index_path = $backofficedir . 'index.php';


?>

<div class="content-wrapper" style="min-height: 1360.44px;">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="newproduct newuser">

                                <!-- <form id="frm" >
                                    <input type="hidden" name="sec" value="logs" />
                                    <input type="hidden" name="action" value="view" />
                                    <select  name="log_view" id="productselectcatmanager" >

                                        <option <?php echo $log_selected_id == "all" ? "selected": ""?> value="all"><?php echo $lang['all'] ?></option>
                                        <option <?php echo $log_selected_id == "categories" ? "selected": ""?> value="categories"><?php echo $lang['categories'] ?></option>
                                        <option <?php echo $log_selected_id == "products" ? "selected": ""?> value="products"><?php echo $lang['products'] ?></option>
                                        <option <?php echo $log_selected_id == "users" ? "selected": ""?> value="users"><?php echo $lang['users'] ?></option>

                                    </select>
                                </form> -->
                            </div>
                            <table id="logs" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th><?php echo $lang['action_time'] ?></th>
                                    <th><?php echo $lang['username'] ?></th>
                                    <th><?php echo $lang['user_full_name'] ?></th>
                                    <th><?php echo $lang['script_name'] ?></th>
                                    <th><?php echo $lang['action_type'] ?></th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($logs as $log){
                                        $date=date_create($log['action_time']);
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo date_format($date,"Y/m/d H:i"); ?>
                                            </td>
                                            <td>
                                                <?php echo $log['user_name']?>
                                            </td>

                                            <td>
                                                <?php echo $log['user_full_name']?>
                                            </td>
                                            <td>
                                                <?php echo $log['script_name']?>
                                            </td>
                                            <td>
                                                <?php echo $log['action_type']?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
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
    <!-- /.content -->
</div>

