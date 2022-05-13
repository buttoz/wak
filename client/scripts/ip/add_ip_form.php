<fieldset>
<div class="form-group">
    <label for="ip">IP Address</label>
   <div class="catname form-add-user">
       <input type="text"  id="ipadd" name="ip_add" autocomplete="false" placeholder="<?php echo getuserip() ?>" class="form-control">

   </div>
</div>
    <div class="form-group">
        <input name="active_inactive" type="checkbox"  data-toggle="toggle" data-on="<?php echo $lang['active'] ?>" data-off="<?php echo $lang['inactive'] ?>" data-onstyle="success" data-offstyle="danger">
    </div>

<div class="form-group form-btn-reverse">
    <input id="btn-submit" type="submit" value="<?php echo $lang['save'] ?>" class="btn btn-success float-right">
</div>
</fieldset>