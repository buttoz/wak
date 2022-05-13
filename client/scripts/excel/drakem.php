<?
$insdate = date("Y-m-d H:i:s");

$sheet
	->setCellValue("A1", "מס' חברה")
	->setCellValue("B1", "מס' סוכנות")
	->setCellValue("C1", "ענף")
	->setCellValue("D1", "מס' פוליסה")
	->setCellValue("E1", "מס' תוספת")
	->setCellValue("F1", "קוד פעולה")
	->setCellValue("G1", "תאריך תחילה")
	->setCellValue("H1", "תאריך תוספת")
	->setCellValue("I1", "תאריך גמר")
	->setCellValue("J1", "תאריך הצעה")
	->setCellValue("K1", "חודש פרודוקציה")
	->setCellValue("L1", "מס' סוכן")
	->setCellValue("M1", "סוג ביטוח")
	->setCellValue("N1", "קוד כיסוי")
	->setCellValue("O1", "צי רכב")
	->setCellValue("P1", "סכום לתשלום")
	->setCellValue("Q1", "סימן")
	->setCellValue("R1", "מס' רישוי / רכב")
	->setCellValue("S1", "קוד דגם")
	->setCellValue("T1", 'סמ"ק')
	->setCellValue("U1", "משקל")
	->setCellValue("V1", "שנת ייצור")
	->setCellValue("W1", "סוג רכב")
	->setCellValue("X1", "סוג הנעה")
	->setCellValue("Y1", "שם רכב")
	->setCellValue("Z1", "אזעקה")
	->setCellValue("AA1", "נעילת הילוכים או הגה")
	->setCellValue("AB1", "אמוביליייזר")
	->setCellValue("AC1", "איכון")
	->setCellValue("AD1", "מיגון אחר")
	->setCellValue("AE1", "רמת מיגון")
	->setCellValue("AF1", "קוד צבע")
	->setCellValue("AG1", "צבע")
	->setCellValue("AH1", "שם משפחה")
	->setCellValue("AI1", "שם פרטי")
	->setCellValue("AJ1", "ת.ז")
	->setCellValue("AK1", "רחוב")
	->setCellValue("AL1", "מספר בית")
	->setCellValue("AM1", "כניסה")
	->setCellValue("AN1", "שכונה")
	->setCellValue("AO1", "ישוב")
	->setCellValue("AP1", "מיקוד")
	->setCellValue("AQ1", "קידומת טלפון")
	->setCellValue("AR1", "טלפון")
	->setCellValue("AS1", "קידומת טל נייד")
	->setCellValue("AT1", "טלפון נייד")
	->setCellValue("AU1", "פילטר");
$i = 2;
$myprice = 0;
$carrtupes = '';
$price = 0;



$renewpolisa = 0;
$newpolisa = 0;
$carpolisa = 0;
$cancelpolisa = 0;
$db = getDbInstance();
$data = $db->rawQuery("SELECT * FROM  polisa_item  WHERE c_providerid= $rowsupplier[c_id] AND CURDATE() >= CURDATE() ORDER by c_polisaid desc");
$all_items = $db->count;
foreach ($data as $rowf) {

	$price_list = $db->where('c_polisaid', $rowf['c_id'])->get('polisa_price');
	$price = 0;
	foreach ($price_list as $row) {
		$price += $row['c_amount'];
	}
	$polisa = $db->where('c_id', $rowf['c_polisaid'])->getOne('polisa');
	$cust = $db->where('c_id', $polisa['cust_id'])->getOne('customers');
	$car = $db->where('c_id', $polisa['car_id'])->getOne('cars');

	if ($db->count == 0) {
		$car['year_of_prod'] = 0;
		$car['c_degem'] = 0;
		$car['c_carnumber'] = 0;
	}

	if ($polisa['c_polisatype'] > 0 and $rowf['c_status'] != 1)
		$renewpolisa++;
	if ($rowf['c_status'] == 1)
		$cancelpolisa++;

	if ($rowf['c_status'] == 0 and $polisa['c_polisatype'] == 0)
		$newpolisa++;

	$dbcar = getDbInstance();
	$carpolisa = $dbcar->where('polisa_id', $polisa['c_id'])->get('cars');
	$carpolisa = $dbcar->count;
	$updata = array("supp_daily_reported" => 1);
	$db->where('c_id', $rowf['c_id'])->update('polisa_item', $updata);

	$sheet
		->setCellValue("A$i", "00")
		->setCellValue("B$i", "00")
		->setCellValue("C$i", "001")
		->setCellValue("D$i", $rowf['c_id'])
		->setCellValue("E$i", "000")
		->setCellValue("F$i", '00')
		->setCellValue("G$i", date('dmY', strtotime($rowf['c_startdate'])))
		->setCellValue("H$i", '00')
		->setCellValue("I$i", date('dmY', strtotime($rowf['c_enddate'])))
		->setCellValue("j$i", date('dmY', strtotime($rowf['c_insertdate'])))
		->setCellValue("k$i", '00')
		->setCellValue("L$i", "00")
		->setCellValue("M$i", "00")
		->setCellValue("N$i", $rowf['c_code'])
		->setCellValue("O$i", "00")
		->setCellValue("P$i", "$price")
		->setCellValue("Q$i", "00")
		->setCellValue("R$i", $car['c_carnumber'])
		->setCellValue("S$i", $car['c_degem'])
		->setCellValue("T$i", "00")
		->setCellValue("U$i", "00")
		->setCellValue("V$i", $car['year_of_prod'])
		->setCellValue("W$i", "01")
		->setCellValue("X$i", "00")
		->setCellValue("Y$i", "00")
		->setCellValue("Z$i", "0")
		->setCellValue("AA$i", "0")
		->setCellValue("AB$i", "0")
		->setCellValue("AC$i", "0")
		->setCellValue("AD$i", "0")
		->setCellValue("AE$i", "0")
		->setCellValue("AF$i", "0")
		->setCellValue("AG$i", "0")
		->setCellValue("AH$i", $cust['c_firstname'])
		->setCellValue("AI$i", $cust['c_lastname'])
		->setCellValue("AJ$i", $cust['c_idnumber'])
		->setCellValue("AK$i", "0")
		->setCellValue("AL$i", "0")
		->setCellValue("AM$i", "0")
		->setCellValue("AN$i", "0")
		->setCellValue("AO$i", "0")
		->setCellValue("AP$i", "0")
		->setCellValue("AQ$i", "0")
		->setCellValue("AR$i", "0")
		->setCellValue("AS$i", "0")
		->setCellValue("AT$i", "0")
		->setCellValue("AU$i", "0");
	$i++;
}
