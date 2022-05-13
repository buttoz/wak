<?php

if (!isset($_SESSION['client_logged_in'])) {
    header('Location: ../login_client.php');
}