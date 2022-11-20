<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <label><b>Data Stok Barang dan Jumlah Penjualan</b></label>

        <div class="row">
            <?php
            $id_user = "";
            $counter = 0;
            $run = false;

            foreach ($data as $colom) {
                echo '<div class="col-md-6">';
                foreach ($colom as $id_user => $val) { ?>
                    <div>
                        <table class="table table-sm p-0 m-0">
                            <tr class="table-borderless">
                                <td colspan="2"></td>
                            </tr>
                            <tr class="table-success">
                                <td colspan="2"><b><?= strtoupper($id_user) ?></b></td>
                            </tr>
                            <?php foreach ($val as $d) { ?>
                                <tr>
                                    <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                                        <br>
                                        <?= "[" . strtoupper($d['kode_barang']) . "] Rp" . number_format($d['harga']) ?>
                                    </td>
                                    <td align="right">
                                        <b><?= $d['stok'] ?></b><br>
                                        <?php
                                        echo "T-" . number_format($d['laris'], 2);
                                        ?>
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