<?php $currentDay = date('d'); ?>
<?php $currentMonth = date('m'); ?>
<?php $currentYear = date('Y'); ?>

<?php
$modal = [];
$akumModal = 0;
foreach ($data as $s) {
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
        <form action="<?= $this->BASE_URL ?>RekapMonth/profit" method="post">
            <div class="row">
                <?php foreach ($modal as $key => $m) {
                ?>
                    <div class="col">
                        <span class="float-right"> <label class="float-right"><?= strtoupper($key) ?></label><br><b>Rp<?= number_format($m) ?></b></span>
                    </div>
                <?php } ?>
                <div class="col">
                    <span class="float-right"> <label class="float-right">TOTAL MODAL</label><br><b>Rp<?= number_format($akumModal) ?></b></span>
                </div>
        </form>
    </div>
</div>

<hr>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">

            </div>
        </div>
    </div>
</div>