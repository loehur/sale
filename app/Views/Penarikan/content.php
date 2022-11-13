<?php $d = $data['kas'] ?>
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
<?php if ($this->userData['user_tipe'] == 10) { ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="<?= $this->BASE_URL ?>Penarikan/tarik/1" method="post">
                        <div class="row mb-2">
                            <div class="col">
                                <input type="number" class="form-control form-control-sm" name="jumlah" placeholder="Jumlah" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" name="ket" placeholder="Keterangan">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <input type="password" class="form-control form-control-sm" name="pass" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-success btn-block">
                                    Tarik Kas Fee
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="<?= $this->BASE_URL ?>Penarikan/tarik/0" method="post">
                        <div class="row mb-2">
                            <div class="col">
                                <input type="number" class="form-control form-control-sm" name="jumlah" placeholder="Jumlah" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" name="ket" placeholder="Keterangan">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <input type="password" class="form-control form-control-sm" name="pass" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-primary btn-block">
                                    Tarik Kas Supplier
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="<?= $this->BASE_URL ?>Penarikan/tarik/0" method="post">
                        <div class="row mb-2">
                            <div class="col">
                                <input type="number" class="form-control form-control-sm" name="jumlah" placeholder="Jumlah" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" name="ket" placeholder="Keterangan">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <input type="password" class="form-control form-control-sm" name="pass" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-primary btn-block">
                                    Tarik Kas
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<hr>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 border pb-1">
                <table class="table table-borderless table-sm mb-0 pb-0">
                    <?php
                    $no = 0;
                    echo "<tbody>";
                    foreach ($d['riwayat'] as $a) {
                        echo "<tr>";
                        echo "<td class='text-info'>" . $a['keterangan'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>[" . $a['id_user'] . "]</td>";
                        echo "<td>";
                        echo ($a['kas_jenis'] == 0) ? "[Supplier]" : "[Fee]";
                        echo "</td>";
                        echo "<td align='right'>" . number_format($a['jumlah']) . "</td>";
                        echo "<td>" . $a['insertTime'] . "</td>";
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