<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <div class="row mb-2">
                    <div class="col">
                        <label><b>Pilih Toko</b></label>
                        <select id="toko" class="form-control form-control-sm" name="user_tipe" required>
                            <?php
                            foreach ($this->stafData as $a) { ?>
                                <option value="<?= $a['id_user'] ?>" <?= ($this->setting['toko'] == $a['id_user'] ? "selected" : "") ?>><?= strtoupper($a['nama']) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content border pt-2 pb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto pr-0 pb-1">
                <label><b>Kode Barang</b></label>
                <input id="kode_barang" type="text" class="selectize-input" style="text-transform:uppercase;max-width: 220px;" maxlength="30">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col mt-auto" style="width:100%; max-width:380px">
                <label><b>Nama Barang</b></label>
                <select class="tize load form-control form-control-sm p-0 m-0" required>
                    <option value="" selected disabled>...</option>
                    <?php foreach ($data as $a) { ?>
                        <option value="<?= $a['kode_barang'] ?>"><?= strtoupper($a['merk'] . " " . $a['model'] . " " . $a['deskripsi']) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="content border pt-2 pb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto pr-0 pb-1">
                <label><b>Kode Barang Pengganti</b></label>
                <input id="kode_barang2" type="text" class="selectize-input" style="text-transform:uppercase;max-width: 220px;" maxlength="30">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col mt-auto" style="width:100%; max-width:380px">
                <label><b>Nama Barang Pengganti</b></label>
                <select class="tize load2 form-control form-control-sm p-0 m-0" required>
                    <option value="" selected disabled>...</option>
                    <?php foreach ($data as $a) { ?>
                        <option value="<?= $a['kode_barang'] ?>"><?= strtoupper($a['merk'] . " " . $a['model'] . " " . $a['deskripsi']) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="content border pt-2 pb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto pr-0 pb-1">
                <span class="btn btn-sm btn-success" id="ganti">Ganti</span>
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
    var id_user;
    $(document).ready(function() {
        id_user = $('select#toko').val();
    });

    $('input#kode_barang').keypress(function(event) {
        if (event.keyCode == 13 && ($(this).val()).length > 0) {
            $("div#load").load("<?= $this->BASE_URL ?>StokPengganti/cek/" + $(this).val() + "/" + id_user);
        }
    });

    $('input#kode_barang').on("change", function(event) {
        $("div#load").load("<?= $this->BASE_URL ?>StokPengganti/cek/" + $(this).val() + "/" + id_user);
    });

    $(document).ready(function() {
        $("#info").hide();
        $('select.tize').selectize();
        $('input#kode_barang').focus();
    });

    $('select.load').selectize({
        onChange: function(value) {
            $('input#kode_barang').val(value);
            var kode_barang = $('input#kode_barang').val();
            $("div#load").load("<?= $this->BASE_URL ?>StokPengganti/cek/" + kode_barang + "/" + id_user);
        }
    });

    $('select.load2').selectize({
        onChange: function(value) {
            $('input#kode_barang2').val(value);
        }
    });

    $("span#ganti").click(function() {
        var barang = $('input#kode_barang').val();
        $.ajax({
            url: "<?= $this->BASE_URL ?>StokPengganti/ganti",
            data: {
                toko: $('select#toko').val(),
                kode_barang: barang,
                kode_barang_r: $('input#kode_barang2').val()
            },
            type: "POST",
            success: function(res) {
                if (res == 1) {
                    $("div#load").load("<?= $this->BASE_URL ?>StokPengganti/cek/" + barang + "/" + id_user);
                } else {
                    $("div#load").html(res);
                }
            },
        });
    })
    $('select#toko').on("change", function(event) {
        var val = $(this).val();
        id_user = $('select#toko').val();
        $.ajax({
            url: "<?= $this->BASE_URL ?>Input/updateLogToko/",
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