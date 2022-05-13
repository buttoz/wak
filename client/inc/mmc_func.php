<?

function MMC_GET_TOKEN()
{

	$db = getDbInstance();
	$db->rawQuery("SELECT * FROM `mmc_token` WHERE `token_datetime` >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 24 HOUR) AND token_value > 0 ");
	if ($db->count == 0) {
		$token = mmc_gettoken();
		$data = array(
			'token_datetime' => date('Y-m-d h:i:s'),
			'token_value' => $token
		);
		$db->delete('mmc_token');
		$db->insert('mmc_token', $data);
	}
}
function check_mmc_items($polisa_id)
{
	$db = getDbInstance();
	$supplier = $db->where('api_code', 'MMC_API')->getOne('suppliers');
	//print_r($db->getLastQuery());
	if ($db->count > 0) {
		$items = $db->where('c_polisaid', $polisa_id)->where('c_providerid', $supplier['c_id'])->where('supp_accept', 0)->get('polisa_item');

		foreach ($items as $row) {
			sendonemmcitem($row);
		}
	}
}


function sendonemmcitem($row)
{

	$db = getDbInstance();
	$polisa = $db->where('c_id', $row['c_polisaid'])->getOne('polisa');
	$cust = $db->where('c_id', $polisa['cust_id'])->getOne('customers');
	$car = $db->where('c_id', $polisa['car_id'])->getOne('cars');

	$test = get_mobile($cust['c_mobile']);
	$db = getDbInstance();
	$data = array(
		"TONAME" => $cust['c_firstname'] . " " . $cust['c_lastname'],
		"TOZHUT" => strval($cust['c_idnumber']),
		"TORHOV" => $cust['city'],
		"TOYSUV" => $cust['city'],
		"TOMKUD" => "",
		"TOTELF" => $test['TELE'],
		"TOKDMT" => $test['KDMT'],
		"TOFIL1" => $row['c_polisaid'],
		"TODTBG" => $row['c_startdate'],
		"TODTEN" => $row['c_enddate'],
		"TORSUI" => strval($car['c_carnumber']),
		"TOYZUR" => strval($car['year_of_prod']),
		"TOSGRC" => "000",
		"TOSRGR" => "000",
		"TOHLFI" => "000",
		"TORDIO" => "000",
		"TOMADF" => "00",
		"TOKSUI" => strval($row['c_code']),
		"TOSGTS" => "9", //! paymentway 
		"TOMHIR" => $row['c_customerprice'],
		"TOTSNO" => "",
		"TOVISA" => "",
		"TOASMM" => "",
		"TOASYY" => "",
		"TOINVO" => "000",
		"TOFAX" => "000",
		"TOCHE1" => "",
		"TOBAN1" => "-1",
		"TOBNS1" => "",
		"TOBNH1" => "",
		"TODTP1" => "1900/01/01",
		"TOMHR1" => "0",
		"TOCHE2" => "",
		"TOBAN2" => "-1",
		"TOBNS2" => "",
		"TOBNH2" => "",
		"TODTP2" => "1900/01/01",
		"TOMHR2" => "0",
		"TOCHE3" => "",
		"TOBAN3" => "-1",
		"TOBNS3" => "",
		"TOBNH3" => "",
		"TODTP3" => "1900/01/01",
		"TOMHR3" => "0",
		"TODTHC" => "1900/01/01",
		"TOSUGT" => 1,
		"TOKDCR" => "143546",
		"TOSMSA" => "",
		"TOMAIL" => "info@signin.co.il",
		"TOSGCR" => "1", //! change
		"TOMAMD" => "000",
		"TOSMKS" => "0",
		"TOFL2" => "12",
		"CreditGuardTransId" => ""
	);

	$data = json_encode($data);
	$result = api_add_polisa($data);
	$result = json_decode($result);
	if ($result->Succeeded) {
		$supp_accept = array(
			"supp_accept" => $result->ATNTOAT->TOHRSA
		);

		$db->where('c_id', $row['c_id'])->update('polisa_item', $supp_accept);
	}
}
