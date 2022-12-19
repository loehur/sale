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

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $("#info").hide();
        $('input[name=tambah]').focus();
    });

    $("form.tambah").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(res) {
                location.reload(true);
            },
        });
    });

    $('select#tujuan_toko').on("change", function(event) {
        var val = $(this).val();
        $.ajax({
            url: "<?= $this->BASE_URL ?>Input/updateLogTujuanToko/",
            data: {
                toko: val
            },
            type: "POST",
            success: function() {

            },
        });
    });
</script>