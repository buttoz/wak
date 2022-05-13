<fieldset>

    <div class="row">
        <div class="col-md">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['user_id_number'] ?></label>
                <div class="useridnumber form-add-user">
                    <input type="number" id="userid" class="form-control" name="user_id" autocomplete="false" placeholder="<?php echo $lang['user_id_number'] ?>">
                    <p class="useriderror"><?php echo $lang['userid_exists'] ?></p>
                    <div class="tick-validate">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['first_name'] ?></label>
                <div class="firstname form-add-user">
                    <input type="text" id="firstName" class="form-control" name="first_name" autocomplete="false" placeholder="<?php echo $lang['first_name'] ?>">
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
                    <input type="text" id="lastName" class="form-control" name="last_name" autocomplete="false" placeholder="<?php echo $lang['last_name'] ?>">
                    <div class="tick-validate">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">



    </div>
    <div class="row">
        <div class="col-md">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['email'] ?></label>
                <div class="useremail form-add-user">
                    <input type="email" id="email" class="form-control" name="user_email" autocomplete="false" placeholder='<?php echo $lang['email'] ?>'>
                    <p class="emailerror"><?php echo $lang['email_exists'] ?></p>
                    <div class="tick-validate">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['mobile_number'] ?></label>
                <div class="mobilenumber form-add-user">
                    <input type="tel" id="mobile" class="form-control" name="mobile" autocomplete="false" placeholder="<?php echo $lang['mobile_number'] ?>">
                    <div class="tick-validate">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['user_name'] ?></label>
                <div class="username form-add-user">
                    <input type="text" id="userName" name="user_name" autocomplete="false" placeholder="<?php echo $lang['user_name'] ?>" class="form-control">
                    <p class="usernameerror"><?php echo $lang['user_exists']; ?></p>
                    <div class="tick-validate">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['password'] ?></label>
                <div class="password form-add-user">
                    <input type="password" id="password" class="form-control" name="password" autocomplete="false" placeholder="<?php echo $lang['password'] ?>">
                    <div class="tick-validate">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <label for="inputName"><?php echo $lang['confirm_password'] ?></label>
                <div class="confirmpassword form-add-user">
                    <input type="password" id="confirmpassword" class="form-control" name="confirmpassword" autocomplete="false" placeholder="<?php echo $lang['confirm_password'] ?>">
                    <div class="tick-validate">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputStatus"><?php echo $lang['user_role'] ?></label>
                <select id="inputStatus" name="admin_type" class="form-control custom-select">
                    <option selected="" disabled=""><?php echo $lang['select_one'] ?></option>
                    <option name="admin_type" required="" value="admin">Admin</option>
                    <option name="admin_type" required="" value="user">User</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group form-btn-reverse">
        <input type="submit" value="<?php echo $lang['save'] ?>" class="btn btn-success float-right">
        <a id="reset" href="#" class="btn btn-secondary"><?php echo $lang['reset'] ?></a>
    </div>
</fieldset>