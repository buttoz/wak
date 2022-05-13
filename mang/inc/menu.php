<div class="wrapper">
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav main-header">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- Left navbar links -->
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown user user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo  pathUrl(__DIR__ . '/../assets/img') . 'user.jpg' ?>" class="user-image img-circle elevation-2 alt=" User Image">
                    <span class="hidden-xs"><?php echo $first_name . ' ' . $last_name ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="<?php echo  pathUrl(__DIR__ . '/../assets/img') . 'user.jpg' ?>" class="img-circle elevation-2" alt="User Image">
                        <p>
                            <?php echo $first_name . ' ' . $last_name ?>
                        </p>
                    </li>
                    <li class="user-footer">
                        <div class="pull-left">
                            <!--                            <a href="--><?php //echo $backofficedir . 'profile.php'
                                                                        ?>
                            <!--" class="btn btn-default btn-flat">Profile</a>-->
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo pathUrl(__DIR__ . '/../../') . 'logout.php' ?>" class="btn btn-default btn-flat"><?php echo $lang['logout'] ?></a>
                        </div>
                    </li>
                </ul>
            </li>

        </ul>


        <!-- Right navbar links -->

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <? $style = $db->where('setting_name', 'style')->getOne('settings'); ?>
    <aside class="main-sidebar <?= $style['setting_value'] ?>  elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <?
            $db = getDbInstance();
            //$test = $db->where('url', $_SERVER['SERVER_NAME'])->getOne('clients');
            $test = $db->where('setting_name', 'companylogo')->getOne('settings');
            if ($db->count > 0)
                if ($test['setting_value'] != '') {
            ?>
                <span style="display: flex; justify-content: center"><img src="<?= DATA_URL ?>/logo/<?php echo $test['setting_value'] ?>" alt="logo"></span>
            <? } else {
                    $test = $db->where('setting_name', 'business_name')->getOne('settings');
            ?>
                <span class="brand-text font-weight-bold" style="display: flex; justify-content: center"><?php echo isset($test['business_name']) ?></span>
            <?
                } ?>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
              </div>
            </div> -->

            <? require_once 'utility/have_permession.php'; ?>
            <? if (!isset($_GET['action'])) $_GET['action'] = ''; ?>
            <!-- Sidebar Menu -->


            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="<?php echo $backofficedir . 'index.php' ?>" class="nav-link <?php echo  $_GET['action'] == '' ? "active" : "" ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                <?php echo $lang['dashboard'] ?>
                            </p>
                        </a>
                    </li>
                    <?/* if (have_permission('sub_list')) {
                        $db->where('c_status', 2)->get('polisa');
                    ?>
                        <li class="nav-item">
                            <a href="<?php echo $index_path . '?sec=subs&action=managesubs' ?>" class="nav-link <?php echo $_GET['action'] == 'managesubs' ? "active" : "" ?>">
                                <i class="fas fa-align-right nav-icon"></i>
                                <p> <?php echo $lang['subs'] ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $index_path . '?sec=subs&action=managecanclled' ?>" class="nav-link <?php echo $_GET['action'] == 'managecanclled' ? "active" : "" ?>">
                                <i class="fas fa-align-right nav-icon"></i>
                                <p> <?php echo $lang['managecanclled'] . " ( " . $db->count . " ) " ?></p>
                            </a>
                        </li>

                    <?  }
                    /*if (have_permission('health_list')) {
                    ?>
                        <li class="nav-item">
                            <a href="<?php echo $index_path . '?sec=health&action=managehealth' ?>" class="nav-link <?php echo $_GET['action'] == 'managehealth' ? "active" : "" ?>">
                                <i class="fas fa-toggle-on nav-icon"></i>
                                <p> <?php echo $lang['health'] ?></p>
                            </a>
                        </li>
                    <?  }*/
                    if (have_permission('agent_list')) { ?>
                        <li class="nav-item">
                            <a href="<?php echo $index_path . '?sec=agents&action=manageagent' ?>" class="nav-link <?php echo $_GET['action'] == 'manageagent' ? "active" : "" ?>">
                                <i class="fas fa-user nav-icon"></i>

                                <p> <?php echo $lang['agents'] ?></p>
                            </a>
                        </li>
                    <? } /*?>
                    <? if (have_permission('resellers')) {
                    ?>
                        <li class="nav-item">
                            <a href="<?php echo $index_path . '?sec=marketers&action=managemarketers' ?>" class="nav-link <?php echo $_GET['action'] == 'managemarketers' ? "active" : "" ?>">
                                <i class="fas fa-users nav-icon"></i>
                                <p> <?php echo $lang['marketers'] ?></p>
                            </a>
                        </li>
                    <?  }
                    ?>



                    <? if (have_permission('prod_list')) {
                    ?>
                        <li class="nav-item">
                            <a href="<?php echo $index_path . '?sec=prodandprice&action=manageprodandprice' ?>" class="nav-link <?php echo $_GET['action'] == 'manageprodandprice' ? "active" : "" ?>">
                                <i class="fas fa-dolly nav-icon"></i>
                                <p> <?php echo $lang['prodandprice'] ?></p>
                            </a>
                        </li>
                    <?  }
                    ?>

                    <? if ((have_permission('supplier_list') and !STANDALONE) or getuserip() == '62.90.18.134') {
                    ?>
                        <li class="nav-item">
                            <a href="<?php echo $index_path . '?sec=suppliers&action=managesuppliers' ?>" class="nav-link <?php echo $_GET['action'] == 'managesuppliers' ? "active" : "" ?>">
                                <i class="fab fa-docker nav-icon"></i>
                                <p> <?php echo $lang['suppliers'] ?></p>
                            </a>
                        </li>
                    <?  }
                    if (have_permission('import')) {
                    ?>
                        <li class="nav-item <?php echo isset($_GET['action']) && $_GET['action'] == 'importprod' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'import_cust' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'system_build' ? 'menu-is-opening menu-open active' : '')) ?>">
                            <a href="#" class="nav-link <?php echo isset($_GET['action']) && $_GET['action'] == 'importprod' ? 'active' : (isset($_GET['action']) && $_GET['action'] == 'import_cust' ? 'active' : '') ?>">
                                <i class="fas fa-file-import nav-icon"></i>
                                <p>
                                    <?php echo $lang['import'] ?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=prodandprice&action=importprod' ?>" class="nav-link <?php echo $_GET['action'] == 'importprod' ? "active" : "" ?>">
                                        <i class="fas fa-file-import nav-icon"></i>
                                        <p> <?php echo $lang['importprod'] ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=agents&action=import_cust' ?>" class="nav-link <?php echo $_GET['action'] == 'import_cust' ? "active" : "" ?>">
                                        <i class="fas fa-file-import nav-icon"></i>
                                        <p> <?php echo $lang['import_cust'] ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=agents&action=system_build' ?>" class="nav-link <?php echo $_GET['action'] == 'system_build' ? "active" : "" ?>">
                                        <i class="fas fa-file-import nav-icon"></i>
                                        <p> <?php echo $lang['supplier_import'] ?></p>
                                    </a>
                                </li>
                            </ul>
                        </li><? }
                            if (have_permission('reports')) {  ?>
                        <li class="nav-item <?php echo isset($_GET['action']) && $_GET['action'] == 'dailyreports' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'monthlyreports' ? 'menu-is-opening menu-open active' : '') ?>">
                            <a href="#" class="nav-link <?php echo isset($_GET['action']) && $_GET['action'] == 'dailyreports' ? 'active' : (isset($_GET['action']) && $_GET['action'] == 'monthlyreports' ? 'active' : '') ?>">
                                <i class="fas fa-dollar-sign nav-icon"></i>
                                <p>
                                    <?php echo $lang['reports_suppliers'] ?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">


                                <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=excel&action=dailyreports' ?>" class="nav-link <?php echo $_GET['action'] == 'dailyreports' ? "active" : "" ?>">
                                        <i class="fas fa-user-edit nav-icon"></i>
                                        <p> <?php echo $lang['dailyreports'] ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=excel&action=monthlyreports' ?>" class="nav-link <?php echo $_GET['action'] == 'monthlyreports' ? "active" : "" ?>">
                                        <i class="fas fa-user-edit nav-icon"></i>
                                        <p> <?php echo $lang['monthlyreports'] ?></p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    <? }
                            if (have_permission('accounting')) { ?>
                        <li class="nav-item <?php echo isset($_GET['action']) && $_GET['action'] == 'agent_acc' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'marketer_acc' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'supplier_acc' ? 'menu-is-opening menu-open active' : '')) ?>">
                            <a href="#" class="nav-link <?php echo isset($_GET['action']) && $_GET['action'] == 'agent_acc' ? 'active' : (isset($_GET['action']) && $_GET['action'] == 'marketer_acc' ? 'active' : (isset($_GET['action']) && $_GET['action'] == 'supplier_acc' ? 'active' : '')) ?>">
                                <i class="fas fa-dollar-sign nav-icon"></i>
                                <p>
                                    <?php echo $lang['Accounting'] ?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">

                                <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=acounting&action=agent_acc' ?>" class="nav-link <?php echo $_GET['action'] == 'agent_acc' ? "active" : "" ?>">
                                        <i class="fas fa-user-edit nav-icon"></i>
                                        <p> <?php echo $lang['agents_acc'] ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=acounting&action=marketer_acc' ?>" class="nav-link <?php echo $_GET['action'] == 'marketer_acc' ? "active" : "" ?>">
                                        <i class="fas fa-user-edit nav-icon"></i>
                                        <p> <?php echo $lang['marketers'] ?></p>
                                    </a>
                                </li>
                                <? if (!STANDALONE) { ?>
                                    <li class="nav-item">
                                        <a href="<?php echo $index_path . '?sec=acounting&action=supplier_acc' ?>" class="nav-link <?php echo $_GET['action'] == 'supplier_acc' ? "active" : "" ?>">
                                            <i class="fas fa-user-edit nav-icon"></i>
                                            <p> <?php echo $lang['suppliers'] ?></p>
                                        </a>
                                    </li>
                                <? } ?>

                            </ul>
                        </li>

                    <? }
                    <li class="nav-item">
                        <a href="<?php echo $index_path . '?sec=settings&action=mangclients' ?>" class="nav-link <?php echo $_GET['action'] == 'mangclients' ? "active" : "" ?>">
                            <i class="nav-icon fa fa-tag"></i>
                            <p>
                                <?php echo $lang['clients']  ?>
                            </p>
                        </a>
                    </li>
                    */ ?>
                    <?
                    if (have_permission('settings')) { ?>
                        <li class="nav-item <?php echo isset($_GET['action']) && $_GET['action'] == 'manageuser' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'settingsplus' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'view' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'manageip' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'system_tables' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'deparmentsmng' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'permissionmange' ? 'menu-is-opening menu-open active' : '')))))) ?>">
                            <a href="#" class="nav-link <?php echo isset($_GET['action']) && $_GET['action'] == 'manageuser' ? 'active' : (isset($_GET['action']) && $_GET['action'] == 'settingsplus' ? 'active' : (isset($_GET['action']) && $_GET['action'] == 'view' ? 'active' : (isset($_GET['action']) && $_GET['action'] == 'manageip' ? 'active' : (isset($_GET['action']) && $_GET['action'] == 'system_tables' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'permissionmange' ? 'menu-is-opening menu-open active' : (isset($_GET['action']) && $_GET['action'] == 'deparmentsmng' ? 'menu-is-opening menu-open active' : '')))))) ?>">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    <?php echo $lang['settings'] ?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">

                                <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=users&action=manageuser' ?>" class="nav-link <?php echo $_GET['action'] == 'manageuser' ? "active" : "" ?>">
                                        <i class="fas fa-user-edit nav-icon"></i>
                                        <p> <?php echo $lang['users_management'] ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=logs&action=view' ?>" class="nav-link <?php echo $_GET['action'] == 'view' ? "active" : "" ?>">
                                        <i class="nav-icon fa fa-history"></i>
                                        <p>
                                            <?php echo $lang['logs'] ?>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=ipban&action=manageip' ?>" class="nav-link <?php echo $_GET['action'] == 'manageip' ? "active" : "" ?>">
                                        <i class="nav-icon fa fa-ban"></i>
                                        <p>
                                            <?php echo $lang['ip_block'] ?>
                                        </p>
                                    </a>
                                </li>


                                <!--   <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=system_tables&action=system_tables' ?>" class="nav-link <?php echo $_GET['action'] == 'system_tables' ? "active" : "" ?>">
                                        <i class="nav-icon fa fa-tag"></i>
                                        <p>
                                            <?php echo $lang['system_table'] ?>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=permission&action=permissionmange' ?>" class="nav-link <?php echo $_GET['action'] == 'permissionmange' ? "active" : "" ?>">
                                        <i class="nav-icon fa fa-tag"></i>
                                        <p>
                                            <?php echo $lang['porfile_perm'] ?>
                                        </p>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=deparments&action=deparmentsmng' ?>" class="nav-link <?php echo $_GET['action'] == 'deparmentsmng' ? "active" : "" ?>">
                                        <i class="nav-icon fa fa-tag"></i>
                                        <p>
                                            <?php echo $lang['depts']  ?>
                                        </p>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="<?php echo $index_path . '?sec=settings&action=settingsplus' ?>" class="nav-link <?php echo $_GET['action'] == 'settingsplus' ? "active" : "" ?>">
                                        <i class="nav-icon fa fa-tag"></i>
                                        <p>
                                            <?php echo $lang['genral']  ?>
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                    <?
                    } ?>



                    <li class="nav-item" style="display:none">
                        <a href="<?php echo $index_path . '?sec=about&action=viewabout' ?>" class="nav-link <?php echo $_GET['action'] == 'viewabout' ? "active" : "" ?>">
                            <i class="nav-icon fa fa-tag"></i>
                            <p>
                                <?php echo $lang['about_us'] ?>
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>