<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 pb-1">
                <table class="table table-sm table-borderless table-striped">
                    <thead class="border">
                        <tr>
                            <th class="">ID Barang</th>
                            <th class="text-right">Harga</th>
                            <th class="text-right">Harga Jual</th>
                            <th class="text-right">Fee</th>
                            <th class="text-right">Margin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $margin_total = 0;
                        $fee_total = 0;
                        $omset = 0;
                        foreach ($data['data'] as $dp) {
                            $margin = $dp['harga_jual'] - $dp['harga'] - $dp['fee'];
                        ?>
                            <tr>
                                <td class="">#<?= $dp['id_barang'] ?></td>
                                <td class="text-right"><?= number_format($dp['harga']) ?></td>
                                <td class="text-right"><?= number_format($dp['harga_jual']) ?></td>
                                <td class="text-right"><?= number_format($dp['fee']) ?></td>
                                <td class="text-right"><?= number_format($margin) ?></td>
                            </tr>
                        <?php
                            $margin_total += $margin;
                            $fee_total += $dp['fee'];
                            $omset += $dp['harga_jual'];
                        }
                        ?>
                        <tr>
                            <td class="text-right" colspan="2"></td>
                            <td class="text-right"><b><?= number_format($omset) ?></b></td>
                            <td class="text-right"><b><?= number_format($fee_total) ?></b></td>
                            <td class="text-right"><b><?= number_format($margin_total) ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>