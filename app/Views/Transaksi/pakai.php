<?php if (count($data) <> 0) { ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col mr-auto">
                    <label class="text-danger"><b>Pengajuan Pakai</b> <small>(Admin Checking)</small></label>
                    <table class="table table-sm rounded">
                        <tr>
                            <?php
                            $total = 0;
                            foreach ($data as $d) {
                            ?>
                                <td><?= strtoupper($d['deskripsi']) ?> [ <?= $d['jumlah'] ?> ]</td>
                            <?php
                            } ?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>