<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <label><b>Terlaris</b></label>
                <table class="table table-sm table-striped">
                    <?php
                    foreach ($data['laris'] as $d) {
                    ?>
                        <tr>
                            <td>
                                <?php
                                foreach ($data['stok'] as $s) {
                                    if ($s['id_barang'] == $d['id_barang']) {
                                        $kode = $s['kode_barang'];
                                    }
                                }
                                ?>
                                <?= strtoupper($kode) . " <span class='float-right'>" . $d['jumlah'] . "x</span>" ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <label><b>Stok Data</b></label>
                <table class="table table-sm table-striped table-responsive" style="max-height: 300px;">
                    <?php
                    foreach ($data['stok'] as $d) { ?>
                        <tr>
                            <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                                <br>
                                <?= strtoupper($d['kode_barang']) . " <span class='float-right'>" . $d['stok'] . "</span>" ?>
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