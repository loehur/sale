<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <label class="text-danger ml-1"><b>Data Stok Barang (0)</b></label>

        <div class="row">
            <div class="col-md-12">
                <div>
                    <table class="table table-sm p-0 m-0">
                        <?php
                        $stok_0 = true;

                        foreach ($data as $d) {
                            $stok = $d['stok'];

                            if ($stok <> 0 && $stok_0 == true) { ?>
                                <tr>
                                    <td colspan="2"><br><label class="text-success"><b>Data Stok Barang (Ready)</b></label></td>
                                </tr>
                            <?php
                                $stok_0 = false;
                            }
                            ?>
                            <?php

                            if ($d['stok'] > 10000) {
                                continue;
                            }

                            if ($d['en'] == 0) {
                                continue;
                            }

                            if (strlen($d['pengganti']) == 0) {
                            ?>

                                <tr>
                                    <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                                    </td>
                                    <td align="right">
                                        <b><?= $stok ?></b>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>