<?php if (count($data) == 0) {
    exit();
} ?>

<div class="content mb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col mr-auto pb-2 pt-2">
                <label class="text-danger"><b>Pengajuan Pakai</b></label>
                <table class="table table-sm rounded">
                    <?php
                    $total = 0;
                    foreach ($data as $d) {
                    ?>
                        <tr>
                            <td>[ <?= strtoupper($d['id_user']) ?> ]<br><?= strtoupper($d['deskripsi']) ?></td>
                            <td>[ <?= $d['jumlah'] ?> ]</td>
                        </tr>
                    <?php
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