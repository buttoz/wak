<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-header">
                                סה"כ מנויים לא דיווחו לספק
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
                                            <th><? echo $lang['action_type'] ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $db = getDbInstance();
                                        $supps = $db->where('polisa_item_check_accepted', 1)->getValue('suppliers', 'c_id', null);
                                        if ($db->count > 0) {
                                            $items_report = $db->where('providerid', $supps, 'in')->where('reported', 0)->get('items_to_report');
                                            $assign_arr = array(1 => $lang['credit_card'], 2 => $lang['not_paid'], 3 => $lang['on_agent_account'], 4 => $lang['cash'], 5 => $lang['check'], 6 => $lang['bank_transfer'], 7 => $lang['debit'], 0 => '---');
                                            foreach ($items_report as $row) {
                                                $polisa = $db->where('c_id', $row['polisaid'])->getOne('polisa');
                                                $agent = $db->where('c_id', $polisa['c_agentid'])->getOne('agents');
                                                $cust = $db->where('c_id', $polisa['cust_id'])->getOne('customers');

                                                if ($row['itemid'] != 0) {
                                                    $item = $db->where('c_id', $row['itemid'])->getOne('polisa_item');
                                                    if ($db->count > 0)
                                                        $price = $db->where('c_id', $item['c_polisapriceid'])->getOne('polisa_price');
                                                    else {
                                                        $price['c_paymentway'] = 0;
                                                        $item['c_code'] = '---';
                                                    }
                                                } else {
                                                    $item['c_code'] = '---';
                                                }
                                        ?>
                                                <tr onclick="window.location='<? echo $index_path . '?sec=subs&action=updatesub&id=' . $row['polisaid'] ?>'">
                                                    <td><?= $row['polisaid'] ?></td>
                                                    <td><?= $cust['c_firstname'] ?></td>
                                                    <td><?= date("d/m/Y", strtotime($polisa['c_startdate'])) ?></td>
                                                    <td><?= date("d/m/Y", strtotime($polisa['c_enddate']))  ?></td>
                                                    <td><?= $assign_arr[$price['c_paymentway']] ?></td>
                                                    <td><?= $agent['business_name'] ?></td>
                                                    <td><?= $item['c_code'] ?></td>
                                                    <td><?= $lang[$row['actiontype']] ?></td>
                                                </tr>
                                        <? }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>

</div>