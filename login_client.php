<?php
session_start();
require_once './client/config/db/config.php';
include('./client/languages/lang_config.php');
$db = getDbInstance();
$db->where("setting_name", 'change_language');
$res = $db->getOne("settings");
$changelanguage = $res['setting_value'];
$changelanguage = 1;

if (isset($_SESSION['client_logged_in']) && $_SESSION['client_logged_in'] === TRUE) {
  header('Location: ./client/index.php');
}
$ipstat = $db->where('setting_name', 'change_ip')->getOne('settings');

if ($ipstat['setting_value'] == 0) {
  $ip = new IP();
  if (!$ip->check_ip())
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $lang['bakecake'] ?> | <?php echo $lang['log_in'] ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./client/ui/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./client/ui/icheck-bootstrap.min.css">
  <?php if ($_SESSION['lang'] == 'ar' || $_SESSION['lang'] == 'he') {
  ?>
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./client/ui/rtl.css">
  <?php
  } ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="./client/ui/adminlte.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
</head>
<? $imgbg = $db->where('setting_name', 'login_background_image')->getOne('settings') ?>

<body class="hold-transition login-page">
  <div class="imgbg" style="width:100%; height: 100%;  margin: 0px auto; overflow: hidden;background-image: url('<?= $imgbg['setting_value'] ?>');background-size: cover;">
    <div style="width: 370px; height: 570px; overflow: hidden ; margin: 10% auto; ">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="display: <?php echo $changelanguage == 1 ? 'none' : '' ?>">

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon <?php echo $_SESSION['lang'] == 'he' ? 'flag-icon-il' : ($_SESSION['lang'] == 'ar' ? "flag-icon-sa" : 'flag-icon-us') ?>"> </span> <?php echo $_SESSION['lang'] == 'he' ? 'Hebrew' : ($_SESSION['lang'] == 'ar' ? "Arabic" : 'English') ?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown09">
              <a class="dropdown-item" style="<?php echo $_SESSION['lang'] == 'en' ? 'display:none' : '' ?>" href="<?php echo addOrUpdateUrlParam('lang', 'en') ?>"><span class="flag-icon flag-icon-us"> </span> English</a>
              <a class="dropdown-item" style="<?php echo $_SESSION['lang'] == 'ar' ? 'display:none' : '' ?>" href="<?php echo addOrUpdateUrlParam('lang', 'ar') ?>"><span class="flag-icon flag-icon-sa"> </span> Arabic</a>
              <a class="dropdown-item" style="<?php echo $_SESSION['lang'] == 'he' ? 'display:none' : '' ?>" href="<?php echo addOrUpdateUrlParam('lang', 'he') ?>"><span class="flag-icon flag-icon-il"> </span> Hebrew</a>
            </div>
          </li>

        </ul>


      </nav>

      <div class="login-box">
        <div class="login-logo">
          <? $logo = $db->where('setting_name', 'companylogo')->getOne('settings');
          if ($db->count > 0) { ?>
            <img src="./data/logo/<?= $logo['setting_value'] ?>" alt="logo">
          <? } ?>
          <br>
          <br>
          <br>
          <? $name = $db->where('setting_name', 'business_name')->getOne('settings'); ?>
          <a href=""><b><?php echo $name['setting_value'] ?></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg"><?php echo $lang['sign_in_session'] ?></p>

            <form method="POST" action="authenticate_client.php">
              <?php if (isset($_SESSION['login_failure'])) : ?>
                <div class="alert alert-danger alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <?php
                  echo $_SESSION['login_failure'];
                  unset($_SESSION['login_failure']);
                  ?>
                </div>
              <?php endif; ?>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="<?PHP echo $lang['username'] ?>" name="username">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="<?PHP echo $lang['password'] ?>" name="passwd">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block"><?php echo $lang['sign_in'] ?></button>
                </div>
                <!-- /.col -->
              </div>
            </form>


          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="./client/js/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./client/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./client/js/adminlte.min.js"></script>
</body>

</html>