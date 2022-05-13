<fieldset>
	<div class="row">

		<div class="col-md-2">
			<div class="form-group">
				<label for="client_type"><?= $lang['client_type'] ?></label>
				<select name="client_type" id="client_type" class="form-control" required>
					<option value=""><?= $lang['choose_client_type'] ?></option>
					<option value="1"><?= $lang['a.m.'] ?></option>
					<option value="2"><?= $lang['company'] ?></option>
				</select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="inputName"><?php echo $lang['business_id_number'] ?></label>
				<div class="useridnumber form-add-user">
					<input type="number" id="business_id_number_client" class="form-control" name="business_id_number_client" autocomplete="off" placeholder="<?php echo $lang['business_id_number'] ?>">
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
					<input type="text" id="business_name" class="form-control" name="business_name" autocomplete="off" placeholder="<?php echo $lang['business_name'] ?>">
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md">
			<div class="form-group">
				<label for="inputName"><?php echo $lang['business_address'] ?></label>

				<div class="mobilenumber form-add-user">

					<input type="text" name="business_add" class="form-control" id="business_add">
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="city"><?php echo $lang['city'] ?></label>

				<div class="city form-add-user">
					<input type="text" id="city" class="form-control ui-autocomplete-input ui-autocomplete-loading" name="city" required autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="street"><?php echo $lang['street'] ?></label>
				<div class="street form-add-user">
					<input type="text" id="street" class="form-control" name="street" required autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="house_num"><?php echo $lang['house_num'] ?></label>
				<div class="house_num form-add-user">
					<input type="text" id="house_num" class="form-control" name="house_num" required autocomplete="off">
				</div>
			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-md">
			<div class="form-group">
				<label for="postal_code"><?php echo $lang['postal_code'] ?></label>
				<div class="postal_code form-add-user">
					<input type="text" id="postal_code" class="form-control" name="postal_code" required autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="mailbox"><?php echo $lang['mailbox'] ?></label>
				<div class="mailbox form-add-user">
					<input type="text" id="mailbox" class="form-control" name="mailbox" required autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="description"><?php echo $lang['notes'] ?></label>
				<div class="description form-add-user">
					<input type="text" id="description" class="form-control" name="description" autocomplete="off">
				</div>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md">
			<div class="form-group">
				<label for="inputName"><?php echo $lang['first_name'] ?></label>
				<div class="firstname form-add-user">
					<input type="text" id="firstName" class="form-control" name="first_name" autocomplete="off" placeholder="<?php echo $lang['first_name'] ?>">
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
					<input type="text" id="lastName" class="form-control" name="last_name" autocomplete="off" placeholder="<?php echo $lang['last_name'] ?>">
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
					<input type="tel" id="business_tel" class="form-control" name="business_tel" autocomplete="off" placeholder="<?php echo $lang['business_tel'] ?>">

				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md">
			<div class="form-group">
				<label for="inputName">URL</label>
				<div class="url form-add-user">
					<input type="tel" id="url" class="form-control" name="url" autocomplete="off">

				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				<label for="inputName">data folder</label>
				<div class="datafolder form-add-user">
					<input type="tel" id="datafolder" class="form-control" name="datafolder" autocomplete="off">

				</div>
			</div>
		</div>
	</div>

	<div class="form-group form-btn-reverse">
		<input type="submit" value="<?php echo $lang['save'] ?>" class="btn btn-success float-right">
		<a class="delete deleteuser btn btn-secondary" data-username="<?php echo get_current_login_username() ?>" data-fullname="<?php echo get_current_login_user_full_name() ?>"><?php echo $lang['delete'] ?></a>
	</div>

</fieldset>