<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <div class="alert alert-success">
                    <b>
                        <table>
                            <tr>
                                <td colspan="2" class="text-danger"><?= strtoupper($data['merk']) ?> <?= strtoupper($data['model']) . " " . strtoupper($data['deskripsi']) ?></td>
                            </tr>
                            <tr>
                                <td align="right"><small>Harga</small><br><?= number_format($data['harga']) ?></td>
                                <td align="right"><small>Margin</small><br><?= number_format($data['harga'] * $data['margin'] / 100) ?></td>
                            </tr>
                        </table>
                    </b>
                    <div class="ml-auto p-1 float-right"><button data-kode_barang="<?= $data['kode_barang'] ?>" id="barang_edit" class="rounded border-light"><b>Edit</b></button></div>
                </div>
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
                            <input type="number" class="form-control form-control-sm" name="tambah" step="0.01" placeholder="Stok +" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" name="rak" placeholder="Rak (Master Only)">
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
                    $("div#load2").load("<?= $this->BASE_URL ?>Input/list_input");
                },
            });
        });

        $('button#barang_edit').click(function() {
            var kode = $(this).attr("data-kode_barang");
            $("div#load").load("<?= $this->BASE_URL ?>Input/barang_edit/" + kode);
        });
    });
</script>