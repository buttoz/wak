<fieldset>
    <div class="form-group">
        <label for="inputName"><?php echo $lang['business_name'] ?></label>
        <div class="businessname form-add-user">
            <input type="text"  id="businessName" name="business_name" autocomplete="false" placeholder="<?php echo $lang['business_name'] ?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName"><?php echo $lang['business_tel'] ?></label>
        <div class="businesstel form-add-user">
            <input type="tel" id="businesstel" class="form-control" name="business_tel" autocomplete="false" placeholder="<?php echo $lang['business_tel'] ?>">
        </div>
    </div>
    <div class="form-group cat-file-upload logo-file">
        <label for="cover"><?php echo $lang['logo'] ?></label>
        <div class="image-upload-area">
            <div class="file-select">
                <div class="file-select-button">Choose File</div>
                <div class="file-select-name" id="noFile">No file chosen</div>
                <input type="file" id="catfile" name="files" class="files" accept="image/*">
            </div>
            <div class="previewimage">
                <img id="blah" class="logo" src="#" alt="Image Preview" />
            </div>
        </div>

        <div id="caterror"></div>
    </div>
    <div class="form-group drtl">
        <label for="inputName"><?php echo $lang['category_design_option'] ?></label>
        <div class="cdo form-add-user">
            <input type="radio"  name="cdo" value="1"> Option 1 (Name, Description, Image) <br>
            <input type="radio"  name="cdo" value="2"> Option 2 (Name, Image) <br>
            <input type="radio"  name="cdo" value="3"> Option 3 (Image) <br>
        </div>
    </div>
    <div class="form-group drtl">
        <label for="inputName"><?php echo $lang['sub_category_design_option'] ?></label>
        <div class="scdo form-add-user">
            <input type="radio" name="scdo"  value="1"> Option 1 (Name, Description, Image) <br>
            <input type="radio" name="scdo"  value="2"> Option 2 (Name, Image) <br>
            <input type="radio" name="scdo"  value="3"> Option 3 (Image) <br>
        </div>
    </div>
    <div class="form-group drtl">
        <label for="inputName"><?php echo $lang['product_design_option'] ?></label>
        <div class="pdo form-add-user">
            <input type="radio" name="pdo" value="1"> Option 1 (Name, Description, Image) <br>
            <input type="radio" name="pdo" value="2"> Option 2 (Name, Image) <br>
            <input type="radio" name="pdo" value="3"> Option 3 (Image) <br>
        </div>
    </div>
    <div class="form-group drtl">
        <label for="inputName"><?php echo $lang['default_language'] ?></label>
        <div class="language form-add-user">
            <input type="radio" name="language" value="1"> English <br>
            <input type="radio" name="language" value="2"> Arabic <br>
            <input type="radio" name="language" value="3"> Hebrew <br>
        </div>
    </div>
        <div class="form-group">
            <div class="changelanguage form-add-user">
            <label for="inputName"><?php echo $lang['change_language'] ?></label> <br>
            <input name="active_inactive" <?php echo $changelanguage == 0 ? 'checked' : '' ?> type="checkbox"  data-toggle="toggle" data-on="<?php echo $lang['show'] ?>" data-off="<?php echo $lang['hide'] ?>" data-onstyle="success" data-offstyle="danger">
            </div>
        </div>
    <div class="form-group">
            <div class="imagesize form-add-user">
            <label for="inputName"><?php echo $lang['image_size'] ?></label> <br>
            <div class="smallsize">
                <label for="small">Small : </label> <input type="text" name="small_image_size" size="5" id="smallimage">px
            </div>
                <div class="largesize">
                    <label for="large">Large : </label> <input type="text" name="large_image_size" size="5" id="largeimage">px
                </div>
            </div>
        </div>
    <div class="form-group">
        <div class="showrows form-add-user">
            <label for="inputName"><?php echo $lang['show_rows'] ?></label> <br>
            <div class="showrows">
               <input type="number" name="showrows"  id="showrows" placeholder="10">
            </div>

        </div>
    </div>


    <div class="form-group form-btn-reverse settingsave">
        <input  type="submit" value="<?php echo $lang['save'] ?>" class="btn btn-success float-right">
    </div>
</fieldset>