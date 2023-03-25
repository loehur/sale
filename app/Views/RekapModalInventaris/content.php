<div class="content">
    <div class="container-fluid">
        <label class="mb-3 ml-3"><b>Modal Inventaris</b></label>
        <div class="row mr-1 ml-1">
            <?php
            $akumModal = 0;
            $akumSusut = 0;
            foreach ($data as $key => $m) {
            ?>
                <div class="col-12 mb-2 pb-1 border-bottom">
                    <?= strtoupper($key) ?><span class="float-right">Rp <?= number_format($m['modal']) ?> <small class="text-danger">(<?= number_format($m['susut']) ?>)</small></span>
                </div>
            <?php
                $akumModal += $m['modal'];
                $akumSusut += $m['susut'];
            } ?>

            <div class="col-12 mb-2">
                <b><span class="text-success">TOTAL MODAL INVENTARIS</span><span class="float-right text-success">Rp <?= number_format($akumModal) ?> <small class="text-danger">(<?= number_format($akumSusut) ?>)</small></span></b>
            </div>
        </div>

    </div>