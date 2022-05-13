<?php

// include('inc/config.inc.php');

use function PHPSTORM_META\sql_injection_subst;

require_once '../../config/db/config.php';
require_once '../../languages/he.lang.php';

// include('inc/glob.php');
// register_globals();


/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */
require_once '../../../vendor/autoload.php';

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
date_default_timezone_set('Asia/Jerusalem');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browsupplierser');

$insdate = date("Y-m-d H:i:s");

$db = getDbInstance();

$suppliers = $db->where('report_type', 0)->get('suppliers');
foreach ($suppliers as $rowsupplier) {

	$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

	$sheet = $spreadsheet->getActiveSheet();

	// Add some data
	$createdate = date("Y-m-d H:i:s");



	include_once $rowsupplier['filename'] . ".php";

	// Rename worksheet
	$sheet->setRightToLeft(true);
	$sheet->setTitle($rowsupplier['filename']);
	if (isset($_GET['file']) and $_GET['file'] == 'csv') {
		$writer = new PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
		$writer->setUseBOM(true); // to shwo hebrew charatcters
		$name = $rowsupplier['c_id'] . "-" . date("YmdHis") . ".csv";
	} elseif (!isset($_GET['file']) or $_GET['file'] == 'xlsx') {
		$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
		$name = $rowsupplier['c_id'] . "-" . date("YmdHis") . ".xlsx";
	}
	$filepath = DATA_PATH . "/reports/" . $rowsupplier['filename'] . "-" . $name;

	$writer->save($filepath);

	require_once "../../utility/mail/fun_mail.php";

	$mails = $rowsupplier['report_email'];

	$mails = explode(',', $mails);


	$to = $mails[0];
	array_shift($mails);

	$data = array(
		'company' => $rowsupplier['c_id'],
		'file' => $rowsupplier['filename'] . "-" . $name,
		'insdate' => $createdate,
		'email' => $to,
		'total' => $all_items,
		'total_renew' => $renewpolisa,
		'total_cancel' => $cancelpolisa,
		'total_new' => $new_items,
		'total_car' => $carpolisa,
	);

	$db->insert('sup_reported_daily', $data);

	$cc = array();
	if (!isset($_POST['send_flag'])) {
		foreach ($mails as $one) {
			$cc[] = $one;
		}
		$cc = implode(',', $cc);

		$subject = $lang['dailyreports'] . "_" . date("d/m/Y");
		$body = 'Test';
		send_email($to, $cc, $subject, $body, $filepath, $arr = array());
	}
}
