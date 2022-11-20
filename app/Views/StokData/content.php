<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <label><b>Data Stok Barang dan Jumlah Penjualan</b></label>
                <table class="table table-sm" style="max-height: 589px;">
                    <?php
                    $id_user = "";
                    foreach ($data['stok'] as $d) {
                        if ($id_user <> $d['id_user']) { ?>
                            <tr class="table-borderless">
                                <td colspan="2"></td>
                            </tr>
                            <tr class="table-success">
                                <td colspan="2"><b><?= strtoupper($d['id_user']) ?></b></td>
                            </tr>
                        <?php }
                        $laku = 0;
                        foreach ($data['laris'] as $s) {
                            if ($s['id_barang'] == $d['id_barang'] && $s['id_user'] == $d['id_user']) {
                                $laku = $s['jumlah'];
                            }
                        }
                        if ($laku > 0) { ?>
                            <tr>
                                <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                                    <br>
                                    <?= "[" . strtoupper($d['id_user'] . "] [" . $d['kode_barang']) . "] Rp" . number_format($d['harga']) ?>
                                </td>
                                <td align="right">
                                    <b><?= $d['stok'] ?></b><br>
                                    <?php
                                    foreach ($data['laris'] as $s) {
                                        if ($s['id_barang'] == $d['id_barang'] && $s['id_user'] == $d['id_user']) {
                                            echo "T-" . number_format($s['jumlah'], 2);
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    <?php
                        $id_user = $d['id_user'];
                    } ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>