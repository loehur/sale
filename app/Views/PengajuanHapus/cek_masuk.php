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
<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    $('a.hapus').on("click", function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        $.ajax({
            url: href,
            data: {},
            type: "POST",
            success: function(res) {
                $('button#cekBarang').click();
            },
        });
    });
</script>