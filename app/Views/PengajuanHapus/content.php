<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto pr-0">
                <label><b>Nomor Item</b></label>
                <input id="kode_barang" type="text" class="form-control form-control-sm" style="text-transform:uppercase;" maxlength="30" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="col-auto mt-auto pl-2">
                <button class="btn btn-sm btn-outline-primary" id="cekBarang">Cek Item</button>
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
                    echo "<div class='pl-2 pt-2'><b>" . strtoupper($a['deskripsi']) . "</b></div>";
                ?>
                    <div class="d-flex flex-row pt-0">
                        <div class="p-2"><span class='text-success'>Tanggal/Jam</span><br><?= $a['insertTime'] ?></div>
                        <div class="p-2 text-right"><span class='text-success'>Jumlah</span><br><b><?= strtoupper($a['jumlah']) ?></b></div>
                        <div class="p-2 text-right"><span class='text-success'>Harga</span><br><b><?= number_format($a['harga_jual']) ?></b></div>
                    </div>
                    <div class="mt-0">
                        <?php if ($a['bin'] == 0) { ?>
                            <a class="hapus" data-id="<?= $a['id'] ?>" href="<?= $this->BASE_URL ?>PengajuanHapus/hapusJual/<?= $a['id'] ?>"><button class="float-right rounded border-light"><b>Hapus</b></button></a>
                        <?php } else { ?>
                            <span class="float-right rounded border bg-white text-primary pr-1 pl-1"><b>Dalam Proses Hapus</b></span>
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
            $("div#load").load("<?= $this->BASE_URL ?>PengajuanHapus/cek/" + $(this).val());
        }
    });

    $('button#cekBarang').click(function() {
        $("div#load").load("<?= $this->BASE_URL ?>PengajuanHapus/cek/" + $("input#kode_barang").val());
    });


    $('select.tize').selectize({
        onChange: function(value) {
            $('input#kode_barang').val(value);
            var kode_barang = $('input#kode_barang').val();
            $("div#load").load("<?= $this->BASE_URL ?>PengajuanHapus/cek/" + kode_barang);
        }
    });
</script>