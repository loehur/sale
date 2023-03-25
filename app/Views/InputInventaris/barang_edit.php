<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <div id="info"></div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <form class="barang" action="<?= $this->BASE_URL ?>Input/update_barang/<?= $data['id'] ?>" method="post">
                    <div class="row mb-2">
                        <div class="col-auto">
                            <input type="text" class="form-control form-control-sm" name="kode_barang" value="<?= $data['kode_barang'] ?>" style="text-transform:uppercase;font-weight:bold;" required>
                        </div>
                        <div class="col-auto mb-2">
                            <input type="text" class="form-control form-control-sm" name="merk" value="<?= $data['merk'] ?>" style="text-transform:uppercase;" placeholder="Merk" required>
                        </div>
                        <div class="col-auto mb-2">
                            <input type="text" class="form-control form-control-sm" name="model" value="<?= $data['model'] ?>" style="text-transform:uppercase;" placeholder="Model" required>
                        </div>
                        <div class="col-auto mb-2">
                            <input type="text" class="form-control form-control-sm" name="deskripsi" value="<?= $data['deskripsi'] ?>" style="text-transform:uppercase;" placeholder="Deskripsi">
                        </div>
                        <div class="col-auto mb-2">
                            <input type="number" class="form-control form-control-sm" name="harga" value="<?= $data['harga'] ?>" placeholder="Harga" required>
                        </div>
                        <div class="col-auto mb-2">
                            <input type="number" class="form-control form-control-sm" name="margin" value="<?= $data['margin'] ?>" placeholder="Margin (%)" required>
                        </div>
                        <div class="col-auto mb-2">
                            <input type="number" class="form-control form-control-sm" name="margin_rp" placeholder="Margin (Rp)" readonly required>
                        </div>
                        <div class="col-auto mb-2">
                            <input type="text" class="form-control form-control-sm" name="harga_jual" placeholder="Harga Jual (Rp)" readonly required>
                        </div>
                        <div class="col-auto mb-2">
                            <input type="number" class="form-control form-control-sm" name="umur" placeholder="Umur (Tahun)" value="<?= $data['umur'] ?>" required>
                        </div>
                        <div class="col-auto mb-2">
                            <select class="form-control form-control-sm" name="satuan" required>
                                <?php
                                foreach ($this->listSatuan as $a) { ?>
                                    <option value="<?= $a['id'] ?>" <?= ($data['satuan'] == $a['id']) ? "selected" : "" ?>><?= $a['satuan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">
                                Update Barang
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    $("input[name=margin]").on("change, keyup", function() {
        margin_rp();
    })
    $("input[name=harga]").on("change, keyup", function() {
        margin_rp();
    })

    function margin_rp() {
        var harga = $("input[name=harga]").val()
        var margin = $("input[name=margin").val()

        if (margin == "" || harga == "") {
            $("input[name=margin_rp]").val("");
            $("input[name=harga_jual]").val("");
        }

        var margin_rp = (parseInt(harga) * parseInt(margin)) / 100;
        var jual = parseFloat(harga) + parseFloat(margin_rp);
        if (harga != "" && margin != "") {
            $("input[name=margin_rp]").val(margin_rp);
            $("input[name=harga_jual]").val(jual);
        }
        return;
    }

    $(document).ready(function() {
        $("#info").hide();
        margin_rp();

        $("form.barang").on("submit", function(e) {
            e.preventDefault();
            var kode_barang = $("input[name=kode_barang]").val();
            $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                type: $(this).attr("method"),
                success: function(res) {
                    if (res == 1) {
                        $('button#cekBarang').click();
                    } else {
                        $("#info").hide();
                        $("#info").fadeIn(1000);
                        $("#info").html('<div class="alert alert-danger" role="alert">' + res + '</div>')
                        $("#spinner").hide();
                    }
                },
            });
        });
    });
</script>