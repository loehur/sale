<?php $d = $data['kas']; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <?= $this->userData['nama'] ?>
            </div>
            <div class="col-md-6">
                <table class="table table-sm float-right">
                    <tr>
                        <td align="right"><b>Kas Toko</b></td>
                        <td align="right"><b><?= number_format($d['total']) ?></b></td>
                    </tr>
                    <?php if ($this->userData['user_tipe'] == 10) {
                    ?>
                        <tr>
                            <td align="right">Supplier</td>
                            <td align="right"><?= number_format($d['sup']) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<hr>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php
            foreach ($data['riwayat'] as $k => $value) {
                $total = 0;
            ?>
                <div class="col-md-6 border pb-1">
                    <table class="table table-borderless table-sm mb-0 pb-0">
                        <?php foreach ($value as $k) {
                            $sat = "PCS";
                            foreach ($this->listSatuan as $ls) {
                                if ($ls['id'] == $k['satuan']) {
                                    $sat = $ls['satuan'];
                                }
                            }
                        ?>
                            <tr>
                                <td><small>#<?= $k['id'] ?></small> - <?= strtoupper($k['deskripsi']) ?></td>
                                <td align="right"><?= $k['jumlah'] . " <small>" . $sat . "</small>" ?></td>
                                <td align="right"><?= number_format($k['harga_jual']) ?></td>
                            </tr>
                        <?php
                            $total += $k['harga_jual'];
                        } ?>
                        <tr class="border-top">
                            <td colspan="2"><b>TOTAL</b></td>
                            <td align="right"><b><?= number_format($total) ?></b></td>
                        </tr>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>