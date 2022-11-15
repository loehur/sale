<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <label><b>Data Stok Barang dan Jumlah Penjualan</b></label>
                <table class="table table-sm table-striped table-responsive" style="max-height: 589px;">
                    <?php
                    foreach ($data['stok'] as $d) { ?>
                        <tr>
                            <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                                <br>
                                <?= "[" . strtoupper($d['id_user'] . "] [" . $d['kode_barang']) . "] Rp" . number_format($d['harga']) ?>
                            </td>
                            <td align="right">
                                <?= $d['stok'] ?><br>
                                <?php
                                foreach ($data['laris'] as $s) {
                                    if ($s['id_barang'] == $d['id_barang']) {
                                        echo "Terjual " . number_format($s['jumlah'], 2);
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    <?php  } ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>