<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <?php
                if (count($data) == 0) {
                    echo "Sudah Update!";
                } else {
                    foreach ($data as $a) {
                        echo "<div class='t" . $a['id'] . " border mb-2 p-1'>";
                        echo "<small>Barang</small><br>";
                        echo "<b>" . strtoupper($a['desc']) . "</b><br>";
                        echo "<small>Jumlah</small><br>";
                        echo "<span class='text-danger'><b>" . strtoupper($a['jumlah']) . "</span></b><br>";
                ?>
                        <hr class="p-0 m-0">
                        <div class="mt-2">
                            <a class="terima" data-id="<?= $a['id'] ?>" href="<?= $this->BASE_URL ?>TerimaStok/terima/2/<?= $a['id'] ?>"><button class="rounded border-light">Batal</button></a>
                            <span> ---- </span>
                            <input type="text" style="text-align: center;font-weight:bold;text-transform:uppercase;width:60px" placeholder="RAK" name="rak<?= $a['id'] ?>">
                            <a class="terima" data-id="<?= $a['id'] ?>" href="<?= $this->BASE_URL ?>TerimaStok/terima/1/<?= $a['id'] ?>"><button class="float-right rounded border-light"><b>Terima</b></button></a>
                        </div>
                <?php
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
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
                if (res == 1) {
                    $("div.t" + id).html('<b class="text-success">SUKSES TERIMA</b>')
                } else if (res == 2) {
                    $("div.t" + id).html('<b class="text-warning">DIBATALKAN!</b>')
                } else {
                    $("div.t" + id).html('<b class="text-danger">' + res + '</b>')
                }
                $("div.t" + id).fadeIn(1000);
                $("input#kode_barang").focus();
            },
        });
    });
</script>