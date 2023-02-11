<?php $d = $data['kas']; ?>

<?php $currentDay = date('d'); ?>
<?php $currentMonth = date('m'); ?>
<?php $currentYear = date('Y'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <p class="h6 text-danger"><strong><?= strtoupper($this->userData['nama']) ?></strong></p>
            </div>
            <div class="col-md-6">
                <table class="table table-sm float-right table-borderless">
                    <tr>
                        <td align="right"><b>Kas Toko</b></td>
                        <td align="right"><b>Rp <?= number_format($d['total']) ?></b></td>
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

<div class="content">
    <div class="container-fluid">
        <form action="<?= $this->BASE_URL ?>Home/index" method="post">
            <div class="row">
                <div class="col-auto pr-0">Month
                    <select name="m" class="form-control form-control-sm" onchange="hideAll()" style="width: auto;">
                        <option class="text-right" value="01" <?php if ($currentMonth == '01') {
                                                                    echo 'selected';
                                                                } ?>>01</option>
                        <option class="text-right" value="02" <?php if ($currentMonth == '02') {
                                                                    echo 'selected';
                                                                } ?>>02</option>
                        <option class="text-right" value="03" <?php if ($currentMonth == '03') {
                                                                    echo 'selected';
                                                                } ?>>03</option>
                        <option class="text-right" value="04" <?php if ($currentMonth == '04') {
                                                                    echo 'selected';
                                                                } ?>>04</option>
                        <option class="text-right" value="05" <?php if ($currentMonth == '05') {
                                                                    echo 'selected';
                                                                } ?>>05</option>
                        <option class="text-right" value="06" <?php if ($currentMonth == '06') {
                                                                    echo 'selected';
                                                                } ?>>06</option>
                        <option class="text-right" value="07" <?php if ($currentMonth == '07') {
                                                                    echo 'selected';
                                                                } ?>>07</option>
                        <option class="text-right" value="08" <?php if ($currentMonth == '08') {
                                                                    echo 'selected';
                                                                } ?>>08</option>
                        <option class="text-right" value="09" <?php if ($currentMonth == '09') {
                                                                    echo 'selected';
                                                                } ?>>09</option>
                        <option class="text-right" value="10" <?php if ($currentMonth == '10') {
                                                                    echo 'selected';
                                                                } ?>>10</option>
                        <option class="text-right" value="11" <?php if ($currentMonth == '11') {
                                                                    echo 'selected';
                                                                } ?>>11</option>
                        <option class="text-right" value="12" <?php if ($currentMonth == '12') {
                                                                    echo 'selected';
                                                                } ?>>12</option>
                    </select>
                </div>
                <div class="col-auto pr-0">Year
                    <select name="y" class="form-control form-control-sm" onchange="hideAll()" style="width: auto;">
                        <?php

                        $yearStart = 2022;
                        while ($yearStart <= $currentYear) { ?>
                            <option class="text-right" value="<?= $yearStart ?>" <?php if ($currentYear == $yearStart) {
                                                                                        echo 'selected';
                                                                                    } ?>><?= $yearStart ?></option>
                        <?php $yearStart++;
                        }
                        ?>
                    </select>
                </div>
                <div class="col pr-0 mr-auto">
                    <button type="submit" class="btn btn-sm btn-primary position-absolute" style="bottom:0">Cek</button>
                </div>
        </form>
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
                    <table class="table table-borderless table-sm mb-0 pb-0">
                        <?php
                        $tr_print = "";
                        foreach ($value as $k) {
                            $sat = "PCS";
                            foreach ($this->listSatuan as $ls) {
                                if ($ls['id'] == $k['satuan']) {
                                    $sat = $ls['satuan'];
                                }
                            }
                            $tr_print = $tr_print . "<tr><td>" . strtoupper($k['deskripsi']) . "</td><tr><td align='right'> " . $k['jumlah'] . $sat . ", Rp" . number_format($k['harga_jual']) . "</td><tr>";

                        ?>
                            <tr>
                                <td><small>#<?= $k['id'] ?></small> <?= strtoupper($k['deskripsi']) ?></td>
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

    $("a.hapusRef").on('dblclick', function(e) {
        e.preventDefault();
        var refNya = $(this).attr('data-ref');
        $.ajax({
            url: '<?= $this->BASE_URL ?>Home/hapus',
            data: {
                ref: refNya,
            },
            type: "POST",
            beforeSend: function() {
                $(".loaderDiv").fadeIn("fast");
            },
            success: function(response) {
                loadDiv();
            },
            complete: function() {
                $(".loaderDiv").fadeOut("slow");
            }
        });
    });
</script>