<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <label><b>Kode Barang</b></label>
                <input id="kode_barang" type="text" class="form-control form-control-sm" style="text-transform:uppercase;" maxlength="30" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
            <div class="row px-2">
                <?php
                foreach ($data as $a) {
                    echo "<div class='col-md-6 px-1 back-show s" . $a['kode_barang'] . "'> <div class='t" . $a['id'] . " shadow-sm border mb-2 p-2 rounded'>";
                    echo "<span><b>" . strtoupper($a['merk'] . " " . $a['model'] . " " . $a['deskripsi']) . "</b></span>";
                    echo "<span class='float-right text-info'>" . $a['kode_barang'] . "</span><br>";
                    $sat = "PCS";
                    foreach ($this->listSatuan as $ls) {
                        if ($ls['id'] == $a['satuan']) {
                            $sat = $ls['satuan'];
                        }
                    }

                    $sumber = "";

                    if ($a['id_sumber'] == "") {
                        $sumber = "SUPPLIER";
                    } else {
                        foreach ($this->stafData as $sd) {
                            if ($sd['id_user'] == $a['id_sumber']) {
                                $sumber = $sd['nama'];
                            }
                        }
                    }


                ?>
                    <div class="d-flex flex-row pt-0 mt-2">
                        <div class="pr-2"><span class='text-success'>Tanggal/Jam</span><br><?= $a['insertTime'] ?></div>
                        <div class="pr-2"><span class='text-success'>Sumber</span><br><b><?= strtoupper($sumber) ?></b></div>
                        <div class="text-right"><span class='text-success'>Jumlah</span><br><b><?= strtoupper($a['jumlah']) . " " . $sat ?></b></div>
                    </div>
                    <hr class="p-0 m-0">
                    <div class="mt-2 text-right">
                        <input type="text" class="d-none" style="text-align: center;font-weight:bold;text-transform:uppercase;width:60px" placeholder="RAK" name="rak<?= $a['id'] ?>">
                        <a class="terima" data-id="<?= $a['id'] ?>" href="<?= $this->BASE_URL ?>TerimaStok/terima/1/<?= $a['id'] ?>/<?= $a['id_sumber'] ?>"><button class="rounded border-light"><b>Terima</b></button></a>
                        <?php if ($this->userData['user_tipe'] == 100) { ?>
                            <a class="terima" data-id="<?= $a['id'] ?>" href="<?= $this->BASE_URL ?>TerimaStok/terima_pakai/1/<?= $a['id'] ?>/<?= $a['id_sumber'] ?>/<?= $a['jumlah'] ?>"><button class="rounded border-light"><b>Terima Pakai</b></button></a>
                        <?php } ?>
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
            var kode_barang = $(this).val();
            $(".back-show").addClass('d-none');
            $(".s" + kode_barang).removeClass('d-none');
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
            $(".back-show").addClass('d-none');
            $(".s" + kode_barang).removeClass('d-none');
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