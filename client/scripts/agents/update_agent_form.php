<fieldset>
    <div class="form-group">
        <input type="hidden" id="business_id" name="business_id" value="<? echo $user['business_id']; ?>">
        <input type="hidden" id="id" name="id" value="<? echo $user['c_id']; ?>">
    </div>
    <div class="row">

        <div class="col-md-2">
            <div class="form-group">
                <label for="agent_type"><?= $lang['agent_type'] ?></label>
                <select name="agent_type" id="agent_type" class="form-control" required>
                    <option value=""><?= $lang['choose_agent_type'] ?></option>
                    <option value="1" <?= $user['agent_type'] == 1 ? 'selected' : '' ?>><?= $lang['a.m.'] ?></option>
                    <option value="2" <?= $user['agent_type'] == 2 ? 'selected' : '' ?>><?= $lang['company'] ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['business_id_number'] ?></label>
                <div class="useridnumber form-add-user">
                    <input type="number" id="update_business_id_number_agent" class="form-control" value="<?php echo $user['business_id']; ?>" name="update_business_id_number_agent" autocomplete="off" placeholder="<?php echo $lang['business_id_number'] ?>">
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
                    <input type="text" id="business_name" value="<?php echo htmlspecialchars($user['business_name']); ?>" class="form-control" name="business_name" autocomplete="off" placeholder="<?php echo $lang['business_name'] ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['business_address'] ?></label>

                <div class="mobilenumber form-add-user">

                    <input type="text" name="business_add" class="form-control" id="business_add" value="<?php echo $user['business_address']; ?>">
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <label for="city"><?php echo $lang['city'] ?></label>

                <div class="city form-add-user">
                    <input type="text" id="city" class="form-control ui-autocomplete-input ui-autocomplete-loading" name="city" required value="<?= $user['city'] ?>" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <label for="street"><?php echo $lang['street'] ?></label>
                <div class="street form-add-user">
                    <input type="text" id="street" class="form-control" name="street" required value="<?= $user['street'] ?>" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <label for="house_num"><?php echo $lang['house_num'] ?></label>
                <div class="house_num form-add-user">
                    <input type="number" id="house_num" class="form-control" name="house_num" value="<?= $user['house_num'] ?>" autocomplete="off">
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md">
            <div class="form-group">
                <label for="postal_code"><?php echo $lang['postal_code'] ?></label>
                <div class="postal_code form-add-user">
                    <input type="number" id="postal_code" class="form-control" name="postal_code" value="<?= $user['postal_code'] ?>" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <label for="mailbox"><?php echo $lang['mailbox'] ?></label>
                <div class="mailbox form-add-user">
                    <input type="number" id="mailbox" class="form-control" name="mailbox" value="<?= $user['mailbox'] ?>" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <label for="description"><?php echo $lang['notes'] ?></label>
                <div class="description form-add-user">
                    <input type="text" id="description" class="form-control" name="description" value="<?= $user['description'] ?>" autocomplete="off">
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['first_name'] ?></label>
                <div class="firstname form-add-user">
                    <input type="text" id="firstName" value="<?php echo htmlspecialchars($user['a_firstname']); ?>" class="form-control" name="first_name" autocomplete="off" placeholder="<?php echo $lang['first_name'] ?>">
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
                    <input type="text" id="lastName" value="<?php echo htmlspecialchars($user['a_lastname']); ?>" class="form-control" name="last_name" autocomplete="off" placeholder="<?php echo $lang['last_name'] ?>">
                    <div class="tick-validate">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?
            $first = substr($user['business_tel'], 3);
            $second = substr($user['business_tel'], 0, 3);
            ?>
            <div class="col-md">
                <div class="form-group">
                    <label for="inputName"><?php echo $lang['business_tel'] ?></label>
                    <div class="mobilenumber form-add-user">
                        <input type="tel" id="business_tel" value="<?php echo $first; ?>" class="form-control" name="business_tel" autocomplete="off" placeholder="<?php echo $lang['business_tel'] ?>">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputName"><?php echo $lang['mobile_number'] ?></label>
                    <div class="mobilenumber form-add-user">
                        <select name="mobile3num1" id="mobile3num1" class="form-control">
                            <option value=""></option>
                            <option value="050" <?= $second == '050' ? 'selected' : '' ?>>050</option>
                            <option value="052" <?= $second == '052' ? 'selected' : '' ?>>052</option>
                            <option value="053" <?= $second == '053' ? 'selected' : '' ?>>053</option>
                            <option value="054" <?= $second == '054' ? 'selected' : '' ?>>054</option>
                            <option value="058" <?= $second == '058' ? 'selected' : '' ?>>058</option>
                            <option value="055" <?= $second == '055' ? 'selected' : '' ?>>055</option>
                            <option value="072" <?= $second == '072' ? 'selected' : '' ?>>072</option>
                            <option value="073" <?= $second == '073 ' ? 'selected' : '' ?>>073</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">



        <div class="col-md-6">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['email'] ?></label>
                <div class="agent_email form-add-user">
                    <input type="email" value="<?php echo $user['a_email']; ?>" id="agent_email" class="form-control" name="agent_email" autocomplete="off" placeholder="<?php echo $lang['email'] ?>">
                    <p class="emailerror"><?php echo $lang['email_exists'] ?></p>
                    <div class="tick-validate">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?
            $first = substr($user['a_mobile'], 3);
            $second = substr($user['a_mobile'], 0, 3);

            ?>
            <div class="col-md">
                <div class="form-group">
                    <label for="inputName"><?php echo $lang['mobile_number'] ?></label>
                    <div class="mobilenumber form-add-user">
                        <input type="tel" value="<?php echo $first; ?>" id="mobile" class="form-control" name="mobile" autocomplete="off" placeholder="<?php echo $lang['mobile_number'] ?>">

                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label for="inputName"><?php echo $lang['mobile_number'] ?></label>
                    <div class="mobilenumber form-add-user">
                        <select name="mobile3num2" id="mobile3num2" class="form-control">
                            <option value=""></option>
                            <option value="050" <?= $second == '050' ? 'selected' : '' ?>>050</option>
                            <option value="052" <?= $second == '052' ? 'selected' : '' ?>>052</option>
                            <option value="053" <?= $second == '053' ? 'selected' : '' ?>>053</option>
                            <option value="054" <?= $second == '054' ? 'selected' : '' ?>>054</option>
                            <option value="058" <?= $second == '058' ? 'selected' : '' ?>>058</option>
                            <option value="055" <?= $second == '055' ? 'selected' : '' ?>>055</option>
                            <option value="072" <?= $second == '072' ? 'selected' : '' ?>>072</option>
                            <option value="073" <?= $second == '073' ? 'selected' : '' ?>>073</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['user_name'] ?></label>
                <div class="username form-add-user">
                    <input type="text" id="agent_user" value="<?php echo $user['a_username']; ?>" name="agent_user" autocomplete="false" required placeholder="<?php echo $lang['user_name'] ?>" class="form-control">
                    <p class="usernameerror"><? echo $lang['user_exists'] ?></p>
                    <div class="tick-validate">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['password'] ?></label>
                <div class="password form-add-user">
                    <input type="password" id="passwordedit" class="form-control" name="password" autocomplete="new-password" placeholder="<?php echo $lang['password'] ?>">

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['confirm_password'] ?></label>
                <div class="confirmpassword form-add-user">
                    <input type="password" id="confirmpassword" class="form-control" name="confirmpassword" autocomplete="new-password" placeholder="<?php echo $lang['confirm_password'] ?>">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="role"><?= $lang['agent_dad'] ?></label>
            <select name="role" id="role" class="form-control">
                <option value="0"><?= $lang['no_dad_agent'] ?></option>
                <?
                $db = getDbInstance();
                $agents = $db->where('role', 0)->get('agents');
                foreach ($agents as $row) {
                    if ($row['c_id'] != $_GET['id']) {
                ?>
                        <option value="<?= $row['c_id'] ?>" <?= $row['c_id'] == $user['role'] ? 'selected' : '' ?>><?= $row['business_name'] ?></option>
                <?
                    }
                }
                ?>
            </select>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="agent_status"><?= $lang['stat'] ?></label>
                <select name="agent_status" id="agent_status" class="form-control">
                    <option value="0" <?= $user['c_status'] == 0 ? 'selected' : '' ?>><?= $lang['active'] ?></option>
                    <option value="1" <?= $user['c_status'] == 1 ? 'selected' : '' ?>><?= $lang['awaiting_inactive'] ?></option>
                    <option value="2" <?= $user['c_status'] == 2 ? 'selected' : '' ?>><?= $lang['inactive'] ?></option>
                </select>
            </div>
        </div>
    </div>
    <label for="active_inactive">OTP</label><br>
    <input id="active_inactive_otp" name="active_inactive" type="checkbox" data-toggle="toggle" data-on="<?php echo $lang['active'] ?>" data-off="<?php echo $lang['inactive'] ?>" data-onstyle="success" data-offstyle="danger" <?= $user['otp'] == 0 ? 'checked' : '' ?>>
    <br>
    <br>

    <div class="d-flex justify-content-between">
        <div class="d-flex flex-column">
            <input type="submit" value="<?php echo $lang['save'] ?>" class="btn btn-success float-right">
        </div>
        <div class="d-flex flex-column">
            <a class="delete deleteuser btn btn-secondary" id="<?php echo $user['c_id'] ?>" data-username="<?php echo get_current_login_username() ?>" data-fullname="<?php echo get_current_login_user_full_name() ?>"><?php echo $lang['delete'] ?></a>
        </div>

    </div>

</fieldset>