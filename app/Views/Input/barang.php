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
                <form class="barang" action="<?= $this->BASE_URL ?>Input/simpan_barang_baru" method="post">
                    <div class="row mb-2">
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" name="kode_barang" value="<?= $data ?>" style="text-transform:uppercase;font-weight:bold;" readonly required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" name="merk" style="text-transform:uppercase;" placeholder="Merk" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" name="model" style="text-transform:uppercase;" placeholder="Model" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" name="deskripsi" style="text-transform:uppercase;" placeholder="Deskripsi">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <input type="number" class="form-control form-control-sm" name="harga" placeholder="Harga" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <input type="number" class="form-control form-control-sm" name="margin" placeholder="Margin (%)" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <input type="number" class="form-control form-control-sm" name="margin_rp" placeholder="Margin (Rp)" readonly required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">
                                Simpan Barang
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
        var margin_rp = (parseInt(harga) * parseInt(margin)) / 100;
        if (harga != "" && margin != "") {
            $("input[name=margin_rp]").val(margin_rp);
        }
        return;
    }

    $(document).ready(function() {
        $("#info").hide();

        $("form.barang").on("submit", function(e) {
            e.preventDefault();
            var kode_barang = $("input[name=kode_barang]").val();
            $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                type: $(this).attr("method"),
                success: function(res) {
                    if (res == 1) {
                        $("div#load").load("<?= $this->BASE_URL ?>Input/form_tambah/" + kode_barang);
                    } else {
                        $("#info").hide();
                        $("#info").fadeIn(1000);
                        $("#info").html('<div class="alert alert-danger" role="alert">' + res + '</div>')
                    }
                },
            });
        });
    });
</script>