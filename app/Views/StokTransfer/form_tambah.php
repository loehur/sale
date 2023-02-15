<?php
$a = $data['stok'];

$sat = "PCS";
foreach ($this->listSatuan as $ls) {
    if ($ls['id'] == $a['satuan']) {
        $sat = $ls['satuan'];
    }
}

?>
<div class="content pt-2 pb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto mb-2">
                <b>
                    <?= strtoupper($a['merk']) ?> | <span class="text-danger"><?= strtoupper($a['model']) . " " . strtoupper($a['deskripsi']) ?></span>
                    | Rp<?= number_format($a['harga'] + ($a['harga'] * ($a['margin'] / 100))) ?>
                    | Sisa: <?= number_format($data['sisa']) . " " . $sat ?>
                </b>
            </div>
        </div>
        <hr>
        <?php
        if (isset($a['merk']) && $data['sisa'] > 0) { ?>
            <div class="row" id="form_tambah">
                <div class="col-auto mr-auto">
                    <form class="tambah" action="<?= $this->BASE_URL ?>StokTransfer/cart/<?= $a['id'] ?>" method="post">
                        <div class="row mb-2">
                            <div class="col mt-auto">
                                <label>Tujuan</label>
                            </div>
                            <div class="col-auto">
                                <select id="tujuan_toko" class="form-control form-control-sm" name="tujuan" required>
                                    <?php
                                    foreach ($this->stafData as $a) {
                                        if ($a['id_user'] <> $this->userData['id_user']) { ?>
                                            <option value="<?= $a['id_user'] ?>" <?= ($this->setting['toko_tujuan'] == $a['id_user'] ? "selected" : "") ?>> <?= strtoupper($a['nama']) ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col mt-auto">
                                <label>Jumlah</label>
                            </div>
                            <div class="col">
                                <input type="number" value="1" min="0.01" step="0.01" class="form-control form-control-sm" name="tambah" max="<?= $data['sisa'] ?>" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-success btn-block">
                                    Transfer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $("#info").hide();
        $('input[name=tambah]').focus();
    });

    $("form.tambah").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(res) {
                location.reload(true);
            },
        });
    });

    $('select#tujuan_toko').on("change", function(event) {
        var val = $(this).val();
        $.ajax({
            url: "<?= $this->BASE_URL ?>Input/updateLogTujuanToko/",
            data: {
                toko: val
            },
            type: "POST",
            success: function() {

            },
        });
    });
</script>