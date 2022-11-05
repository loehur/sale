    <div class="content mb-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col mr-auto pb-2 pt-2">
                    <label class="text-info"><b>Keranjang Belanja</b></label>
                    <table class="table table-striped table-sm table-light rounded">
                        <?php
                        $total = 0;
                        foreach ($data as $d) {
                            $harga_jual = $d['harga_jual'];
                        ?>
                            <tr>
                                <td><?= strtoupper($d['deskripsi']) ?></td>
                                <td>[<?= $d['jumlah'] ?>]</td>
                                <td align="right">Rp<?= number_format($harga_jual) ?></td>
                                <td><a class='text-danger text-decoration-none' href="<?= $this->BASE_URL ?>Transaksi/hapusCart/<?= $d['id'] ?>"><i class='fas fa-times-circle'></i></a></td>
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
                    <div class="ml-auto p-1 float-right"><a class="terima" href="<?= $this->BASE_URL ?>Transaksi/cekOut"><button class="rounded border-light"><b>Cek Out</b></button></a></div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
    <script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
    <script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>