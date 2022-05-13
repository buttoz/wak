<?php

function have_permission($key)
{
    $db = getDbInstance();
    $key_id = $db->where('key_id', $key)->getOne('permission_define');
    $db2 = getDbInstance();
    $list = $db2->where('user_id', $_SESSION['client_id'])->where('permissionid', $key_id['id'])->getOne('permission_user');
    if (($_SESSION['admin_type'] == 'admin') or ($list))
        return true;
    else
        return false;
}
