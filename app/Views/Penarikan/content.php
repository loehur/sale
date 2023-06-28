<?php $d = $data['kas'] ?>
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
        <div class="row">
            <div class="col-auto mr-auto">
                <div id="info"></div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php if ($d['fee'] > 0) { ?>
                <div class="col-md-6">
                    <form action="<?= $this->BASE_URL ?>Penarikan/tarik/1" method="post">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label>Jumlah</label>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control form-control-sm" name="jumlah" placeholder="Jumlah" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label>Keterangan</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" name="ket" placeholder="Keterangan">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label>Password</label>
                            </div>
                            <div class="col">
                                <input type="password" class="form-control form-control-sm" name="pass" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-success btn-block">
                                    Cashout Fee
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>
            <div class="col-md-6">
                <form action="<?= $this->BASE_URL ?>Penarikan/tarik/0" method="post">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label>Jumlah</label>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control form-control-sm" name="jumlah" placeholder="Jumlah" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label>Keterangan</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" name="ket" placeholder="Keterangan">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label>Password</label>
                        </div>
                        <div class="col">
                            <input type="password" class="form-control form-control-sm" name="pass" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">
                                Cashout Supplier
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 border pb-1">
                <table class="table table-borderless table-sm mb-0 pb-0">
                    <?php
                    $no = 0;
                    echo "<tbody>";
                    foreach ($d['riwayat'] as $a) {
                        echo "<tr>";
                        echo "<td>";
                        echo $a['insertTime'] . "<br>";
                        echo '<i class="fas fa-caret-right"></i> ';
                        echo ($a['kas_jenis'] == 0) ? "Supplier" : "Fee";
                        echo "</td>";
                        echo "<td class='text-info'>" . $a['keterangan'] . "<br><i class='fas fa-caret-right'></i> " . $a['id_user'] . "</td>";
                        echo "<td align='right'>" . number_format($a['jumlah']) . "</td>";
                        echo "<td>";
                        switch ($a['kas_status']) {
                            case 1:
                                echo "<i class='text-success fas fa-check-circle'></i>";
                                break;
                            case 0;
                                echo "<span class='text-warning'>Proses</span>";
                                break;
                            case 2;
                                echo "<span class='text-danger'>Ditolak</span>";
                                break;
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $("#info").fadeOut();
        $("form").on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                type: $(this).attr("method"),
                success: function(response) {
                    if (response == 1) {
                        location.reload(true);
                    } else {
                        $("#info").hide();
                        $("#info").fadeIn(1000);
                        $("#info").html('<div class="alert alert-danger" role="alert">' + response + '</div>');
                    }
                },
            });
        });
    });
</script>