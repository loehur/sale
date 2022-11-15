<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 pb-1">
                Date: <b><span class="text-success"><?php echo $data['mon'][2] . "-" . $data['mon'][1] . "-" . $data['mon'][0]; ?></span></b>
                <table class="mt-1 table table-sm table-borderless table-striped">
                    <thead class="border">
                        <tr>
                            <th class="">Toko/Barang</th>
                            <th class="text-right">Harga/Modal</th>
                            <th class="text-right">Margin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $margin_total = 0;
                        $fee_total = 0;
                        $omset = 0;
                        $modalTotal = 0;
                        foreach ($data['data'] as $dp) {
                            $margin = $dp['harga_jual'] - $dp['harga'] - $dp['fee'];
                        ?>
                            <tr>
                                <td class=""><?= strtoupper($dp['id_user'] . "#" . $dp['kode_barang']) ?></td>
                                <td class="text-right"><?= number_format($dp['harga_jual']) ?> <small>(<?= number_format($dp['harga']) ?>)</small></td>
                                <td class="text-right"><?= number_format($margin) ?> <small>(<?= number_format($dp['fee']) ?>)</small></td>
                            </tr>
                        <?php
                            $margin_total += $margin;
                            $fee_total += $dp['fee'];
                            $omset += $dp['harga_jual'];
                            $modalTotal += $dp['harga'];
                        }
                        ?>
                        <tr>
                            <td class="text-right"></td>
                            <td class="text-right"><b><?= number_format($omset) ?> <small>(<?= number_format($modalTotal) ?>)</b></td>
                            <td class="text-right"><b><?= number_format($margin_total) ?></b> <small>(<?= number_format($fee_total) ?>)</small></td>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>