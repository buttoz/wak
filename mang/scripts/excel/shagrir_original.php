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
	->setCellValue("J1", "תאריך הפקה")
	->setCellValue("K1", "חודש פרודוקציה")
	->setCellValue("L1", "מס' סוכן")
	->setCellValue("M1", "שם סוכן")
	->setCellValue("N1", "סוג ביטוח")
	->setCellValue("O1", "קוד כיסוי")
	->setCellValue("P1", "צי רכב")
	->setCellValue("Q1", "סכום לתשלום")
	->setCellValue("R1", "סימון")
	->setCellValue("S1", "מספר רישוי")
	->setCellValue("T1", 'קוד דגם רב')
	->setCellValue("U1", 'סמ"ק')
	->setCellValue("V1", "משקל")
	->setCellValue("W1", "שנת ייצור")
	->setCellValue("X1", "סוג רכב")
	->setCellValue("Y1", "סוג הנעה")
	->setCellValue("Z1", "שם יצרן ודגם שיווקי")
	->setCellValue("AA1", "שם משפחה + פרטי")
	->setCellValue("AB1", "ת.ז.")
	->setCellValue("AC1", "כתובת")
	->setCellValue("AD1", "מיקוד")
	->setCellValue("AE1", "ישוב")
	->setCellValue("AF1", "טלפון")
	->setCellValue("AG1", "תאריך מקור")
	->setCellValue("AH1", "מספר קולקטיב")
	->setCellValue("AI1", "שם קולקטיב")
	->setCellValue("AJ1", "ימי זכאות לרכב חלופי")
	->setCellValue("AK1", "סינרגיה מחיר קטלוגי")
	->setCellValue("AL1", "סינרגיה מחיר לסוכן")
	->setCellValue("AM1", "סינרגיה סכום עמלה")
	->setCellValue("AN1", "מס חשבונית")
	->setCellValue("AO1", "קבוצת השתייכות")
	->setCellValue("AP1", "מס שובר/מס סליקה")
	->setCellValue("AQ1", "מס קבלה")
	->setCellValue("AR1", "סכום חשבונית")
	->setCellValue("AS1", "סכום קבלה")
	->setCellValue("AT1", "מספר סליקה המקורי")
	->setCellValue("AU1", "4 ספרות אחרונות כ.א.")
	->setCellValue("AV1", "סכום של הסליקה")
	->setCellValue("AW1", 'ת"ז/ח"פ משלם');
$i = 2;
$myprice = 0;
$carrtupes = '';
$price = 0;



$renewpolisa = 0;
$newpolisa = 0;
$carpolisa = 0;
$cancelpolisa = 0;
$db = getDbInstance();
$dbprice = getDbInstance();
// $datesql = date("Y-m-d", strtotime("-1 days"));
// $datesql = '2022-05-01';
// $data = $db->rawQuery("SELECT * FROM  polisa_item  WHERE c_providerid= $rowsupplier[c_id] AND date(c_insertdate) > DATE('$datesql') ORDER by c_polisaid desc");
$data = $db->rawQuery("SELECT * FROM  polisa_item  WHERE c_providerid= $rowsupplier[c_id] AND supp_daily_reported = 0 ORDER by c_polisaid desc");
$all_items = $db->count;
foreach ($data as $rowf) {

	// $price_list = $db->where('c_polisaid', $rowf['c_id'])->get('polisa_price');
	// $price = 0;
	// foreach ($price_list as $row) {
	// 	$price += $row['c_amount'];
	// }

	$agent = $db->where('c_id', $rowf['c_agentid'])->getOne('agents');
	if ($db->count > 0)
		if ($agent['role'] > 0) {
			$dad_agent = $db->where('c_id', $agent['role'])->getOne('agents');
			$dad_id = $dad_agent['c_id'];
		} else
			$dad_id = $agent['c_id'];
	else
		$dad_id = 0;

	$polisa = $db->where('c_id', $rowf['c_polisaid'])->getOne('polisa');
	if ($db->count > 0) {
		$car_type = $db->where('c_id', $polisa['car_type'])->getOne('car_types');
		$cust = $db->where('c_id', $polisa['cust_id'])->getOne('customers');
		$provider_price = $db->where('c_id', $rowf['prod_id'])->getOne('provider_price');
		$polisa_price = $dbprice->where('c_polisaid', $polisa['c_id'])->orderBy('c_id', 'DESC')->getOne('polisa_price');
		//echo $dbprice->getLastQuery();
	}
	$car = $db->where('c_id', $polisa_price['car_id'])->getOne('cars');
	//echo $dbprice->count;
	$startdate = date('Ymd', strtotime($rowf['c_startdate']));
	$return_money = 1;
	$payer_id = 0;
	$recipt_am = 0;
	$original_trans_id = 0;

	if ($polisa_price['c_paymentway'] == 1) {
		$visa = $db->where('pid', $polisa_price['c_id'])->getOne('recp_visa');
		if (isset($visa['return_amount']) and $visa['return_amount'] > 0)
			$return_money = -1;

		if ($db->count > 0) {
			$invoce = $visa['recipt_number'];
			$recipt = $visa['invoice_num'];
			$trans_id = $visa['trans_id'];
			$original_trans_id = 0;
			$visanum = $visa['visanum'];
			$recipt_am = $polisa_price['c_amount'];
			$payer_id = $visa['payer_id'];
		} else {
			$invoce = 0;
			$recipt = 0;
			$trans_id = 0;
			$visanum = 0;
			$recipt_am = 0;
			$visa = 0;
			$payer_id = 0;
		}
	} elseif ($polisa_price['c_paymentway'] == 3) {
		$invoce = $polisa_price['invoice_number'];
		$trans_id = 0;
		$visanum = 0;
		$recipt = 0;
		$recipt_am = 0;
		$payer_id = 0;
	} else {
		$invoce = 0;
		$recipt = 0;
		$trans_id = 0;
		$visanum = 0;
		$recipt_am = 0;
		$payer_id = 0;
	}
	$car_type['c_name'] = isset($car_type['c_name']) ? $car_type['c_name'] : 0;
	if ($db->count > 0 and $dbprice->count > 0 and $polisa_price['c_paymentway'] != 2 and !empty($car)) {



		if ($polisa['c_polisatype'] > 0 and $rowf['c_status'] != 1)
			$renewpolisa++;
		if ($rowf['c_status'] == 1)
			$cancelpolisa++;

		if ($rowf['c_status'] == 0 and $polisa['c_polisatype'] == 0)
			$newpolisa++;

		// $dbcar = getDbInstance();
		// $carpolisa = $dbcar->where('polisa_id', $polisa['c_id'])->get('cars');
		// $carpolisa = $dbcar->count;

		$status = '00';
		if ($rowf['c_status'] == 1) {
			$status = '01';
			$startdate = date('Ymd', strtotime($rowf['c_provider_cancelled_date']));
			$return_money = -1;
			$invoce = $polisa_price['return_invoice_number'];
			$recipt = $polisa_price['return_recp_number'];
			if ($polisa_price['c_paymentway'] == 1) {
				$return_visa = $db->where('pid', $polisa_price['c_id'])->where('return_amount', 0, ">")->getOne('recp_visa');
				$trans_id = $return_visa['trans_id'];
				$original_trans_id = $return_visa['original_trans_id'];
				$recipt_am = $return_visa['return_amount'];
			}
		} elseif ($polisa['c_polisatype'] > 0) {
			$status = '06';
		}
		$toseft = 0;
		$updata = array("supp_daily_reported" => 1);
		$db->where('c_id', $rowf['c_id'])->update('polisa_item', $updata);

		$sheet
			->setCellValue("A$i", "8242")
			->setCellValue("B$i", $dad_id)
			->setCellValue("C$i", "001")
			->setCellValue("D$i", $polisa['c_id'])
			->setCellValue("E$i", $toseft++)
			->setCellValue("F$i", $status)
			->setCellValue("G$i", $startdate)
			->setCellValue("H$i", date('Ymd', strtotime($rowf['c_insertdate'])))
			->setCellValue("I$i", date('Ymd', strtotime($rowf['c_enddate'])))
			->setCellValue("j$i", date('Ymd', strtotime($rowf['c_insertdate'])))
			->setCellValue("k$i", date('mY', strtotime($rowf['c_startdate'])))
			->setCellValue("L$i", $agent['c_id'])
			->setCellValue("M$i", $agent['business_name'])
			->setCellValue("N$i", '1')
			->setCellValue("O$i", $rowf['c_code'])
			->setCellValue("P$i", '0')
			->setCellValue("Q$i", $polisa_price['on_agent'] * $return_money)
			->setCellValue("R$i", '0')
			->setCellValue("S$i", $car['c_carnumber'])
			->setCellValue("T$i", $car['code_degem_rav'])
			->setCellValue("U$i", $car['car_engine'])
			->setCellValue("V$i", $car['car_weight'])
			->setCellValue("W$i", $car['year_of_prod'])
			->setCellValue("X$i", $car_type['car_code'])
			->setCellValue("Y$i", $car['drive_wheel_type'])
			->setCellValue("Z$i", $car['car_model'])
			->setCellValue("AA$i", $cust['c_firstname'] . " " . $cust['c_lastname'])
			->setCellValue("AB$i", $cust['c_idnumber'])
			->setCellValue("AC$i", $cust['street'])
			->setCellValue("AD$i", $cust['mikod'])
			->setCellValue("AE$i", $cust['city'])
			->setCellValue("AF$i", $cust['c_mobile'])
			->setCellValue("AG$i", date("Ymd"))
			->setCellValue("AH$i", '0')
			->setCellValue("AI$i", '0')
			->setCellValue("AJ$i", '0')
			->setCellValue("AK$i", $provider_price['agent_price'] * $return_money)
			->setCellValue("AL$i", $polisa_price['c_amount'] * $return_money)
			->setCellValue("AM$i", $polisa_price['profit'] * $return_money)
			->setCellValue("AN$i", $invoce)
			->setCellValue("AO$i", "166")
			->setCellValue("AP$i", $trans_id)
			->setCellValue("AQ$i", $recipt)
			->setCellValue("AR$i", $polisa_price['c_amount'] * $return_money)
			->setCellValue("AS$i", $recipt_am * $return_money)
			->setCellValue("AT$i", $original_trans_id)
			->setCellValue("AU$i", $visanum)
			->setCellValue("AV$i", $recipt_am * $return_money)
			->setCellValue("AW$i", $payer_id);

		if ($rowf['c_status'] == 1 and date("Y-m-d", strtotime($rowf['c_provider_cancelled_date'])) == date("Y-m-d", strtotime($rowf['c_insertdate']))) {
			echo "1";
			$i++;
			$status = '00';
			$startdate = date('Ymd', strtotime($rowf['c_insertdate']));
			$return_money = 1;
			$invoce = $polisa_price['invoice_number'];
			$recipt = $polisa_price['recipt_number'];
			if ($polisa_price['c_paymentway'] == 1) {
				$trans_id = $visa['trans_id'];
			}

			$sheet
				->setCellValue("A$i", "8242")
				->setCellValue("B$i", $dad_id)
				->setCellValue("C$i", "001")
				->setCellValue("D$i", $polisa['c_id'])
				->setCellValue("E$i", $toseft++)
				->setCellValue("F$i", $status)
				->setCellValue("G$i", $startdate)
				->setCellValue("H$i", date('Ymd', strtotime($rowf['c_insertdate'])))
				->setCellValue("I$i", date('Ymd', strtotime($rowf['c_enddate'])))
				->setCellValue("j$i", date('Ymd', strtotime($rowf['c_insertdate'])))
				->setCellValue("k$i", date('mY', strtotime($rowf['c_startdate'])))
				->setCellValue("L$i", $agent['c_id'])
				->setCellValue("M$i", $agent['business_name'])
				->setCellValue("N$i", '1')
				->setCellValue("O$i", $rowf['c_code'])
				->setCellValue("P$i", '0')
				->setCellValue("Q$i", $polisa_price['on_agent'] * $return_money)
				->setCellValue("R$i", '0')
				->setCellValue("S$i", $car['c_carnumber'])
				->setCellValue("T$i", $car['code_degem_rav'])
				->setCellValue("U$i", $car['car_engine'])
				->setCellValue("V$i", $car['car_weight'])
				->setCellValue("W$i", $car['year_of_prod'])
				->setCellValue("X$i", $car_type['car_code'])
				->setCellValue("Y$i", $car['drive_wheel_type'])
				->setCellValue("Z$i", $car['car_model'])
				->setCellValue("AA$i", $cust['c_firstname'] . " " . $cust['c_lastname'])
				->setCellValue("AB$i", $cust['c_idnumber'])
				->setCellValue("AC$i", $cust['street'])
				->setCellValue("AD$i", $cust['mikod'])
				->setCellValue("AE$i", $cust['city'])
				->setCellValue("AF$i", $cust['c_mobile'])
				->setCellValue("AG$i", date("Ymd"))
				->setCellValue("AH$i", '0')
				->setCellValue("AI$i", '0')
				->setCellValue("AJ$i", '0')
				->setCellValue("AK$i", $provider_price['agent_price'])
				->setCellValue("AL$i", $polisa_price['c_amount'])
				->setCellValue("AM$i", $polisa_price['profit'])
				->setCellValue("AN$i", $invoce)
				->setCellValue("AO$i", "166")
				->setCellValue("AP$i", $trans_id)
				->setCellValue("AQ$i", $recipt)
				->setCellValue("AR$i", $polisa_price['c_amount'])
				->setCellValue("AS$i", $recipt_am)
				->setCellValue("AT$i", "0")
				->setCellValue("AU$i", $visanum)
				->setCellValue("AV$i", $recipt_am * $return_money)
				->setCellValue("AW$i", $payer_id);
		}
		$car = $db->where('polisa_id', $polisa['c_id'])->orderBy('c_id', 'desc')->get('cars');
		if ($db->count > 1) {
			$i++;
			$car = $car[0];
			$sheet
				->setCellValue("A$i", "8242")
				->setCellValue("B$i", $dad_id)
				->setCellValue("C$i", "001")
				->setCellValue("D$i", $polisa['c_id'])
				->setCellValue("E$i", $toseft++)
				->setCellValue("F$i", '04')
				->setCellValue("G$i", $startdate)
				->setCellValue("H$i", date('Ymd', strtotime($rowf['c_insertdate'])))
				->setCellValue("I$i", date('Ymd', strtotime($rowf['c_enddate'])))
				->setCellValue("j$i", date('Ymd', strtotime($rowf['c_insertdate'])))
				->setCellValue("k$i", date('mY', strtotime($rowf['c_startdate'])))
				->setCellValue("L$i", $agent['c_id'])
				->setCellValue("M$i", $agent['business_name'])
				->setCellValue("N$i", '1')
				->setCellValue("O$i", $rowf['c_code'])
				->setCellValue("P$i", '0')
				->setCellValue("Q$i", '0')
				->setCellValue("R$i", '0')
				->setCellValue("S$i", $car['c_carnumber'])
				->setCellValue("T$i", $car['code_degem_rav'])
				->setCellValue("U$i", $car['car_engine'])
				->setCellValue("V$i", $car['car_weight'])
				->setCellValue("W$i", $car['year_of_prod'])
				->setCellValue("X$i", $car_type['car_code'])
				->setCellValue("Y$i", $car['drive_wheel_type'])
				->setCellValue("Z$i", $car['car_model'])
				->setCellValue("AA$i", $cust['c_firstname'] . " " . $cust['c_lastname'])
				->setCellValue("AB$i", $cust['c_idnumber'])
				->setCellValue("AC$i", $cust['street'])
				->setCellValue("AD$i", $cust['mikod'])
				->setCellValue("AE$i", $cust['city'])
				->setCellValue("AF$i", $cust['c_mobile'])
				->setCellValue("AG$i", date("Ymd"))
				->setCellValue("AH$i", '0')
				->setCellValue("AI$i", '0')
				->setCellValue("AJ$i", '0')
				->setCellValue("AK$i", '0')
				->setCellValue("AL$i", '0')
				->setCellValue("AM$i", '0')
				->setCellValue("AN$i", '')
				->setCellValue("AO$i", "166")
				->setCellValue("AP$i", '')
				->setCellValue("AQ$i", '')
				->setCellValue("AR$i", '0')
				->setCellValue("AS$i", '0')
				->setCellValue("AT$i", "0")
				->setCellValue("AU$i", '')
				->setCellValue("AV$i", "0")
				->setCellValue("AW$i", '');
		}

		$i++;
	}
}
