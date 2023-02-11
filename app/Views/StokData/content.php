<pre>
    <?php
    //print_r($data);
    ?>
</pre>

<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <label class="text-danger"><b>Data Stok Barang Kosong</b></label>
        <div class="row">
            <?php
            $id_user = "";
            $counter = 0;
            $run = false;

            foreach ($data[0] as $colom => $col) {
                echo '<div class="col-md-6">';
                foreach ($col as $id_user => $val) {
                    if (count($val) == 0) {
                        continue;
                    }
            ?>
                    <div>
                        <table class="table table-sm p-0 m-0">
                            <tr class="table-borderless">
                                <td colspan="2"></td>
                            </tr>
                            <tr class="table-danger">
                                <td colspan="2"><b><?= strtoupper($id_user) ?></b> | <?= count($val) ?></td>
                            </tr>
                            <?php foreach ($val as $d) {
                                if (isset($d['en'])) {
                                    if ($d['en'] == 0) {
                                        continue;
                                    }
                                }
                                if ($d['stok'] > 10000) {
                                    continue;
                                }
                            ?>
                                <tr>
                                    <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                                        <br>
                                        <?= "<a href='" . $this->BASE_URL . "StokOperasi/index/" . $d['kode_barang'] . "/" . $id_user . "'>" . strtoupper($d['kode_barang']) . "</a> Rp" . number_format($d['harga']) ?>
                                    </td>
                                    <td align="right" nowrap>
                                        <b><?= $d['stok'] ?></b><br>
                                        <?= "T-" . number_format($d['laku'], 2); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
            <?php }
                echo "</div>";
            }
            ?>
        </div>
        <hr>
        <label class="text-success"><b>Data Stok Barang Tersedia</b></label>
        <div class="row">
            <?php
            $id_user = "";
            $counter = 0;
            $run = false;

            foreach ($data[1] as $colom => $col) {
                echo '<div class="col-md-6">';
                foreach ($col as $id_user => $val) {
                    if (count($val) == 0) {
                        continue;
                    }
            ?>
                    <div>
                        <table class="table table-sm p-0 m-0">
                            <tr class="table-borderless">
                                <td colspan="2"></td>
                            </tr>
                            <tr class="table-success">
                                <td colspan="2"><b><?= strtoupper($id_user) ?></b></td>
                            </tr>
                            <?php foreach ($val as $d) {
                                if (isset($d['en'])) {
                                    if ($d['en'] == 0) {
                                        continue;
                                    }
                                }
                            ?>
                                <tr>
                                    <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                                        <br>
                                        <?= "<a href='" . $this->BASE_URL . "StokOperasi/index/" . $d['kode_barang'] . "/" . $id_user . "'>" . strtoupper($d['kode_barang']) . "</a> Rp" . number_format($d['harga']) ?>
                                    </td>
                                    <td align="right" nowrap>
                                        <b><?= $d['stok'] ?></b><br>
                                        <?= "T-" . number_format($d['laku'], 2); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
            <?php }
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>