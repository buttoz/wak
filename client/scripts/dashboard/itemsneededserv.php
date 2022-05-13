<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-header">
                                <h6>סה"כ מנויים צרכו שירות</h6>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><? echo $lang['polisa_num'] ?></th>
                                            <th><? echo $lang['cust_name'] ?></th>
                                            <th><? echo $lang['start_date'] ?></th>
                                            <th><? echo $lang['end_date'] ?></th>
                                            <th><? echo $lang['paymentway'] ?></th>
                                            <th><? echo $lang['agent'] ?></th>
                                            <th><? echo $lang['c_code'] ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $db = getDbInstance();
                                        $supps = $db->where('polisa_item_check_service_used', 1)->getValue('suppliers', 'c_id', null);
                                        $items = $db->where('c_providerid', $supps, 'in')->where('needed_service', 1)->get('polisa_item');

                                        $assign_arr = array(1 => $lang['credit_card'], 2 => $lang['not_paid'], 3 => $lang['on_agent_account'], 4 => $lang['cash'], 5 => $lang['check'], 6 => $lang['bank_transfer'], 7 => $lang['debit'], 0 => '---');
                                        foreach ($items as $row) {
                                            $polisa = $db->where('c_id', $row['c_polisaid'])->getOne('polisa');
                                            $agent = $db->where('c_id', $row['c_agentid'])->getOne('agents');
                                            if (isset($polisa['c_id']) and isset($agent['c_id']) and $row['c_polisapriceid'] != 0) {
                                                $cust = $db->where('c_id', $polisa['cust_id'])->getOne('customers');
                                                $price = $db->where('c_id', $row['c_polisapriceid'])->getOne('polisa_price');

                                        ?>
                                                <tr onclick="window.location='<? echo $index_path . '?sec=subs&action=updatesub&id=' . $row['c_polisaid'] ?>'">
                                                    <td><?= $row['c_polisaid'] ?></td>
                                                    <td><?= $cust['c_firstname'] ?></td>
                                                    <td><?= date("d/m/Y", strtotime($polisa['c_startdate'])) ?></td>
                                                    <td><?= date("d/m/Y", strtotime($polisa['c_enddate']))  ?></td>
                                                    <td><?= $assign_arr[$price['c_paymentway']] ?></td>
                                                    <td><?= $agent['business_name'] ?></td>
                                                    <td><?= $row['c_code'] ?></td>
                                                </tr>
                                        <? }
                                        } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>

</div>