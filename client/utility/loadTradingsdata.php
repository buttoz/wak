<?php

require_once '../config/db/config.php';
require_once '../languages/he.lang.php';
    $db = getDbInstance();
    $db->where('id_agent',$_POST['id']);
    $agreements = $db->get('tradings_agent');

    echo json_encode($agreements);

    ?>
