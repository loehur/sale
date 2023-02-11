<?php $currentDay = date('d'); ?>
<?php $currentMonth = date('m'); ?>
<?php $currentYear = date('Y'); ?>

<?php
$modal = [];
$akumModal = 0;
foreach ($data as $s) {
    if ($s['stok'] > 10000) {
        continue;
    }
    if ($s['stok'] > 0) {
        if (isset($modal[$s['id_user']])) {
            $modal[$s['id_user']] += ($s['stok'] * $s['harga']);
        } else {
            $modal[$s['id_user']] = ($s['stok'] * $s['harga']);
        }
        $akumModal += $s['stok'] * $s['harga'];
    }
}

?>
<div class="content">
    <div class="container-fluid">
        <label class="mb-3 ml-3"><b>Modal Bahan Baku dan Penjualan Toko</b></label>
        <div class="row mr-1 ml-1">
            <?php foreach ($modal as $key => $m) {
            ?>
                <div class="col-12 mb-2 pb-1 border-bottom">
                    <?= strtoupper($key) ?><span class="float-right">Rp <?= number_format($m) ?></span>
                </div>
            <?php } ?>

            <div class="col-12 mb-2">
                <b><span class="text-success">TOTAL MODAL</span><span class="float-right text-success">Rp <?= number_format($akumModal) ?></span></b>
            </div>
        </div>

    </div>