<?php


$db = getDbInstance();
$polisa = $db->where('c_id', $_GET['id'])->getOne('polisa');
$customer = $db->where('c_id', $polisa['cust_id'])->getOne('customers');

$agent = $db->where('c_id', $polisa['c_agentid'])->getOne('agents');
$car = $db->where('c_id', $polisa['car_id'])->getOne('cars');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 018', PDF_HEADER_STRING);

// set header and footer fonts
// $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$lg = array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';
$pdf->setLanguageArray($lg);

$pdf->setFontSubsetting(true);
$fontname = TCPDF_FONTS::addTTFfont(RELATIVE_PATH . '/webfonts/Heebo-VariableFont_wght.ttf', 'TrueTypeUnicode', '', 96);
$pdf->SetFont($fontname, '', 14, '', false);

$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetMargins(PDF_MARGIN_LEFT - 0, PDF_MARGIN_TOP - 0, PDF_MARGIN_RIGHT - 0);
// set some language-dependent strings (optional)
$pdf->AddPage();
if (!STANDALONE) {
	$test = $db->where('url', $_SERVER['SERVER_NAME'])->getValue('clients', 'logo');
	$urlpic = DATA_URL;
	$image_url = $urlpic . "/logo/" . $test;
} else {
	$urlpic = DATA_SYSTEM_URL;
	$test = $db->where('setting_name', 'companylogo')->getValue('settings', 'setting_value');
	$image_url = "https://www.shagrir.co.il/assets/img/logo.png";
}
$pdf->image($image_url, 150, 20, '', '', '', '', 'T', false, 300, '', false, false, 1, false, true, false);
$pdf->setRTL(false);
$date = "<span style='direction:rtl;'> תאריך:  " . date("d-m-Y") . "</span><br><span> שעת הדפסה:  " . date("H:i:s") . "</span>";
$pdf->WriteHTML($date, true, 0, true, 0);
$start = date('d-m-Y', strtotime($polisa['c_startdate']));
$end = date('d-m-Y', strtotime($polisa['c_enddate']));
$pdf->setRTL(true);


$subinfo = '<div></div><h3 style="color:#399294;">';
$subinfo .= "$lang[sub_data]</h3>";
$subinfo .= '
<div class="card-body" style="background-color: #f6f8f7;border-radius: 1%;">

	<table style="border: none;">
	';
$subinfo .= "<tbody>
			<tr>
				<td>
					<h4>שם : </h4>
				</td>
				<td>
					<h5>$customer[c_firstname]  	$customer[c_lastname]</h5>
				</td>
				<td>
					<h4>$lang[polisa_num]</h4>
				</td>
				<td>
					<h5>$polisa[c_id]</h5>
				</td>
			</tr>
			<tr>
				<td>
					<h4>ת.ז :</h4>
				</td>
				<td>
					<h5> $customer[c_idnumber]</h5>
				</td>
				<td>
					<h4>$lang[start_date]: </h4>
				</td>
				<td>
					<h5> $start</h5>
				</td>
			</tr>
			<tr>
				<td>
					<h4>נייד : </h4>
				</td>
				<td>
					<h5> $customer[c_mobile]</h5>
				</td>
				<td>
					<h4>$lang[end_date]:</h4>
				</td>
				<td>
					<h5>$end</h5>
				</td>
			</tr>
			<tr>
				<td>

					<h4>כתובת : </h4>
				</td>
				<td>
					<h5>$customer[c_addr]</h5>
				</td>
			</tr>
		</tbody>
	</table>
	</div>";
$pdf->WriteHTML($subinfo, true, 0, true, 0);

$agentinfo = '
			<h3 style="color:#399294;">פרטי סוכן</h3>

		<div class="card-body" style="background-color: #f6f8f7;border-radius: 1%;">

			<table style="border: none;">
			';

$agentinfo .= "
				<tbody>
					<tr>
						<td>
							<h4>שם : </h4>
						</td>
						<td>
							<h5> $agent[business_name]</h5>
						</td>
					</tr>
					<tr>
						<td>
							<h4>טל : </h4>
						</td>
						<td>
							<h5> $agent[business_tel]</h5>
						</td>
					</tr>
					<tr>
						<td>
							<h4>נייד :</h4>
						</td>
						<td>
							<h5> $agent[a_mobile]</h5>
						</td>
					</tr>
					<tr>
						<td>
							<h4>כתובת : </h4>
						</td>
						<td>
							<h5> $agent[a_addr]</h5>
						</td>
					</tr>
				</tbody>
			</table>					
			</div>";
if ($car) {
	$ivo = $car['c_personalimported'] == 1 ? $lang['yes'] : $lang['no'];
	$carinfo = '
					<h3 style="color:#399294;">פרטי רכב</h3>
				<div class="card-body" style="background-color: #f6f8f7;border-radius: 1%;">
				<table style="border: none;">
					';
	$carinfo .= "<tbody>
							<tr>
								<td>
									<h4>מ.רישוי :</h4>
								</td>
								<td>
									<h5>  $car[c_carnumber]</h5>
								</td>
							</tr>
							<tr>
								<td>
									<h4>ש.יצור : </h4>
								</td>
								<td>
									<h5> $car[year_of_prod]</h5>
								</td>
							</tr>
							<tr>
								<td>
									<h4>יבוא אישי : </h4>
								</td>
								<td>
									<h5>$ivo</h5>
								</td>
							</tr>
							</tbody>
					</table>
				</div>
			";
}

$pdf->resetColumns();

$pdf->setEqualColumns(2, 84);  // KEY PART -  number of cols and width
$pdf->selectColumn(0);
$pdf->writeHTML($agentinfo, true, false, true, false);
$pdf->selectColumn(1);
$pdf->writeHTML($carinfo, true, false, true, false);
$pdf->resetColumns();



$table = '
<h3></h3>
<table style="border: none;">
					<tbody>
						<tr>
							<td style="color:#399294;">
								<h3>ספק שירות</h3>
							</td>
							<td style="color:#399294;">
								<h3>כיסויים</h3>
							</td>
						</tr>

';

if ($_GET['add'] != -1)
	$db->where('c_polisapriceid', $_GET['add']);
else
	$db->where('c_polisaid', $_GET['id']);
$polisa_item = $db->get('polisa_item');
foreach ($polisa_item as $row) {
	$db->where('c_id', $row['prod_id']);
	$prod = $db->getOne('provider_price');
	$supplier = $db->where('c_id', $row['c_providerid'])->getOne('suppliers');
	//$image = base64_encode(file_get_contents("$datasystemurl/logo/$supplier[logo]"));

	$table .= '<tr style="border:1px solid black; background-color: #000000; padding:1em">
				<td>
				';
	// <img style="max-width: 90px;margin-top: 20px;" src="' . $image . '" alt="suppimg">
	$table .= "
					<h5> $supplier[business_name] </h5>
					<h5> $supplier[business_tel] </h5>
				 </td>
				 <td>
					<h4>$prod[c_code] - $prod[description] </h4>
				 </td>
				</tr>
				";
}
$table .= "
					</tbody>
				</table>
				";
$pdf->writeHTML($table, true, false, true, false);

$pay = '
	<h3 style="color:#399294;">תשלומים</h3>
<div class="card-body" style="background-color: #f6f8f7;border-radius: 1%;">
<table  style="border: none;">
		<tbody>
		';

$assign_arr = array(1 => $lang['credit_card'], 2 => $lang['not_paid'], 3 => $lang['on_agent_account'], 4 => $lang['cash'], 5 => $lang['check'], 6 => $lang['bank_transfer'], 7 => $lang['debit']);
$i = 0;

if ($_GET['add'] != -1)
	$db->where('c_polisapriceid', $_GET['add']);
else
	$db->where('c_polisaid', $_GET['id']);
$polisa_item = $db->groupBy('c_polisapriceid')->get('polisa_item');
foreach ($polisa_item as $row) {
	$db->where('c_id', $row['c_polisapriceid']);
	$price = $db->getOne('polisa_price');
	$i++;
	$flag = $_GET['m'] == 0 ? $price['c_amount'] : 0;
	$payway = $assign_arr[$price['c_paymentway']];
	$pay .= "
				<tr>
					<td>
						<h4>$lang[add_num] : $i</h4>
					</td>
					<td>
						<h4>&#8362; $flag</h4>

					</td>
					<td>
						<h4>$payway</h4>
					</td>
				</tr>
				<tr><td><hr></td></tr>
				";
}
$pay .= "

		</tbody>
	</table>
</div>
</div>
";
$text = $db->where('setting_name', 'more_info')->getValue('settings', 'setting_value');
$pay .= isset($text) ? $text : '';


$pdf->writeHTML($pay, true, 0, true, 0);




$filename =  date("Y") . "/" . date("m") . "/" . $filename;
$target_dir = DATA_PATH . "/polisa_pdf/";
if (!file_exists($target_dir . "/" . date("Y")))
	mkdir($target_dir . "/" . date("Y"));
if (!file_exists($target_dir . DATE_FOLDER))
	mkdir($target_dir . DATE_FOLDER);

$pdf->Output($target_dir . $filename, 'F');

if (STANDALONE) {
	$to = $customer['c_mobile'];
	include("sendpdf.php");
}
