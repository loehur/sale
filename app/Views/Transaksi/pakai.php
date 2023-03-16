<?php if (count($data) <> 0) { ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <label class="text-danger mb-0"><b>Pengajuan Pakai</b> <small>(Admin Checking)</small></label><br>
                    <small>
                        <?php
                        $total = 0;
                        foreach ($data as $d) {
                        ?>
                            <span>[<?= $d['jumlah'] ?>] <?= strtoupper($d['deskripsi']) ?>, </span>
                        <?php
                        } ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
<?php } ?>