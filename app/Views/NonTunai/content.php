    <div class="content mb-2" style="padding-bottom: 70px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col mr-auto pb-2 pt-2">
                    <label class="text-danger"><b>Nontunai Checking</b></label>
                    <table class="table table-sm rounded">
                        <?php
                        $total = 0;
                        foreach ($data['antri'] as $d) {
                        ?>
                            <tr>
                                <td><?= $d['metode'] ?><br><small><?= $d['note'] ?></small></td>
                                <td class="text-end"><?= substr($d['insertTime'], 0, -3) ?><br><b><?= number_format($d['jumlah']) ?></b></td>
                                <td class="text-end">
                                    <a class='text-success' href="<?= $this->BASE_URL ?>NonTunai/confirm/<?= $d['nontunai_id'] ?>/1"> Terima</a>
                                    <div class="btn-group">
                                        <button class="btn btn-sm dropdown-toggle shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Tolak
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end p-0">
                                            <a href="<?= $this->BASE_URL ?>NonTunai/confirm/<?= $d['nontunai_id'] ?>/2" class="dropdown-item text-center">Tolak</a>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                    <table class="table table-sm rounded">
                        <?php
                        $total = 0;
                        foreach ($data['done'] as $dd) {
                        ?>
                            <tr class="<?= ($dd['tr_status'] == 1) ? "table-success" : "table-danger"; ?>">
                                <td><?= $dd['metode'] ?><br><small><?= $dd['note'] ?></small></td>
                                <td class="text-end"><?= substr($dd['insertTime'], 0, -3) ?><br><b><?= number_format($dd['jumlah']) ?></b></td>
                                <td class="text-end">
                                    <?php
                                    $nt_st = ($dd['tr_status'] == 1) ? "Success" : "Ditolak";
                                    ?>
                                    <?= $nt_st ?>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>