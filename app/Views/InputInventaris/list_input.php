    <div class="content mb-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col mr-auto pb-2 pt-2">
                    <label class="text-primary"><b>Proses Input</b></label>
                    <table class="table table-striped table-sm table-light rounded table-responsive" style="max-height: 200px;">
                        <?php
                        foreach ($data as $d) { ?>
                            <tr>
                                <td><small>[<?= $d['id_user'] ?>]</small><br><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?></td>
                                <td><small><?= $d['insertTime'] ?></small><br><?= strtoupper($d['posisi']) ?></td>
                                <td align="right"></td>
                                <td><a class='text-danger text-decoration-none' href="<?= $this->BASE_URL . $this->ACTIVE_CONTROLLER ?>/hapus_list/<?= $d['id'] ?>"><i class='fas fa-times-circle'></i></a></td>
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