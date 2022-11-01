<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto pr-0">
                <label><b>Kode Barang</b></label>
                <input id="kode_barang" type="text" class="form-control form-control-sm" style="text-transform:uppercase;" maxlength="30" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="col position-relative mt-auto">
                <button class="rounded border-light"><b>Cari Kode</b></button>
            </div>
        </div>
    </div>
</div>
<hr>
<div id="load"></div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    $('input#kode_barang').keypress(function(event) {
        if (event.keyCode == 13 && ($(this).val()).length > 0) {
            $("div#load").load("<?= $this->BASE_URL ?>Transaksi/cek/" + $(this).val());
        }
    });

    $(document).ready(function() {
        $("#info").hide();
        $('input#kode_barang').focus();
    });
</script>