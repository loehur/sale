<div class="content pt-2 pb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto mb-2">
                <b>
                    <?= strtoupper($data['merk']) ?> | <span class="text-danger"><?= strtoupper($data['model']) . " " . strtoupper($data['deskripsi']) ?></span>
                    | Rp<?= number_format($data['harga'] + ($data['harga'] * ($data['margin'] / 100))) ?>
                    | Sisa: <?= $data['stok'] ?>
                </b>
            </div>
        </div>
        <?php
        if (isset($data['merk']) && $data['stok'] > 0) { ?>
            <div class="row" id="form_tambah">
                <div class="col-auto mr-auto">
                    <form class="tambah" action="<?= $this->BASE_URL ?>Transaksi/cart/<?= $data['id'] ?>" method="post">
                        <div class="row mb-2">
                            <div class="col-auto">
                                <input type="number" value="1" min="1" class="form-control form-control-sm" name="tambah" max="<?= $data['stok'] ?>" placeholder="" required>
                            </div>
                            <div class="col pl-0">
                                <button type="submit" class="btn btn-sm btn-success btn-block">
                                    Tambah
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
</script>