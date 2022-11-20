<?php if (count($data) <> 0) { ?>
    <div class="content">
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
                                <td><?= strtoupper($d['deskripsi']) ?></td>
                                <td>[ <?= $d['jumlah'] ?> ]</td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>


<?php } ?>