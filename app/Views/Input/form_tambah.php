<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <div class="alert alert-success">
                    <?php
                    echo "<b>" . strtoupper($data['merk']) . "<br> <span class='text-danger'>" . strtoupper($data['model']) . "<br>" . strtoupper($data['deskripsi']) . "</span></b>";
                    echo "<br><b>Harga -> Rp" . number_format($data['harga']) . "</b>";
                    echo "<br><b>Margin -> Rp" . number_format($data['harga'] * $data['margin'] / 100) . "</b>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
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
<div class="content" id="form_tambah">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <form class="tambah" action="<?= $this->BASE_URL ?>Input/tambah_stok/<?= $data['id'] ?>" method="post">
                    <div class="row mb-2">
                        <div class="col">
                            <input type="number" class="form-control form-control-sm" name="tambah" placeholder="Stok +" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-success btn-block">
                                Tambah Stok
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
    $(document).ready(function() {
        $("#info").hide();

        $("input[name=tambah]").focus();

        $("form.tambah").on("submit", function(e) {
            e.preventDefault();
            var kode_barang = $("input[name=kode_barang]").val();
            $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                type: $(this).attr("method"),
                success: function(res) {
                    $("#info").hide();
                    $("div#form_tambah").hide();
                    $("#info").fadeIn(1000);
                    $("#info").html('<div class="alert alert-success" role="alert">' + res + '</div>')
                    $("input[name=tambah]").focus();

                    $("input#kode_barang").val("");
                    $("input#kode_barang").focus();
                },
            });
        });
    });
</script>