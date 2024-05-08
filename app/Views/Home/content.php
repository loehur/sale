<?php $d = $data['kas']; ?>

<?php $currentDay = date('d'); ?>
<?php $currentMonth = date('m'); ?>
<?php $currentYear = date('Y'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <table class="table table-sm table-borderless table-striped">
                    <tr>
                        <td><b>Kas Toko</b></td>
                        <td align="right"><b>Rp<?= number_format($d['total']) ?></b></td>
                    </tr>
                    <?php if ($d['fee'] > 0) { ?>
                        <tr>
                            <td>Fee</td>
                            <td align="right">Rp<?= number_format($d['fee']) ?></td>
                        </tr>
                        <tr>
                            <td>Supplier</td>
                            <td align="right">Rp<?= number_format($d['sup']) ?></td>
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
                        }

                        $nTunai = [];
                        $pNT = 0;
                        $nTunai = $this->model("Get")->where("nontunai", "ref = '" . $k['ref'] . "'");
                        if (count($nTunai) > 0) {
                            foreach ($nTunai as $nt) {
                                if ($nt['tr_status'] <> 2) {
                                    $pNT += $nt['jumlah'];
                                }
                            }
                        }
                        $sisa_bill = $total - $pNT;
                        ?>

                        <?php if ($this->userData['user_tipe'] == 100) { ?>
                            <tr class="border-top">
                                <td colspan="2" class="py-2"><b>TOTAL</b> <button data-bs-toggle="modal" data-max="<?= $sisa_bill ?>" data-ref="<?= $k['ref'] ?>" data-bs-target="#exampleModal" class="float-end nTunai ms-2 border-0 bg-light rounded shadow-sm">+ Nontunai</button></td>
                                <td align="right" class="py-2"><b><?= number_format($total) ?></b></td>
                            </tr>
                        <?php } else { ?>
                            <tr class="border-top">
                                <td colspan="2" class="py-2"><b>TOTAL</b></td>
                                <td align="right" class="py-2"><b><?= number_format($total) ?></b></td>
                            </tr>
                        <?php } ?>
                        <?php
                        if (count($nTunai) > 0) { ?>
                            <tr class="border-top">
                                <td colspan="3"></td>
                            </tr>
                            <?php
                            foreach ($nTunai as $nt) {

                                if ($nt['tr_status'] == 0) {
                                    $nt_status = "Checking";
                                } elseif ($nt['tr_status'] == 2) {
                                    $nt_status = "Rejected";
                                } else {
                                    $nt_status = "";
                                }
                            ?>
                                <tr class="text-success">
                                    <td colspan="2"><?= substr($nt['insertTime'], 0, -3) ?> <span class="text-danger"><?= $nt_status ?></span> <span class="float-end"><?= $nt['metode'] ?></span></td>
                                    <td class="text-end"><?= number_format($nt['jumlah']) ?></td>
                                </tr>
                            <?php }
                            if (($total - $pNT) > 0) { ?>
                                <tr class="text-dark fw-bold">
                                    <td colspan="2"><span class="float-end">Tunai</span></td>
                                    <td class="text-end"><?= number_format($total - $pNT) ?></td>
                                </tr>
                        <?php }
                        }
                        ?>


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
                                        <tr>
                                            <td>
                                                <hr>
                                            </td>
                                        </tr>
                                        <?php
                                        if (count($nTunai) > 0) {
                                            foreach ($nTunai as $nt) {
                                                if ($nt['tr_status'] == 0) {
                                                    $nt_status = "Checking";
                                                } elseif ($nt['tr_status'] == 2) {
                                                    $nt_status = "Rejected";
                                                } else {
                                                    $nt_status = "";
                                                }
                                        ?>
                                                <tr>
                                                    <td align="right"><?= $nt_status ?> [ <?= $nt['metode'] ?> ] <?= number_format($nt['jumlah']) ?></td>
                                                </tr>
                                            <?php } ?>
                                            <?php if (($total - $pNT) > 0) { ?>
                                                <tr>
                                                    <td align="right">[ Tunai ] <?= number_format($total - $pNT) ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php }
                                        ?>

                                        <tr>
                                            <td align="right">.<br><br><br><br>.</td>
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

<div class="modal" id="exampleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran Nontunai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" class="ajax" action="<?= $this->BASE_URL ?>Home/nontunai">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col pe-1">
                            <div class="form-floating">
                                <input type="number" name="jumlah" required class="form-control" id="floatingInput">
                                <label for="floatingInput">Jumlah</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" name="metode" required aria-label="Floating label select example">
                                    <option value="" selected></option>
                                    <option value="QRIS">QRIS</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="E-Money">E-Money</option>
                                </select>
                                <label for="floatingSelect">Metode Bayar</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="note" class="form-control" id="floatingInputsdf">
                                <label for="floatingInputsdf">Catatan, Contoh: BCA</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="nt_ref" required name="ref">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    var max_pay = 0;


    function Print(id) {
        var divContents = document.getElementById("print" + id).innerHTML;
        var a = window.open('');
        a.document.write('<html>');
        a.document.write('<title>Print Page</title>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        var window_width = $(window).width();
        a.print();

        if (window_width > 600) {
            a.close()
        } else {
            setTimeout(function() {
                a.close()
            }, 60000);
        }
    }

    $(".nTunai").click(function() {
        $("#nt_ref").val($(this).attr("data-ref"));
        max_pay = $(this).attr("data-max");
        $("input[name=jumlah").attr("max", max_pay);
        $("input[name=jumlah").val(max_pay);
    })

    $("form.ajax").submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: $(this).serialize(),
            success: function(res) {
                if (res == 0) {
                    location.reload(true);
                } else {
                    alert(res);
                }
            }
        });
    })

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