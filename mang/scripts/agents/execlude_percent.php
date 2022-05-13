<br>
<div class="row">
    <div class="col-md-3 d-flex" style="gap: 4px;">
        <h6><?= $lang['execlude_percent'] ?> : </h6>
        <span id="percent_cont"></span>
    </div>
    <div class="col-md d-flex" style="gap: 4px;">
        <h6><?= $lang['execlude_total'] ?> : </h6>
        <span id="execlude_total_cont"></span>
    </div>
</div>
<br>
<button id="addinsurance" type="button" class="btn btn-success" data-toggle="modal" data-target="#execludemodal">
    +
</button>
<div id="execludetable">
    <table class="table table-bordered table-responsive-md">
        <thead>
            <tr>
                <th><?php echo $lang['description'] ?></th>
                <th><?php echo $lang['user'] ?></th>
                <th><?php echo $lang['inserted_time'] ?></th>
            </tr>
        </thead>
        <tbody id="execludedata">


        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="execludemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateinvoice"><?php echo $lang['add_execlude'] ?></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="execludeadd">
                    <input type="hidden" name="agent_id" id="agent_id_execlude" value="<? echo $user['c_id'] ?>">
                    <label><?php echo $lang['execlude_percent']; ?></label><br>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="execlude_percentvalue" name="execlude_percentvalue" required><br>
                    </div>

                    <div class="invbtn">
                        <input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
                        <button type="button" id="closeivoice_execlude_add" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>