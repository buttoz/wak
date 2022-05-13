<?php
require_once './mang/config/db/config.php';
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_logged_in']);
unset($_SESSION['admin_type']);


if(isset($_COOKIE['series_id']) && isset($_COOKIE['remember_token'])){
	clearAuthCookie();
}
header('Location: ./mang/index.php');
exit;

