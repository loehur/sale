<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <label><b>Kode Barang</b></label>
                <input id="kode_barang" type="text" class="form-control form-control-sm" style="text-transform:uppercase;" maxlength="30" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="col-auto">
                <h4 style="white-space: nowrap;" class="text-primary"><br>INVENTARIS MASUK</h3>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col mt-auto" style="width:100%; max-width:380px">
                <label><b>List Barang Masuk</b></label>
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
<div id="load" style="padding-bottom: 70px;">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <?php
                foreach ($data as $a) {
                    echo "<div class='col-md-6'> <div class='t" . $a['id'] . " border mb-2 p-1'>";
                    echo "<b>" . strtoupper($a['merk'] . " " . $a['model'] . " " . $a['deskripsi']) . "</b><br>";

                    $sumber = "";

                    if ($a['id_sumber'] == "") {
                        $sumber = "MANAJEMEN";
                    } else {
                        foreach ($this->stafData as $sd) {
                            if ($sd['id_user'] == $a['id_sumber']) {
                                $sumber = $sd['nama'];
                            }
                        }
                    }


                ?>
                    <div class="d-flex flex-row pt-0">
                        <div class="p-2"><span class='text-success'>Tanggal/Jam</span><br><?= $a['insertTime'] ?></div>
                        <div class="p-2"><span class='text-success'>Sumber</span><br><?= strtoupper($sumber) ?></div>
                        <div class="p-2 text-right"><span class='text-success'>Tujuan Posisi</span><br><?= strtoupper($a['posisi']) ?></div>
                    </div>
                    <div>
                        <a class="terima" data-id="<?= $a['id'] ?>" href="<?= $this->BASE_URL ?>TerimaInventaris/terima/1/<?= $a['id'] ?>"><button class="float-right rounded border-light"><b>Terima</b></button></a>
                    </div>
                <?php
                    echo "</div></div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/selectize.min.js"></script>

<script>
    $(document).ready(function() {
        $("#info").hide();
        $('input#kode_barang').focus();
        $('select.tize').selectize();
    });

    $('input#kode_barang').keypress(function(event) {
        if (event.keyCode == 13 && ($(this).val()).length > 0) {
            $("div#load").load("<?= $this->BASE_URL ?>TerimaStok/cek/" + $(this).val());
        }
    });

    $('select#toko').on("change", function(event) {
        var val = $(this).val();
        $.ajax({
            url: "<?= $this->BASE_URL ?>Input/updateLogToko/",
            data: {
                toko: val
            },
            type: "POST",
            success: function() {},
        });
    });

    $('select.tize').selectize({
        onChange: function(value) {
            $('input#kode_barang').val(value);
            var kode_barang = $('input#kode_barang').val();
            $("div#load").load("<?= $this->BASE_URL ?>TerimaStok/cek/" + kode_barang);
        }
    });
    $('a.terima').on("click", function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var id = $(this).attr("data-id");
        var rak_ = $("input[name=rak" + id).val();
        $.ajax({
            url: href,
            data: {
                rak: rak_
            },
            type: "POST",
            success: function(res) {
                $("div.t" + id).hide();
                $("input#kode_barang").val("");
                if (res == 1 || res == 2) {
                    location.reload(true);
                } else {
                    $("div.t" + id).html('<b class="text-danger">' + res + '</b>')
                }
                $("div.t" + id).fadeIn(1000);
                $("input#kode_barang").focus();
            },
        });
    });
</script>