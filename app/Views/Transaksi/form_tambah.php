<?php
$a = $data['stok'];
$b = $data['sub'];

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
            <div class="col-auto mr-auto">
                <table class="table table-sm table-borderless table-striped">
                    <?php
                    foreach ($b as $s) {
                        if ($data['sisa'] >= $s['jumlah']) {
                    ?>
                            <tr>
                                <td align="right"><?= number_format($s['jumlah'], 2) . " " . $sat  ?></td>
                                <td align="right"><?= number_format(($a['harga'] * $s['jumlah']) * ($s['margin'] / 100) + ($a['harga'] * $s['jumlah'])) ?></td>
                                <td><a href="<?= $this->BASE_URL ?>Transaksi/cart_sub/<?= $a['id'] ?>/<?= $s['id'] ?>"><i class="text-success fas fa-plus-square"></i></a></td>
                            </tr>
                    <?php }
                    } ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-auto mr-auto">
                <table class="table table-sm">
                    <tr>
                        <td>Harga: Rp<?= number_format($a['harga'] + ($a['harga'] * ($a['margin'] / 100))) ?></td>
                        <td>Stok: <b><?= number_format($data['sisa'], 2) . "</b> " . $sat ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
        if (isset($a['merk']) && $data['sisa'] > 0) { ?>
            <div class="row" id="form_tambah" style="padding-bottom: 70px;">
                <div class="col-auto mr-auto">
                    <form class="tambah" action="<?= $this->BASE_URL ?>Transaksi/cart/<?= $a['id'] ?>" method="post">
                        <div class="row mb-2">
                            <div class="col-auto">
                                <input type="number" value="1" min="1" class="form-control form-control-sm" name="tambah" max="<?= $data['sisa'] ?>" placeholder="" required>
                            </div>
                            <div class="col pl-0">
                                <button type="submit" class="btn btn-sm btn-success btn-block">
                                    <i class="fas fa-plus-square"></i>
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