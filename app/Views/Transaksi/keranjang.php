    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto mr-auto">
                    <label class="text-info"><b>Keranjang Belanja</b></label>
                    <table class="table table-sm">
                        <?php
                        $total = 0;
                        foreach ($data as $d) {
                            $harga_jual = $d['harga_jual'];
                        ?>
                            <tr>
                                <td>#<?= $d['id_barang'] ?></td>
                                <td><?= strtoupper($d['deskripsi']) ?></td>
                                <td><?= $d['jumlah'] ?></td>
                                <td>Rp<?= number_format($harga_jual) ?></td>
                                <td><a class='text-danger text-decoration-none' href="<?= $this->BASE_URL ?>Transaksi/hapusCart/<?= $d['id'] ?>"><i class='fas fa-times-circle'></i></a></td>
                            </tr>
                        <?php
                            $total += $harga_jual;
                        } ?>

                        <?php
                        if ($total > 0) { ?>
                            <tr>
                                <td></td>
                                <td colspan="2" align="right"><a class="terima" href="<?= $this->BASE_URL ?>Transaksi/cekOut"><button class="rounded border-light"><b>Cek Out</b></button></a></td>
                                <td colspan="1" align="right"><b>Rp<?= number_format($total) ?></b></td>
                            </tr>
                        <?php }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <!-- SCRIPT -->
    <script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
    <script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
    <script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>