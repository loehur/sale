<?php
$a = $data;

?>
<div class="content pt-2 pb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto mb-2">
                <b>
                    <?= strtoupper($a['nama_barang']) ?> => <span class="text-danger"><?= strtoupper($a['pengganti']) ?></span>
                </b>
            </div>
        </div>
    </div>
</div>