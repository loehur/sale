    <div class="content mb-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col mr-auto pb-2 pt-2">
                    <label class="text-danger"><b>Pengajuan Pakai</b></label>
                    <table class="table table-sm rounded">
                        <?php
                        $total = 0;
                        foreach ($data as $d) {
                            $harga_jual = $d['harga_jual'];
                        ?>
                            <tr>
                                <td>[ <?= strtoupper($d['id_user']) ?> ]<br><?= strtoupper($d['deskripsi']) ?></td>
                                <td>[ <?= $d['jumlah'] ?> ]</td>
                                <td><a class='text-danger text-decoration-none' href="<?= $this->BASE_URL ?>StokPakai/hapusCart/<?= $d['id'] ?>"><i class='fas fa-times-circle'></i></a></td>
                            </tr>
                        <?php
                            $total += $harga_jual;
                        } ?>
                    </table>
                    <div class="ml-auto p-1 float-right"><a class="terima" href="<?= $this->BASE_URL ?>Transaksi/cekOut_pakai"><button class="rounded border-light"><b>Check Out</b></button></a></div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
    <script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
    <script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>