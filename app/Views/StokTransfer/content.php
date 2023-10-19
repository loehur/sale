<div class="content border pt-2 pb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto pr-0 pb-1">
                Kode Barang
                <input id="kode_barang" type="text" class="selectize-input" style="text-transform:uppercase;max-width: 220px;" maxlength="30">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col mt-auto" style="width:100%; max-width:380px">
                Nama Barang
                <select class="tize form-control form-control-sm p-0 m-0" required>
                    <option value="">---</option>
                    <?php foreach ($data as $a) { ?>
                        <option value="<?= $a['kode_barang'] ?>"><?= strtoupper($a['merk'] . " " . $a['model'] . " " . $a['deskripsi']) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</div>
<div id="load"></div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/selectize.min.js"></script>

<script>
    $('input#kode_barang').keypress(function(event) {
        if (event.keyCode == 13 && ($(this).val()).length > 0) {
            $("div#load").load("<?= $this->BASE_URL ?>StokTransfer/cek/" + $(this).val());
        }
    });

    $('input#kode_barang').on("change", function(event) {
        $("div#load").load("<?= $this->BASE_URL ?>StokTransfer/cek/" + $(this).val());
    });

    $(document).ready(function() {
        $("#info").hide();
        $('select.tize').selectize();
        $('input#kode_barang').focus();
    });

    $('select.tize').selectize({
        onChange: function(value) {
            $('input#kode_barang').val(value);
            var kode_barang = $('input#kode_barang').val();
            $("div#load").load("<?= $this->BASE_URL ?>StokTransfer/cek/" + kode_barang);
        }
    });
</script>