<?php
require_once './client/config/db/config.php';
session_start();
unset($_SESSION['client_id']);
unset($_SESSION['client_logged_in']);


if(isset($_COOKIE['series_id']) && isset($_COOKIE['remember_token'])){
	clearAuthCookie();
}
header('Location: ./client/index.php');
exit;

