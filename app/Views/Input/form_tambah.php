<?php $stok = $data['stok'];
foreach ($this->listSatuan as $ls) {
    if ($ls['id'] == $data['satuan']) {
        $sat = $ls['satuan'];
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <div class="alert border-success rounded">
                    <b>
                        <table>
                            <tr>
                                <td colspan="4"><?= "<b>" . strtoupper($data['merk'] . " " . $data['model'] . " " . $data['deskripsi']) . "</b>" . " <span class='text-primary'>(" . $sat  . ")</span>" ?></td>
                            </tr>
                            <tr>
                                <td align="right"><small>Harga</small><br><?= number_format($data['harga']) ?></td>
                                <td align="right" class="pl-1"><small>Margin</small><br><?= number_format($data['harga'] * $data['margin'] / 100) ?></td>
                                <td align="right" class="pl-1"><small>Jual</small><br><?= number_format($data['harga'] + ($data['harga'] * $data['margin'] / 100)) ?></td>
                                <td align="right" class="pl-1"><small>Stok</small><br><?= number_format($stok['sisa'], 2) . " " . $sat ?> <span class="text-danger">(+<?= $stok['antri'] . " " . $sat  ?>)</span></td>
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
                        <div class="col pr-0">
                            <input type="number" class="form-control form-control-sm" name="tambah" step="0.01" placeholder="Stok +" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" name="rak" placeholder="Rak (Optional)">
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
                    $("div#load2").load("<?= $this->BASE_URL ?>Input/list_input");
                    $('button#cekBarang').click();
                    $("input#kode_barang").val("");

                    setTimeout(kodeBarangFocus, 1000);

                },
            });
        });

        function kodeBarangFocus() {
            $("input#kode_barang").focus();
        }

        $('button#barang_edit').click(function() {
            var kode = $(this).attr("data-kode_barang");
            $("div#load").load("<?= $this->BASE_URL ?>Input/barang_edit/" + kode);
        });
    });
</script>