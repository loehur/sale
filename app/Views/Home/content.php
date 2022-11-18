<?php $d = $data['kas']; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <?= $this->userData['nama'] ?>
            </div>
            <div class="col-md-6">
                <table class="table table-sm float-right">
                    <tr>
                        <td align="right"><b>Kas Toko</b></td>
                        <td align="right"><b><?= number_format($d['total']) ?></b></td>
                    </tr>
                    <?php if ($this->userData['user_tipe'] == 10) {
                    ?>
                        <tr>
                            <td align="right">Supplier</td>
                            <td align="right"><?= number_format($d['sup']) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<hr>

<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <div class="row">
            <?php
            foreach ($data['riwayat'] as $ak => $value) {
                $total = 0;
            ?>
                <div class="col-md-6 border pb-1 pt-1 mb-2">
                    <a href="" class="text-primary" onclick="Print('<?= $ak ?>')"><i class="fas fa-print"></i></a>
                    <span class="text-info"><?= "Transaction. " . $ak; ?></span>
                    <?php
                    $tr_print = "";
                    $classUse = 'success';
                    foreach ($value as $k) {
                        $sat = "PCS";
                        foreach ($this->listSatuan as $ls) {
                            if ($ls['id'] == $k['satuan']) {
                                $sat = $ls['satuan'];
                            }
                        }
                        if ($k['used'] == 1) {
                            $classUse = "danger";
                        }
                        $tr_print = $tr_print . "<tr><td>" . strtoupper($k['deskripsi']) . "</td><tr><td align='right'> " . $k['jumlah'] . $sat . ", Rp" . number_format($k['harga_jual']) . "</td><tr>";

                    ?>

                        <table class="table table-borderless table-sm mb-0 pb-0">
                            <tr>
                                <td><small>#<?= $k['id'] ?></small> <?= strtoupper($k['deskripsi']) ?> <small><i class="far fa-check-circle text-<?= $classUse ?>"></i></small></td>
                                <td align="right"><?= $k['jumlah'] . " <small>" . $sat . "</small>" ?></td>
                                <td align="right"><?= number_format($k['harga_jual']) ?></td>
                            </tr>
                        <?php
                        $total += $k['harga_jual'];
                    } ?>
                        <tr class="border-top">
                            <td colspan="2"><b>TOTAL</b></td>
                            <td align="right"><b><?= number_format($total) ?></b></td>
                        </tr>

                        <tr class="d-none">
                            <td colspan="10">
                                <div id="print<?= $ak ?>" style="width:50mm;background-color:white; border:1px solid grey">
                                    <style>
                                        html .table {
                                            font-family: 'Titillium Web', sans-serif;
                                        }

                                        html .content {
                                            font-family: 'Titillium Web', sans-serif;
                                        }

                                        html body {
                                            font-family: 'Titillium Web', sans-serif;
                                        }

                                        hr {
                                            border-top: 1px dashed black;
                                        }

                                        td {
                                            vertical-align: top;
                                        }
                                    </style>

                                    <table style="width:42mm; font-size:x-small; margin-top:10px; margin-bottom:10px">
                                        <tr>
                                            <td style="text-align: center; padding:6px;">
                                                <b> <?= strtoupper($this->userData['nama']) ?></b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <hr>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Trx. ID : <?= $ak ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <hr>
                                            </td>
                                        </tr>
                                        <?= $tr_print ?>
                                        <tr>
                                            <td>
                                                <hr>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>[ TOTAL ] <?= number_format($total) ?></b></td>
                                        </tr>
                                    </table>

                                </div>
                            </td>
                        </tr>

                        </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    function Print(id) {
        var printContents = document.getElementById("print" + id).innerHTML;
        var originalContents = document.body.innerHTML;
        window.document.body.style = 'margin:0';
        window.document.writeln(printContents);
        window.print();
        location.reload(true);
    }
</script>