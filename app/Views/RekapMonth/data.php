<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 pb-1">
                <b><span class="text-success">Penjualan: <?= $data['mon'][1] . "-" . $data['mon'][0]; ?></span></b>
                <table class="mt-1 table table-sm">
                    <thead class="table-borderless">
                        <tr>
                            <th>Toko</th>
                            <th class="text-right">Omset (Modal)</th>
                            <th class="text-right">Margin (Fee)</th>
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
                            if ($dp['used'] == 1) {
                                continue;
                            }
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
                                <td class="text-right"><?= number_format($rekap_val['omset']) ?><small> (<?= number_format($rekap_val['modal']) ?>)</small></td>
                                <td class="text-right"><?= number_format($rekap_val['margin_total']) ?> <small>(<?= number_format($rekap_val['fee_total']) ?>)</small></td>
                            </tr>
                        <?php } ?>

                        <tr class="table-success">
                            <td></td>
                            <td class="text-right"><b><?= number_format($omset) ?> <small>(<?= number_format($modal) ?>)</small></b></td>
                            <td class="text-right"><b><?= number_format($margin_total) ?> <small>(<?= number_format($fee_total) ?>)</small></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 pb-1">
                <b><span class="text-danger">Pemakaian: <?= $data['mon'][1] . "-" . $data['mon'][0]; ?></span></b>
                <table class="mt-1 table table-sm">
                    <thead class="table-borderless">
                        <tr>
                            <th>Toko</th>
                            <th class="text-right">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rekap = [];
                        $modal = 0;
                        foreach ($data['data'] as $dp) {
                            if ($dp['used'] == 0) {
                                continue;
                            }
                        ?>
                        <?php
                            $modal += $dp['harga'];
                            $rekap[$dp['id_user']]['modal'] = (isset($rekap[$dp['id_user']]['modal'])) ? $rekap[$dp['id_user']]['modal'] += $dp['harga'] : $dp['harga'];
                        }

                        foreach ($rekap as $rekap_key => $rekap_val) { ?>
                            <tr>
                                <td><?= strtoupper($rekap_key) ?></td>
                                <td class="text-right"><?= number_format($rekap_val['modal']) ?></td>
                            </tr>
                        <?php } ?>
                        <tr class="table-danger">
                            <td></td>
                            <td class="text-right"><b><?= number_format($modal) ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>