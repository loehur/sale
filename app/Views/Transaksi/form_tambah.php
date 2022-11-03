<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <div class="alert alert-success">
                    <b>
                        <table>
                            <tr>
                                <td><?= strtoupper($data['merk']) ?><br><span class="text-danger"><?= strtoupper($data['model']) . " " . strtoupper($data['deskripsi']) ?></span></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">Rp<?= number_format($data['harga'] + ($data['harga'] * ($data['margin'] / 100))) ?></td>
                            </tr>
                        </table>
                    </b>
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
                Sisa Stok: <b><span class="text-danger"><?= $data['stok'] ?></span></b>
            </div>
        </div>
    </div>
</div>
<hr>
<?php
if (isset($data['merk']) && $data['stok'] > 0) { ?>
    <div class="content" id="form_tambah">
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto mr-auto">
                    <form class="tambah" action="<?= $this->BASE_URL ?>Transaksi/cart/<?= $data['id'] ?>" method="post">
                        <div class="row mb-2">
                            <div class="col">
                                <input type="number" value="1" class="form-control form-control-sm" name="tambah" max="<?= $data['stok'] ?>" placeholder="" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-success btn-block">
                                    Tambahkan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $("#info").hide();
        $('input[name=tambah]').focus();
    });

    $("form.tambah").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(res) {
                location.reload(true);
            },
        });
    });
</script>