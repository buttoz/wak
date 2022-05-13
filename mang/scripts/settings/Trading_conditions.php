<div class="card">
    <div class="card-body">
        <div class="row">
            <? $db = getDbInstance();
            $obligo = $db->where('c_id', $_GET['id'])->getOne('clients');
            ?>
            <div class="col-md">
                <label for="cancel_days"><? echo $lang['cancel_days'] ?></label>
                <input type="number" class="form-control" id="cancel_days" name="cancel_days" value="<? echo ((isset($obligo['cancel_days'])) and ($obligo['cancel_days'] != 0)) ? $obligo['cancel_days'] : '' ?>">
            </div>
            <div class="col-md">
                <label for="cancel_days"><? echo $lang['tax_deduction'] ?></label>
                <input type="number" class="form-control" id="tax_deduction" name="tax_deduction" value="<? echo ((isset($obligo['tax_deduction'])) and ($obligo['tax_deduction'] != 0)) ? $obligo['tax_deduction'] : '' ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <label for="sms_num"><? echo $lang['sms_num'] ?></label>
                <input type="number" class="form-control" id="sms_num" name="sms_num" value="<? echo isset($obligo['sms_num']) ? $obligo['sms_num'] : '' ?>">
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">מערכת סליקה</label>
                <select name="creditpay_way" id="creditpay_way" class="form-control">
                    <option value="0" <?= $obligo['creditpay_way'] == 0 ? 'selected' : '' ?>>z-credit</option>
                    <option value="1" <?= $obligo['creditpay_way'] == 1 ? 'selected' : '' ?>>invoice 4 u</option>
                </select>
            </div>
            <? if ($obligo['creditpay_way'] == 0) { ?>
                <div class="col-md" id="z_token_cont" style="<? $obligo['creditpay_way'] == 0 ? '' : 'display:none' ?>">
                    <label for="z_token"><? echo $lang['z_token'] ?></label>
                    <input type="text" class="form-control" id="z_token" name="z_token" value="<? echo isset($obligo['z_token']) ? $obligo['z_token'] : '' ?>">
                </div>
            <? } ?>
        </div>

        <div class="p-2">
            <button type="button" class="btn btn-success" id="addobligo_client"><? echo $lang['save'] ?></button>
        </div>
    </div>
</div>


<button id="addinsurance" type="button" class="btn btn-success" data-toggle="modal" data-target="#Tradingsmodal">
    +
</button>
<div id="Tradingstable">
    <table class="table table-bordered table-responsive-md">
        <thead>
            <tr>
                <th><?php echo $lang['description'] ?></th>
                <th><?php echo $lang['inserted_time'] ?></th>
            </tr>
        </thead>
        <tbody id="Tradingsdata">


        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="Tradingsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateinvoice"><?php echo $lang['add_Tradings'] ?></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="Tradingsadd">
                    <input type="hidden" name="client_id" id="client_id" value="<? echo $_GET['id'] ?>">
                    <label><?php echo $lang['description']; ?></label><br>
                    <input type="text" class="form-control" id="description" name="description"><br>
                    <label for="am"><?php echo $lang['add_Tradings']; ?></label><br>
                    <input type="file" accept="image/*, .pdf" id="file" name="file"><br>


                    <div class="invbtn">
                        <input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
                        <button type="button" id="closeivoice_Trading_add" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="updateTradingsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateinvoice"><?php echo $lang['Trading_update'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateTradings">
                    <input type="hidden" name="client_idtoedit" id="client_idtoedit" value="<? echo $_GET['id'] ?>">
                    <label><?php echo $lang['description']; ?></label><br>
                    <input type="text" class="form-control" id="descriptiontoedit" name="descriptiontoedit"><br>
                    <label for="am"><?php echo $lang['add_Tradings']; ?></label><br>
                    <input type="file" accept="image/*, .pdf" id="filetoedit" name="filetoedit"><br>
                    <input type="hidden" name="Trading_id" id="Trading_id" value="">
                    <div id="view_image">
                        <i class="fas fa-search fa-lg view_image_Trading"></i>
                    </div>
                    <div class="invbtn">
                        <input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
                        <button type="button" id="closeivoiceeedit_trading" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
                        <button type="button" class="btn btn-danger deleteTrading" data-dismiss="modal"><?php echo $lang['delete'] ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>