<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <div class="row">
                    <div class="col-auto">
                        <label><b>Pilih Toko</b></label>
                        <select id="toko" class="form-control form-control-sm" name="user_tipe" required>
                            <?php
                            foreach ($this->stafData as $a) { ?>
                                <option value="<?= $a['id_user'] ?>" <?= ($this->setting['toko'] == $a['id_user'] ? "selected" : "") ?>><?= strtoupper($a['nama']) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <h4 style="white-space: nowrap;" class="text-primary"><br>INVENTARIS</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto pr-0 mr-0">
                <label><b>Kode Barang</b></label>
                <input id="kode_barang" type="text" class="form-control form-control-sm" style="text-transform:uppercase;" maxlength="30" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="col-auto mt-auto pl-2">
                <button class="btn btn-sm btn-outline-primary" id="cekBarang">Cek Kode Barang</button>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col mt-auto" style="width:100%; max-width:380px">
                <label><b>Nama Barang</b></label>
                <select class="tize form-control form-control-sm p-0 m-0" required>
                    <option value="" selected disabled>...</option>
                    <?php foreach ($data as $a) { ?>
                        <option value="<?= $a['kode_barang'] ?>"><?= strtoupper($a['merk'] . " " . $a['model'] . " " . $a['deskripsi']) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</div>
<hr>
<div id="load"></div>
<div id="load2" style="padding-bottom: 70px;"></div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/selectize.min.js"></script>

<script>
    $(document).ready(function() {
        $("#info").hide();
        $('select.tize').selectize();
        $('input#kode_barang').focus();
        $("div#load2").load("<?= $this->BASE_URL . $this->ACTIVE_CONTROLLER ?>/list_input");
    });

    $('input#kode_barang').keypress(function(event) {
        if (event.keyCode == 13 && ($(this).val()).length > 0) {
            $("div#load").load("<?= $this->BASE_URL . $this->ACTIVE_CONTROLLER ?>/cek/" + $(this).val());
        }
    });

    $('button#cekBarang').click(function() {
        $("div#load").load("<?= $this->BASE_URL . $this->ACTIVE_CONTROLLER ?>/cek/" + $('input#kode_barang').val());
    });

    $('select.tize').selectize({
        onChange: function(value) {
            $('input#kode_barang').val(value);
            var kode_barang = $('input#kode_barang').val();
            $("div#load").load("<?= $this->BASE_URL . $this->ACTIVE_CONTROLLER ?>/cek/" + kode_barang);
        }
    });

    $('select#toko').on("change", function(event) {
        var val = $(this).val();
        $.ajax({
            url: "<?= $this->BASE_URL . $this->ACTIVE_CONTROLLER ?>/updateLogToko/",
            data: {
                toko: val
            },
            type: "POST",
            success: function() {
                location.reload(true);
            },
        });
    });
</script>