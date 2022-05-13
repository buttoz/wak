<?php

/**
 * Function to generate random string.
 */
include_once "mmc_func.php";
function randomString($n)
{

    $generated_string = "";

    $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

    $len = strlen($domain);

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, $len - 1);
        $generated_string = $generated_string . $domain[$index];
    }

    return $generated_string;
}

/**
 *
 */
function getSecureRandomToken()
{
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    return $token;
}

/**
 * Clear Auth Cookie
 */
function clearAuthCookie()
{

    unset($_COOKIE['series_id']);
    unset($_COOKIE['remember_token']);
    setcookie('series_id', null, -1, '/');
    setcookie('remember_token', null, -1, '/');
}
/**
 *
 */
function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function paginationLinks($current_page, $total_pages, $base_url)
{

    if ($total_pages <= 1) {
        return false;
    }

    $html = '';

    if (!empty($_GET)) {
        unset($_GET['page']);
        $http_query = "?" . http_build_query($_GET);
    } else {
        $http_query = "?";
    }

    $html = '<ul class="pagination text-center">';

    if ($current_page == 1) {

        $html .= '<li class="disabled"><a>First</a></li>';
    } else {
        $html .= '<li><a href="' . $base_url . $http_query . '&page=1">First</a></li>';
    }

    if ($current_page > 5) {
        $i = $current_page - 4;
    } else {
        $i = 1;
    }

    for (; $i <= ($current_page + 4) && ($i <= $total_pages); $i++) {
        ($current_page == $i) ? $li_class = ' class="active"' : $li_class = '';

        $link = $base_url . $http_query;

        $html = $html . '<li' . $li_class . '><a href="' . $link . '&page=' . $i . '">' . $i . '</a></li>';

        if ($i == $current_page + 4 && $i < $total_pages) {

            $html = $html . '<li class="disabled"><a>...</a></li>';
        }
    }

    if ($current_page == $total_pages) {
        $html .= '<li class="disabled"><a>Last</a></li>';
    } else {

        $html .= '<li><a href="' . $base_url . $http_query . '&page=' . $total_pages . '">Last</a></li>';
    }

    $html = $html . '</ul>';

    return $html;
}

/**
 * to prevent xss
 */
function xss_clean($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
function pathUrl($dir = __DIR__)
{

    $root = "";
    $dir = str_replace('\\', '/', realpath($dir));

    $root .= !empty($_SERVER['HTTPS']) ? 'https' : 'http';

    $root .= '://' . $_SERVER['HTTP_HOST'];

    //ALIAS
    if (!empty($_SERVER['CONTEXT_PREFIX'])) {
        $root .= $_SERVER['CONTEXT_PREFIX'];
        $root .= substr($dir, strlen($_SERVER['CONTEXT_DOCUMENT_ROOT']));
    } else {
        $root .= substr($dir, strlen($_SERVER['DOCUMENT_ROOT']));
    }

    $root .= '/';

    return $root;
}
function redirect($url)
{
    if (!headers_sent()) {
        header('Location: ' . $url);
        exit;
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        echo '</noscript>';
        exit;
    }
}

function getuserip()
{
    if ((isset($_SERVER['HTTP_X_FORWARDED_FOR'])) &&
        (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    ) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif ((isset($_SERVER['HTTP_CLIENT_IP'])) &&
        (!empty($_SERVER['HTTP_CLIENT_IP']))
    ) {
        $ip = explode(".", $_SERVER['HTTP_CLIENT_IP']);
        $ip = $ip[3] . "." . $ip[2] . "." . $ip[1] . "." . $ip[0];
    } elseif ((!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ||
        (empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    ) {
        if ((!isset($_SERVER['HTTP_CLIENT_IP'])) &&
            (empty($_SERVER['HTTP_CLIENT_IP']))
        ) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    } else {
        $ip = "0.0.0.0";
    }

    return $ip;
}
function addOrUpdateUrlParam($name, $value)
{
    $params = $_GET;
    unset($params[$name]);
    $params[$name] = $value;
    return basename($_SERVER['PHP_SELF']) . '?' . http_build_query($params);
}
if (!function_exists('dd')) {
    function dd()
    {
        array_map(function ($x) {
            dump($x);
        }, func_get_args());
        die;
    }
}

function categories()
{
    $db = getDbInstance();
    $db->where("parent_category_id", 0);
    $catArray = $db->get('categories');

    $categories = array();

    foreach ($catArray as $cat) {
        $categories[] = array(
            'id' => $cat['id'],
            'parent_id' => $cat['parent_category_id'],
            'category_name' => $cat['name'],
            'subcategory' => sub_categories($cat['id']),
        );
    }

    return $categories;
}



function sub_categories($id)
{
    $db = getDbInstance();
    $db->where("parent_category_id", $id);
    $catArray = $db->get('categories');

    $categories = array();

    foreach ($catArray as $cat) {
        $categories[] = array(
            'id' => $cat['id'],
            'parent_id' => $cat['parent_category_id'],
            'category_name' => $cat['name'],
            'subcategory' => sub_categories($cat['id']),
        );
    }
    return $categories;
}

function viewsubcat($categories, $matchcatid)
{
    $html = '';
    foreach ($categories as $category) {
        $selected = $category['id'] == $matchcatid ? "selected" : '';

        $html .= '<option ' . $selected . ' value="' . $category['id'] . '">' . $category['category_name'] . '</option>';

        if (!empty($category['subcategory'])) {
            $html .= viewsubcat($category['subcategory']);
        }
    }


    return $html;
}

function category_with_child_id()
{
    $categories = categories();
    $check_value = array();
    foreach ($categories as $cat) {
        if (!empty($cat['subcategory'])) {
            $check_value[] = $cat['id'];
        }
    }
    return $check_value;
}

function category_with_products()
{
    $db = getDbInstance();
    $catArray = $db->get('categories');

    $categories = array();

    foreach ($catArray as $cat) {
        $categories[] = array(
            'id' => $cat['id'],
            'parent_id' => $cat['parent_category_id'],
            'category_name' => $cat['name'],
            'products' => get_products_by_id($cat['id']),
        );
    }

    return $categories;
}

function get_products_by_id($id)
{
    $db = getDbInstance();
    $db->where("category_id", $id);
    $products = $db->get('products');

    return $products;
}

function category_with_products_id()
{
    $categories = category_with_products();
    $check_value = array();
    foreach ($categories as $cat) {
        if (!empty($cat['products'])) {
            $check_value[] = $cat['id'];
        }
    }
    return $check_value;
}

function get_date_time_randomnumber()
{
    $date = new DateTime();
    $date = $date->format('Ymd');

    $time = new DateTime();
    $time = $time->format('Hi');

    $number = rand(0, 1000);

    return $date . '_' . $time . '_' . $number;
}

function get_current_login_user_full_name()
{
    if (isset($_SESSION['client_id'])) {
        $userID = $_SESSION['client_id'];
    }
    $db = getDbInstance();
    $db->where("id", $userID);
    $user = $db->getOne("users");
    $first_name = $user['u_firstname'];
    $last_name = $user['u_lastname'];

    return $first_name . ' ' . $last_name;
}
function get_current_login_username()
{
    if (isset($_SESSION['client_id'])) {
        $userID = $_SESSION['client_id'];
    }
    $db = getDbInstance();
    $db->where("id", $userID);
    $user = $db->getOne("users");
    $user_name = $user['u_username'];

    return $user_name;
}

function get_jobdesc($jobid)
{
    global $lang;
    $retval = "unknown";

    switch ($jobid) {


        case 1:
            $retval = $lang['staff_job_projmang'];
            break;
        case 2:
            $retval = $lang['staff_job_eng'];
            break;
        case 3:
            $retval = $lang['staff_job_workmang'];
            break;
        case 4:
            $retval = $lang['staff_job_adjustmentchanges'];
            break;
        case 5:
            $retval = $lang['staff_job_manager'];
            break;
    }


    return $retval;
}

function get_staff_name($staffid)
{

    $db = getDbInstance();
    $db->where("id", $staffid);
    $user = $db->getOne("staff");
    $first_name = $user['u_firstname'];
    $last_name = $user['u_lastname'];

    return $first_name . ' ' . $last_name;
}

function get_mobile($number)
{
    $number = strval($number);
    $TOKDMT = substr($number, 0, 3);
    $TOTELF = substr($number, 3);
    $arr['KDMT'] = $TOKDMT;
    $arr['TELE'] = $TOTELF;
    return $arr;
}
function polisa()
{
    $db = getDbInstance();
    $dbtimetorenew = $db->where('setting_name', 'renew_time')->getOne('settings');
    $dbtimetorenew = $dbtimetorenew['setting_value'];
    $renew = $db->rawQuery('UPDATE `polisa` SET `c_status` = 5 WHERE CURDATE() >= DATE_SUB(`c_enddate`, INTERVAL ' . $dbtimetorenew . ' DAY) AND c_status != 1 AND c_polisatype != -1 AND c_status != 2 ');
}
function getdata($table, $data)
{
    $db = getDbInstance();
    $db->where('c_id', $data);
    $data = $db->getOne($table);

    return $data;
}
function getagentsubs($id)
{
    $db = getDbInstance();
    $db->where('c_agentid', $id)->getOne('polisa');
    if ($db->count > 0)
        return 1;
    else
        return 0;
}

function polisa_amount($id)
{
    $db = getDbInstance();
    $sum = $db->rawQuery("SELECT SUM(c_amount) AS sum FROM polisa_price WHERE c_polisaid = $id");
    return $sum[0]['sum'];
}
// function polisa_on_agent($id)
// {
//     $db = getDbInstance();
//     $sum = $db->rawQuery("SELECT SUM(on_agent) AS sum FROM polisa_price WHERE c_polisaid = $id");
//     return $sum[0]['sum'];
// }
function polisa_return_amount($id)
{
    $db = getDbInstance();
    $polisa = $db->where('c_id', $id)->getOne('polisa');
    $days = date_diff_days(date("Y-m-d H:i:s"), $polisa['c_startdate']);
    $sum = $db->rawQuery("SELECT SUM(c_amount) AS sum FROM polisa_price WHERE c_polisaid = $id");
    $sum = $sum[0]['sum'];
    return  round(($sum / 365) * $days);
}

function date_diff_days(String $date1, String $date2)
{
    $datediff = strtotime($date1) - strtotime($date2);

    return round($datediff / (60 * 60 * 24));
}

function getpaymentway($id)
{
    global $lang;
    $assign_arr = array(1 => $lang['credit_card'], 2 => $lang['not_paid'], 3 => $lang['on_agent_account'], 4 => $lang['cash'], 5 => $lang['check'], 6 => $lang['bank_transfer'], 7 => $lang['debit']);

    return $assign_arr[$id];
}

function get_sons($id)
{
    $db = getDbInstance();
    $sons = 0;
    $db->where('role', $id)->get('agents');
    $sons = $db->count > 0 ? 1 : 0;


    return $sons;
}
function get_supplier_agent_import($id, $selected_id)
{
    $db = getDbInstance();
    $suppliers = $db->get('import_func');
    $suppoption = '';
    foreach ($suppliers as $row) {

        $selected = $row['func_name'] == $selected_id ? 'selected' : '';
        // $db->where('supp_id', $row['c_id'])->where('agent_id', $id)->getOne('agent_supp');
        if (STANDALONE)
            $selected = 'selected';
        $suppoption .= "<option value='$row[func_name]' $selected >$row[business_name]</option>";
    }
    return $suppoption;
}
function get_resp_id()
{
    if ($_SESSION['agent_admin_type'] == 'agent') {
        return $_SESSION['agent_id'];
    } else {
        return $_SESSION['agent_for'];
    }
}
function send_polisa_cust($polisa, $price_id, $cust)
{
    global $lang;
    $db = getDbInstance();
    $price = $db->where('c_id', $price_id)->getOne('polisa_price');
    $url = $_SERVER['HTTP_HOST'];

    $_GET['id'] = $polisa['c_id'];
    $_GET['add'] = $price['c_id'];
    $_GET['m'] = 0;

    $filename = $polisa['c_id'] . '-' . date("ymdHis") . '.pdf';
    $data['filename'] = DATE_FOLDER . $filename;
    $db->where('c_id', $price['c_id'])->update('polisa_price', $data);

    include_once("polisa_pdf_inc.php");

    $sms_cont  = $db->where('setting_name', 'sms_cont')->getValue('settings', 'setting_value');
    if ($price['c_paymentway'] == 3) {
        $sms_structure = $sms_cont . "\n
    תעודת מנוי :" . DATA_URL . "/polisa_pdf/$price[filename] \n
    כתב שירות : https://shagrir.senergy-t.co.il/data/ktav_sherot/ktav_sherot240322.pdf
    ";
    } else {
        $sms_structure = $sms_cont . "\n
        תעודת מנוי :" . DATA_URL . "/polisa_pdf/$price[filename] \n
        חשבונית :  " . EZCOUNT_DOC_URL . "/front/documents/printer?doc_uuids=$price[invoice_file] \n
        קבלה :  " . EZCOUNT_DOC_URL . "/front/documents/printer?doc_uuids=$price[recp_file] \n
        כתב שירות : https://shagrir.senergy-t.co.il/data/ktav_sherot/ktav_sherot240322.pdf
        ";
    }
    $history = array(
        "c_userid" => $_SESSION['client_id'],
        "c_ip" => getuserip(),
        "c_insertdate" => date('Y-m-d H:i:s'),
        "c_desc" => $sms_structure,
        "c_typeofaction" => 'cust_send_msg',
        "c_polisa_id" => $polisa['c_id'],
        "usersystemtype" => 'mang',
    );
    $db->insert('polisa_history', $history);

    send_sms($sms_structure, $cust['c_mobile']);

    // $subject = "Rdsynrgy רכישת מנוי";
    // send_email_sub($cust['email'], $cust['email'], $subject, $sms_structure, $price['filename']);
}
function polisa_profit($agent_id)
{
    $db = getDbInstance();


    $db->Where('agent_id', $agent_id);
    $db->where('agent_pay', 0);
    $polisa_price = $db->get('polisa_price');

    $profit_taxes = 0;
    foreach ($polisa_price as $row) {
        if ($row['c_paymentway'] != 2) {
            if ($row['c_paymentway'] == 3) {
                $profit_taxes +=  -$row['on_agent'];
            } else {
                $profit_taxes += $row['c_amount'] - $row['on_agent'];
            }
        }
    }

    return $profit_taxes;
}

function obligo_deduction($agent, $amont)
{
    $db = getDbInstance();
    $data['obligo'] = $agent['obligo'] - $amont;
    $db->where('c_id', $agent['c_id'])->update('agents', $data);
}
function check_agent_activity($id)
{
    $db = getDbInstance();
    $db->where('c_agentid', $id)->get('polisa');
    if ($db->count > 0)
        return true;
    else
        return false;
}

function supp_have_reported_check($suppid)
{
    $db = getDbInstance();
    $supp = $db->where('c_id', $suppid)->getOne('suppliers');
    return $supp['polisa_item_check_accepted'];
}
function supp_have_serviceused_check($suppid)
{
    $db = getDbInstance();
    $supp = $db->where('c_id', $suppid)->getOne('suppliers');
    return $supp['polisa_item_check_service_used'];
}

function supp_check_reported_accepted($suppid, $carnum)
{
    $db = getDbInstance();
    $supp = $db->where('c_id', $suppid)->getOne('suppliers');
    switch ($supp['filename']) {
        case 'shagrir':
            $flag = nashov_isSubscription($carnum);
            break;
    }
    return $flag;
}
function supp_check_service_used($suppid, $carnum, $startdate)
{
    $db = getDbInstance();
    $supp = $db->where('c_id', $suppid)->getOne('suppliers');
    switch ($supp['filename']) {
        case 'shagrir':
            $flag = nashov_car_havecall($carnum, $startdate);
            break;
    }
    return $flag;
}
