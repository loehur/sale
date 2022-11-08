<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm table-striped">
                    <?php foreach ($data as $d) {
                        if ($d['stok'] == 0) { ?>
                            <tr>
                                <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                                    <br>
                                    <?= strtoupper($d['kode_barang']) . " <span class='float-right'>" . $d['stok'] . "</span>" ?>
                                </td>
                            </tr>
                    <?php }
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