    <div class="content mb-2" style="padding-bottom: 70px;">
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
                                <td><a class='text-danger text-decoration-none' href="<?= $this->BASE_URL ?>StokPakai/hapusCart/<?= $d['id'] ?>"><i class="bi bi-x-circle"></i></a></td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                    <div class="ml-auto p-1 float-right"><a class="terima" href="<?= $this->BASE_URL ?>Transaksi/cekOut_pakai"><button class="rounded border-light"><b>Check Out</b></button></a></div>
                </div>
            </div>
        </div>
    </div>