<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col mr-auto">
                <label class="text-info"><b>Keranjang Belanja</b></label>
                <table class="table table-sm rounded mb-0">
                    <?php
                    $total = 0;
                    foreach ($data as $d) {
                        $harga_jual = $d['harga_jual'];

                        $sat = "PCS";
                        foreach ($this->listSatuan as $ls) {
                            if ($ls['id'] == $d['satuan']) {
                                $sat = $ls['satuan'];
                            }
                        }
                    ?>
                        <tr>
                            <td class="pl-0"><?= strtoupper($d['deskripsi']) ?></td>
                            <td><?= $d['jumlah'] ?> <?= $sat ?></td>
                            <td align="right">Rp<?= number_format($harga_jual) ?></td>
                            <td class="pr-0"><a class='text-danger text-decoration-none' href="<?= $this->BASE_URL ?>Transaksi/hapusCart/<?= $d['id'] ?>"><i class='fas fa-times-circle'></i></a></td>
                        </tr>
                    <?php
                        $total += $harga_jual;
                    } ?>

                    <?php
                    if ($total > 0) { ?>
                        <tr class="table-info">
                            <td><b>TOTAL</b></td>
                            <td colspan="2" align="right"><b>Rp<?= number_format($total) ?></b></td>
                            <td><b></b></td>
                        </tr>
                    <?php }
                    ?>
                </table>
                <div class="ml-auto mb-1 mt-1 float-right"><a class="terima" href="<?= $this->BASE_URL ?>Transaksi/cekOut"><button class="btn-info">Check Out</button></a></div>
            </div>
        </div>
    </div>
</div>
<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>