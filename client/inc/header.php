<?
$db = getDbInstance();
$name = $db->where('setting_name', 'business_name')->getOne('settings');
$lang['bakecake'] = $name['setting_value'];

?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $lang['bakecake'] . " | " . $lang['admin'] ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./ui/all.min.css">
    <!-- Ionicons -->
    <? $db = getDbInstance();
    $ico = $db->where('setting_name', 'favicon')->getValue('settings', 'setting_value') ?>
    <link rel="icon" href="<?= DATA_URL ?>/favicon/<?= $ico ?>" type="image/x-icon">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./ui/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./ui/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./ui/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./ui/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./ui/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./ui/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="./ui/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./ui/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./ui/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="./ui/summernote-bs4.min.css">
    <link rel="stylesheet" href="./ui/tagify.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">


    <?php if ($_SESSION['lang'] == 'ar' || $_SESSION['lang'] == 'he') {
    ?>
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="./ui/rtl.css">
    <?php
    } ?>
    <?php if ($_SESSION['lang'] == 'ar') {
    ?>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');

            * {
                font-family: 'Cairo', sans-serif;
            }
        </style>
    <?php
    } ?>
    <link rel="stylesheet" href="./ui/custom.css">

    <style>
        .page-loader-wrapper2 {
            display: none;
        }

        .page-loader-wrapper2 {
            z-index: 99999999;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: none;
            overflow: hidden;
            text-align: center;
        }
    </style>
</head>

<body data-scrollbar-auto-hide="n" class="hold-transition sidebar-mini layout-fixed">
    <input type="hidden" name="dataurl" id="dataurl" value="<?= DATA_URL ?>">
    <div class="page-loader-wrapper2">
        <div class="loader">
            <div class="m-t-100">
                <img class="loading-img-spin" src="assets/bookingprogressimage.gif" width="200" alt="admin">
            </div>
            <p>נא להמתין ....</p>
        </div>
    </div>
    <style type="text/css">
        /*this must be set so that the loading div
can be height:100% */
        body {
            height: 100%
        }

        /*this is what we want the div to look like
when it is not showing*/
        div.loading-invisible {
            /*make invisible*/
            display: none;
        }

        /*this is what we want the div to look like
when it IS showing*/
        div.loading-visible {
            /*make visible*/
            display: block;
            /*position it at the very top-left corner*/
            position: absolute;
            top: 0px;
            left: 0;
            width: 100%;
            height: 100%;
            text-align: center;
            z-index: 10;
            background: #fff;
            background: none;
            /*this line removes the background in IE*/
            opacity: .75;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }
    </style>


    <div class="nojs-content">
        Please Enable Javascript in your Browser
    </div>
    <?php
    include_once "menu.php";
    ?>
    <!-- /.sidebar -->
    </aside>