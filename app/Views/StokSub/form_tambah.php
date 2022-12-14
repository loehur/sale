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
                                <td align="right"><small>Modal</small><br><?= number_format($data['harga']) ?></td>
                                <td align="right"><small>Harga</small><br><?= number_format($data['harga'] + ($data['harga'] * ($data['margin']) / 100)) ?></td>
                            </tr>
                        </table>
                    </b>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <table class="table table-sm">
                    <tr>
                        <th>Nama Sub</th>
                        <th class="text-right">Jumlah</th>
                        <th class="text-right">Modal</th>
                        <th class="text-right">Margin</th>
                        <th class="text-right">Harga</th>
                    </tr>
                    <?php foreach ($data['list_sub'] as $a) { ?>
                        <tr>
                            <td><?= strtoupper($a['nama_sub']) ?></td>
                            <td class="text-right"><?= number_format($a['jumlah'], 2) ?></td>
                            <td class="text-right"><?= number_format(($data['harga'] * $a['jumlah'])) ?></td>
                            <td class="text-right"><?= number_format($a['margin']) ?>%</td>
                            <td class="text-right"><?= number_format(($data['harga'] * $a['jumlah']) * ($a['margin'] / 100) + ($data['harga'] * $a['jumlah'])) ?></td>
                            <td align="center"><button class="btn btn-sm p-0 border-0" data-id_sub="<?= $a['id'] ?>" data-kode_barang="<?= $data['kode_barang'] ?>" id="barang_edit"><i class="fas fa-edit"></i></button></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="content" id="form_tambah">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <form class="tambah" action="<?= $this->BASE_URL ?>StokSub/tambah_sub/<?= $data['id'] ?>" method="post">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            Nama Sub
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" style="text-transform:uppercase;" name="nama" placeholder="Nama Sub" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            Jumlah
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control form-control-sm text-right" name="jumlah" step="0.01" placeholder="Jumlah" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            Modal Rp
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm text-right" name="harga" value="<?= $data['harga'] ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            Margin %
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm text-right" name="margin" min="1" placeholder="Margin %">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            Margin Rp
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm text-right" name="margin_rp" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            Harga Jual </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm text-right" name="harga_jual" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-success btn-block">
                                Tambah Sub
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="content" style="padding-bottom: 70px;">
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
                    $('button#cekBarang').click();
                },
            });
        });

        $('button#barang_edit').click(function() {
            var kode = $(this).attr("data-kode_barang");
            var sub = $(this).attr("data-id_sub");
            $("div#load").load("<?= $this->BASE_URL ?>StokSub/sub_edit/" + kode + "/" + sub);
        });

        $("input[name=margin]").on("change, keyup", function() {
            margin_rp();
            harga_jual();
        })
        $("input[name=jumlah]").on("change, keyup", function() {
            margin_rp();

            var harga = "<?= $data['harga'] ?>"
            var jumlah = $("input[name=jumlah").val()

            var total = harga * jumlah;
            $("input[name=harga]").val(total);

        })

        function margin_rp() {
            var harga = "<?= $data['harga'] ?>"
            var margin = $("input[name=margin").val()
            var jumlah = $("input[name=jumlah").val()

            var total = parseFloat(harga) * parseFloat(jumlah);

            var margin_rp = (parseFloat(total) * parseFloat(margin)) / 100;
            if (harga != "" && margin != "" && jumlah != "") {
                $("input[name=margin_rp]").val(margin_rp);
            }
        }

        function harga_jual() {
            var harga = $("input[name=harga").val()
            var margin = $("input[name=margin_rp").val()

            var jual = parseFloat(harga) + parseFloat(margin);
            $("input[name=harga_jual]").val(jual);
        }
    });
</script>