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
<div class="content pt-2">
    <div class="container-fluid">
        <h6><?= "<b>" . strtoupper($a['merk'] . " " . $a['model'] . " " . $a['deskripsi']) . "</b>" ?>,<br>Harga/<?= $sat ?>: Rp<?= number_format($a['harga'] + ($a['harga'] * ($a['margin'] / 100))) ?>, Stok: <b><?= number_format($data['sisa'], 2) . "</b> " . $sat ?></h6>
        <div class="row mb-2 mt-3">
            <div class="col-auto">
                <?php if (count($b) > 0) { ?>
                    <span class="text-success">Penjualan Paket</span>
                <?php } ?>
                <table class="table table-sm mb-0">
                    <?php
                    foreach ($b as $s) {
                        if ($data['sisa'] >= $s['jumlah']) {
                    ?>
                            <tr>
                                <td class="pl-0"><?= strtoupper($s['nama_sub']) ?></td>
                                <td align="right" nowrap><?= number_format($s['jumlah'], 2) . " " . $sat  ?></td>
                                <td align="right">Rp<?= number_format(($a['harga'] * $s['jumlah']) * ($s['margin'] / 100) + ($a['harga'] * $s['jumlah'])) ?></td>
                                <td><a href="<?= $this->BASE_URL ?>Transaksi/cart_sub/<?= $a['id'] ?>/<?= $s['id'] ?>"><i class="text-success fas fa-plus-square"></i></a></td>
                            </tr>
                    <?php }
                    } ?>
                </table>
            </div>
        </div>
        <?php
        if (isset($a['merk']) && $data['sisa'] > 0) { ?>
            <div class="row" id="form_tambah">
                <div class="col-auto">
                    <form class="tambah" action="<?= $this->BASE_URL ?>Transaksi/cart/<?= $a['id'] ?>" method="post">
                        <div class="row mb-2">
                            <div class="col-auto pr-2">
                                <span class="text-info">Non Paket</span><br>
                                Rp<?= number_format($a['harga'] + ($a['harga'] * ($a['margin'] / 100))) ?>/<?= $sat ?>
                            </div>
                            <div class="col-auto pl-0 pr-2 pt-1">
                                <input type="number" style="width: 70px;" value="1" step="0.01" min="0.01" class="form-control form-control-sm" name="tambah" max="<?= $data['sisa'] ?>" placeholder="" required>
                            </div>
                            <div class="col-auto pl-0 pt-1">
                                <button type="submit" class="btn btn-sm btn-info">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <hr class="mt-3 mb-1">
            <div class="row" id="form_tambah" style="padding-bottom: 70px;">
                <div class="col">
                    <span class="text-danger">Pemakaian Oprasional</span> | <span class="text-dark"><?= $sat  ?></span></h6>
                    <form class="tambah" action="<?= $this->BASE_URL ?>Transaksi/cart_pakai/<?= $a['id'] ?>" method="post">
                        <div class="row mb-2 mt-1">
                            <div class="col-auto pr-2">
                                <input type="number" style="width: 70px;" value="1" min="0.01" step="0.01" class="form-control form-control-sm" name="tambah_pakai" max="<?= $data['sisa'] ?>" placeholder="" required>
                            </div>
                            <div class="col-auto pl-0">
                                <button type="submit" class="btn btn-sm btn-danger btn-block">
                                    <i class="fas fa-plus-square"></i> Pakai
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