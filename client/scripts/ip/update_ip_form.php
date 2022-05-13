<fieldset>
    <div class="form-group">
        <label for="ip">IP Address</label>
        <div class="catname form-add-user">
            <input type="text" value="<?php echo $ip['ip'] ?>"  id="ipadd" name="ip_add" autocomplete="false" placeholder="222.222.222.222" class="form-control">

        </div>
    </div>
    <div class="form-group">
        <input  <?php echo $ip['status'] == 0 ? 'checked' : '' ?> name="active_inactive" type="checkbox"  data-toggle="toggle" data-on="<?php echo $lang['active'] ?>" data-off="<?php echo $lang['inactive'] ?>" data-onstyle="success" data-offstyle="danger">
    </div>

    <div class="form-group form-btn-reverse">
        <a id="<?php echo $ip['ID']?>" href="#" class="btn btn-secondary delete"><?php echo $lang['delete'] ?></a>
        <input id="btn-submit" type="submit" value="<?php echo $lang['save'] ?>" class="btn btn-success float-right">
    </div>
</fieldset>