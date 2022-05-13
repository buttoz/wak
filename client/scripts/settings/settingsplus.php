<style>
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	input[type=number] {
		-moz-appearance: textfield;
	}
</style>

<?php

use \Gumlet\ImageResize;

// if (!have_permission('agent_edit')) {
//     echo '<div class="permissiondenied">Permission Denied</div>';
//     exit();
// }

if (isset($_POST['abouteditor_submit'])) {
	$db = getDbInstance();
	$db->where('setting_name', 'contact_text')->getOne('settings');
	$data = array(
		'setting_name' => 'contact_text',
		'setting_value' => $_POST['about_us'],
	);
	if ($db->count > 0)
		$db->where('setting_name', 'contact_text')->update('settings', $data);
	else
		$db->insert('settings', $data);
}
if (isset($_POST['more_info_submit'])) {
	$db = getDbInstance();
	$db->where('setting_name', 'more_info')->getOne('settings');
	$data = array(
		'setting_name' => 'more_info',
		'setting_value' => $_POST['more_info'],
	);
	if ($db->count > 0)
		$db->where('setting_name', 'more_info')->update('settings', $data);
	else
		$db->insert('settings', $data);
}

$backoofice_path = dirname(__DIR__, 2);

$updateuseractive1 = 'active';
$updateuseractive2 = 'show active';
$tknon1 = '';
$tknon2 = '';
if (isset($_POST['teknon'])) {
	$tknon1 = 'active';
	$tknon2 = 'show active';
	$updateuseractive1 = '';
	$updateuseractive2 = '';
}
$db = getDbInstance();
$logo = $db->where('setting_name', 'companylogo')->getOne('settings');
$favicon = $db->where('setting_name', 'favicon')->getOne('settings');

?>

<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<h3 class="card-title"><?PHP echo $lang['general_setting'] ?></h3>
						</div>

					</div>
					<div class="card-body">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link <?= $updateuseractive1 ?>" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo $lang['general']; ?></a>
							</li>
							<!-- <li class="nav-item">
								<a class="nav-link <?= $tknon1 ?>" id="tknon-tab" data-toggle="tab" href="#tknon" role="tab" aria-controls="tknon" aria-selected="false"><?php echo $lang['tknon']; ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="sms_cont-tab" data-toggle="tab" href="#sms_cont" role="tab" aria-controls="sms_cont" aria-selected="false"><?php echo $lang['sms_cont']; ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="editor_contact_us-tab" data-toggle="tab" href="#editor_contact_us" role="tab" aria-controls="editor_contact_us" aria-selected="false"><?php echo $lang['contact_us']; ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="editor_more_info-tab" data-toggle="tab" href="#editor_more_info" role="tab" aria-controls="editor_more_info" aria-selected="false"><?php echo $lang['more_info']; ?></a>
							</li> -->
						</ul>
						<div class="tab-content" id="myTabContent">

							<div class="tab-pane <?= $updateuseractive2 ?>" id="home" role="tabpanel" aria-labelledby="home-tab">

								<form autocomplete="false" class="well form-horizontal" action=" " method="post" id="paymentways_select" enctype="multipart/form-data">
									<?
									$db = getDbInstance();
									$del_code = $db->where('setting_name', 'del_code')->getOne('settings');
									if ($db->count == 0)
										$del_code['setting_value'] = 0;
									?>
									<fieldset>
										<div class="row">
											<div class="row p-2">
												<div class="col-md-12">
													<label for="new_del_code"><?= $lang['del_code'] ?></label>
													<input type="number" class="form-control" name="new_del_code" id="new_del_code" value="<?= $del_code['setting_value'] ?>">
												</div>
											</div>
										</div>
									</fieldset>
									<?/*
									$db = getDbInstance();
									$time = $db->where('setting_name', 'renew_time')->getOne('settings');
									if ($db->count == 0)
										$time['setting_value'] = 0;

									?>
									<fieldset>
										<div class="row ">
											<div class="row p-2">
												<div class="col-md-12">
													<label for="new_renew_time"><?= $lang['renew_time_days'] ?></label>
													<input type="number" class="form-control" name="new_renew_time" id="new_renew_time" value="<?= $time['setting_value'] ?>">
												</div>
											</div>
										</div>
									</fieldset>
									<fieldset>
										<div class="row">
											<div class="row p-2">
												<div class="col-md-12">
													<?
													$db = getDbInstance();
													$min_time = $db->where('setting_name', 'min_sub_time')->getOne('settings');
													if ($db->count == 0)
														$min_time['setting_value'] = 180;

													?>
													<label for="min_sub_time"><?= $lang['min_sub_time'] ?></label>
													<input type="number" class="form-control" name="min_sub_time" id="min_sub_time" value="<?= $min_time['setting_value'] ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="row p-2">
												<div class="col-md-12">
													<?
													$db = getDbInstance();
													$mail = $db->where('setting_name', 'agent_data_mail')->getValue('settings', 'setting_value');
													?>
													<label for="agent_data_mail"><?= $lang['mang_send_email'] ?></label>
													<input type="email" class="form-control" name="agent_data_mail" id="agent_data_mail" value="<?= $mail ?>">
												</div>
											</div>
										</div>
										*/ ?>
									<br>
									<div class="row">
										<div class="col-md-6" style="border-left: 0.3px solid grey;">
											<input accept="image/*" type="file" name="logo" id="imgInp">
											<img style="max-width: 150px;" id="blah" name="logo" src="<?= DATA_URL ?>/logo/<?= $logo['setting_value'] ?>" alt="your image">
										</div>
										<div class="col-md-6">
											<input accept="image/*" type="file" name="favicon" id="imgInpfavi">
											<img style="max-width: 150px;" id="blahfavicon" name="favicon" src="<?= DATA_URL ?>/favicon/<?= $favicon['setting_value'] ?>" alt="your image">
										</div>
									</div>
									<br>
									<br>
									<div class="">
										<input type="submit" value="<?php echo $lang['save'] ?>" class="btn btn-success"></button>
									</div>
									</fieldset>


								</form>

							</div>
							
							</div>
						</div>

					</div>

				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->


	</section>
</div>