<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 pb-1">
                Month: <b><span class="text-success"><?php echo $data['mon'][1] . "-" . $data['mon'][0]; ?></span></b>
                <table class="mt-1 table table-sm table-borderless table-striped">
                    <thead class="border">
                        <tr>
                            <th>Toko</th>
                            <th class="text-right">Omset</th>
                            <th class="text-right">Modal</th>
                            <th class="text-right">Fee</th>
                            <th class="text-right">Margin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rekap = [];
                        $margin_total = 0;
                        $fee_total = 0;
                        $omset = 0;
                        $modal = 0;

                        foreach ($data['data'] as $dp) {
                            $margin = $dp['harga_jual'] - $dp['harga'] - $dp['fee'];
                        ?>
                        <?php
                            $margin_total += $margin;
                            $fee_total += $dp['fee'];
                            $omset += $dp['harga_jual'];
                            $modal += $dp['harga'];

                            $rekap[$dp['id_user']]['margin_total'] = (isset($rekap[$dp['id_user']]['margin_total'])) ? $rekap[$dp['id_user']]['margin_total'] += $margin : $margin;
                            $rekap[$dp['id_user']]['fee_total'] = (isset($rekap[$dp['id_user']]['fee_total'])) ? $rekap[$dp['id_user']]['fee_total'] += $dp['fee'] : $dp['fee'];
                            $rekap[$dp['id_user']]['omset'] = (isset($rekap[$dp['id_user']]['omset'])) ? $rekap[$dp['id_user']]['omset'] += $dp['harga_jual'] : $dp['harga_jual'];
                            $rekap[$dp['id_user']]['modal'] = (isset($rekap[$dp['id_user']]['modal'])) ? $rekap[$dp['id_user']]['modal'] += $dp['harga'] : $dp['harga'];
                        }

                        foreach ($rekap as $rekap_key => $rekap_val) { ?>
                            <tr>
                                <td><?= strtoupper($rekap_key) ?></td>
                                <td class="text-right"><?= number_format($rekap_val['omset']) ?></td>
                                <td class="text-right"><?= number_format($rekap_val['modal']) ?></td>
                                <td class="text-right"><?= number_format($rekap_val['fee_total']) ?></td>
                                <td class="text-right"><?= number_format($rekap_val['margin_total']) ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td>Total</td>
                            <td class="text-right"><?= number_format($omset) ?></td>
                            <td class="text-right"><?= number_format($modal) ?></td>
                            <td class="text-right"><?= number_format($fee_total) ?></td>
                            <td class="text-right"><?= number_format($margin_total) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>