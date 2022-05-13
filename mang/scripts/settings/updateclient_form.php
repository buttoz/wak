<fieldset>
	<div class="row">

		<div class="col-md-2">
			<div class="form-group">
				<label for="client_type"><?= $lang['client_type'] ?></label>
				<select name="client_type" id="client_type" class="form-control" required>
					<option value=""><?= $lang['choose_client_type'] ?></option>
					<option value="1" <?= $user['client_type'] == 1 ? 'selected' : '' ?>><?= $lang['a.m.'] ?></option>
					<option value="2" <?= $user['client_type'] == 2 ? 'selected' : '' ?>><?= $lang['company'] ?></option>
				</select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="inputName"><?php echo $lang['business_id_number'] ?></label>
				<div class="useridnumber form-add-user">
					<input value="<?php echo $user['business_id']; ?>" type="number" id="business_id_number_client" class="form-control" name="business_id_number_client" autocomplete="off" placeholder="<?php echo $lang['business_id_number'] ?>">
					<p class="iderror"><? echo $lang['id_exists'] ?></p>
					<div class="tick-validate">
						<i class="fas fa-check" aria-hidden="true"></i>
						<i class="fas fa-times"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="inputName"><?php echo $lang['business_name'] ?></label>
				<div class="lastname form-add-user">
					<input value="<?php echo $user['business_name']; ?>" type="text" id="business_name" class="form-control" name="business_name" autocomplete="off" placeholder="<?php echo $lang['business_name'] ?>">
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md">
			<div class="form-group">
				<label for="inputName"><?php echo $lang['business_address'] ?></label>
				<div class="mobilenumber form-add-user">

					<input value="<?php echo $user['business_address']; ?>" type="text" name="business_add" class="form-control" id="business_add">
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="city"><?php echo $lang['city'] ?></label>

				<div class="city form-add-user">
					<input type="text" value="<?php echo $user['city']; ?>" id="city" class="form-control ui-autocomplete-input ui-autocomplete-loading" name="city" required autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="street"><?php echo $lang['street'] ?></label>
				<div class="street form-add-user">
					<input type="text" value="<?php echo $user['street']; ?>" id="street" class="form-control" name="street" required autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="house_num"><?php echo $lang['house_num'] ?></label>
				<div class="house_num form-add-user">
					<input type="text" value="<?php echo $user['house_num']; ?>" id="house_num" class="form-control" name="house_num" required autocomplete="off">
				</div>
			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-md">
			<div class="form-group">
				<label for="postal_code"><?php echo $lang['postal_code'] ?></label>
				<div class="postal_code form-add-user">
					<input type="text" id="postal_code" value="<?php echo $user['postal_code']; ?>" class="form-control" name="postal_code" required autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="mailbox"><?php echo $lang['mailbox'] ?></label>
				<div class="mailbox form-add-user">
					<input type="text" id="mailbox" value="<?php echo $user['mailbox']; ?>" class="form-control" name="mailbox" required autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="description"><?php echo $lang['notes'] ?></label>
				<div class="description form-add-user">
					<input type="text" id="description" value="<?php echo $user['description']; ?>" class="form-control" name="description" autocomplete="off">
				</div>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md">
			<div class="form-group">
				<label for="inputName"><?php echo $lang['first_name'] ?></label>
				<div class="firstname form-add-user">
					<input type="text" id="firstName" value="<?php echo $user['a_firstname']; ?>" class="form-control" name="first_name" autocomplete="off" placeholder="<?php echo $lang['first_name'] ?>">
					<div class="tick-validate">
						<i class="fas fa-check" aria-hidden="true"></i>
						<i class="fas fa-times"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="inputName"><?php echo $lang['last_name'] ?></label>
				<div class="lastname form-add-user">
					<input type="text" id="lastName" value="<?php echo $user['a_lastname']; ?>" class="form-control" name="last_name" autocomplete="off" placeholder="<?php echo $lang['last_name'] ?>">
					<div class="tick-validate">
						<i class="fas fa-check" aria-hidden="true"></i>
						<i class="fas fa-times"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="inputName"><?php echo $lang['business_tel'] ?></label>
				<div class="mobilenumber form-add-user">
					<input type="tel" id="business_tel" class="form-control" value="<?php echo $user['business_tel']; ?>" name="business_tel" autocomplete="off" placeholder="<?php echo $lang['business_tel'] ?>">

				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md">
			<div class="form-group">
				<label for="inputName">URL</label>
				<div class="url form-add-user">
					<input type="tel" id="url" value="<?php echo $user['url']; ?>" class="form-control" name="url" autocomplete="off">

				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="inputName">data folder</label>
				<div class="datafolder form-add-user">
					<input type="tel" id="datafolder" value="<?php echo $user['datafolder']; ?>" class="form-control" name="datafolder" autocomplete="off">

				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="invoice4u">invoice4u</label>
				<div class="datafolder form-add-user">
					<input type="tel" id="invoice4u" value="<?php echo $user['invoice4u']; ?>" class="form-control" name="invoice4u" autocomplete="off">

				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label for="">תיאור לקוח</label>
			<input type="text" name="client_desc" id="client_desc" class="form-control" value="<?= $user['client_desc'] ?>">
		</div>
	</div>
	<br>

	<div class="row">
		<div class="col-md-4">
			<div>
				<label for="file"><?php echo $lang['logo']; ?></label><br>
				<input type="file" accept="" id="file" name="logo"><br>
			</div>
		</div>
		<div class="col-md" style="border-left: 1px solid grey ;">
			<img src="<?= DATA_URL . "/" . $user['datafolder'] ?>/logo/<?= $user['logo'] ?>" alt="logo">
		</div>

		<div class="col-md-4">
			<div>
				<label for="file"><?php echo $lang['favi_logo']; ?></label><br>
				<input type="file" accept="" id="file" name="favicon"><br>
			</div>
		</div>
		<div class="col-md">
			<img src="<?= DATA_URL . "/" . $user['datafolder'] ?>/favicon/<?= $user['favicon'] ?>" alt="favicon">
		</div>
	</div>
	<br><br>

	<div class="form-group form-btn-reverse">
		<input type="submit" value="<?php echo $lang['save'] ?>" class="btn btn-success float-right">
	</div>

</fieldset>