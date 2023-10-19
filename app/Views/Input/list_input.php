    <div class="content mb-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col mr-auto pb-2 pt-2">
                    <table class="table table-sm">
                        <?php
                        foreach ($data as $d) {
                            $sat = "PCS";
                            foreach ($this->listSatuan as $ls) {
                                if ($ls['id'] == $d['satuan']) {
                                    $sat = $ls['satuan'];
                                }
                            } ?>
                            <tr>
                                <td><small class="text-primary"><b><?= $d['id_user'] ?></b></small><br><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?></td>
                                <td><small><?= $d['insertTime'] ?></small><br><?= $d['jumlah'] . " " . $sat ?></td>
                                <td align="right"></td>
                                <td><a class='text-danger text-decoration-none' href="<?= $this->BASE_URL ?>Input/hapus_list/<?= $d['id'] ?>"><i class='fas fa-times-circle'></i></a></td>
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