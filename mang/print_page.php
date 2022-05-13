<?php
require_once './config/db/config.php';
require_once './languages/he.lang.php';

$db = getDbInstance();
$polisa = $db->where('c_id', $_GET['id'])->getOne('polisa');
$customer = $db->where('c_id', $polisa['cust_id'])->getOne('customers');
$agent = $db->where('c_id', $polisa['c_agentid'])->getOne('agents');
$car = $db->where('c_id', $polisa['car_id'])->getOne('cars');
?>

<head>
	<meta charset="utf-8">
	<title></title>
	<style>
		@page {
			size: A4
		}

		body {
			font-family: 'Rubik', sans-serif;
			font-size: 14px;

		}

		.tdtitle {
			background: #83848b;
			text-align: center;
			color: #fff;
		}

		td {
			border: 1px solid #f9f9f9;
			background: #fbfbfb;

		}
	</style>

</head>

<body class="A4" dir="rtl" onload="window.print()">
	<section class="sheet padding-10mm">

		<article>
				<img style=" width: 100px;" src="<?= DATA_URL ?>/logo/signin-logo.png" border="0">


			<table width="100%" cellpadding="4" style="margin-top:32px;" border="1">
				<tr>
					<td colspan="4" class="tdtitle"><? echo $lang['sub_data'] ?></td>
				</tr>
				<tr>
					<?
						$start = date("d-m-Y",strtotime($polisa['c_startdate']));			
						$end = date("d-m-Y",strtotime($polisa['c_enddate']));				
				?>
					<td><? echo $lang['polisa_num'] . " : " . $polisa['c_id'] ?></td>
					<td><? echo $lang['start_date'] . " : " . $start ?></td>
					<td><? echo $lang['end_date'] . " : " . $end ?></td>
				</tr>
				<tr>
					<td>שם : <?= $customer['c_firstname'] . " " . $customer['c_lastname']; ?></td>
					<td>ת.ז : <?= $customer['c_idnumber']; ?></td>
					<td>נייד : <?= $customer['c_mobile']; ?></td>
					<td>כתובת : <?= $customer['c_addr']; ?></td>
				</tr>
			</table>
			<table width="100%" cellpadding="4" style="margin-top:32px;" border="1">
				<tr>
					<td colspan="4" class="tdtitle">פרטי סוכן</td>
				</tr>
				<tr>
					<td>שם : <?= $agent['business_name']; ?></td>
					<td>טל : <?= $agent['business_tel']; ?></td>
					<td>נייד : <?= $agent['a_mobile']; ?></td>
					<td>כתובת : <?= $agent['a_addr']; ?></td>
				</tr>
			</table>
			<?


			if ($car) {
			?>
				<table width="100%" cellpadding="4" style="margin-top:32px;" border="1">

					<tr>
						<td colspan="4" class="tdtitle">פרטי רכב</td>
					</tr>
					<tr>

						<td nowrap>מ.רישוי : <?= $car['c_carnumber']; ?></td>
						<td nowrap>ש.יצור : <?= $car['c_degem']; ?></td>
						<td nowrap>יבוא אישי : <?= $car['c_personalimported'] == 1 ? $lang['yes'] : $lang['no']; ?></td>
					</tr>
				</table>
			<?
			}
			?>
			<table width="100%" cellpadding="4" style="margin-top:32px;" border="1">

				<tr>
					<td colspan="2" class="tdtitle">כיסויים</td>
				</tr>
				<tbody>
					<?
					if ($_GET['add'] != -1)
						$db->where('c_polisapriceid', $_GET['add']);
					else
						$db->where('c_polisaid', $_GET['id']);
					$polisa_item = $db->get('polisa_item');
					foreach ($polisa_item as $row) {

						$db->where('c_id', $row['prod_id']);
						$prod = $db->getOne('provider_price');
					?>
						<tr>
							<td><?= $prod['description'] ?></td>
						</tr>
					<?
					}
					?>
					<tr></tr>
				</tbody>


			</table>
			<table width="100%" cellpadding="4" style="margin-top:32px;" border="1">

				<tr>
					<td colspan="2" class="tdtitle">תשלומים</td>
				</tr>
				<?
                                    $assign_arr = array(1 => $lang['credit_card'], 2 => $lang['not_paid'], 3 => $lang['on_agent_account'], 4 => $lang['cash'], 5 => $lang['check'], 6 => $lang['bank_transfer'], 7 => $lang['debit']);

				foreach ($polisa_item as $row) {
					$db->where('c_id', $row['c_polisapriceid']);
					$price = $db->getOne('polisa_price');
				?>
					<tr>
						<td>&#8362;<?= $_GET['m'] == 0 ? $price['c_amount'] : 0 ?></td>
						<td><?= $assign_arr[$price['c_paymentway']] ?></td>
					</tr>
				<?
				} ?>

			</table>

			<!-- <table width="100%" cellpadding="4" style="margin-top:32px;" border="1">

					<tr>
						<td colspan="2" class="tdtitle">הערות</td>
					</tr>
					<tr>
						<td><? //=// date('Y-m-d h:i:s') 
							?></td>
					</tr>
				</table> -->

			<center style="margin-top:32px;">
				<p>
					ת.וזמן הדפסת מנוי :
					<?= date("d-m-Y H:i:s"); ?>
				</p>
			</center>
			<div>
				כל השירותים שנרכשו במנוי זה, הינם בכפוף לכתב השירות של כל אחת מהחברות. (יש לבקש כתבי השירות מהסוכן)
			</div>
			<Div style="clear:Both"></div>
			<div style="margin-top:12px">
				כל השירותים ו/או הכיסויים אשר נרכשו במנוי זה, הינם באחריותה הבלעדית של החברה המשווקת, ואין סינרגיה אחראית לכל בעיה ו/או תקלה ו/או כל דבר אחר הנובעים מהשירות דלעיל.


			</div>
			<div>
				<?
				if ($car['c_personalimported'] == 2) {
				?>
					<h3 style="color:#ca2828">
						לתשומת לבכם... אין כיסוי לשמשות שנרכשו עבור רכב יבוא אישי עד לקבלת אישור בכתב מהחברה מספקת השירת.
						יש לפנות לסוכן הביטוח לצורך המצאת האישור ו/או לסייע ולעזור לכם לשם כך.
					</h3>
				<?
				}
				?>
			</div>
		</article>

	</section>

</body>

</html>