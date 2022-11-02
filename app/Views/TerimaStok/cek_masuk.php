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
<div class="content" id="terima">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <div class="alert alert-success">
                    <?php
                    if (count($data) == 0) {
                        echo "Sudah Update!";
                    } else {
                        foreach ($data as $a) {
                            echo "<small>Barang</small><br>";
                            echo "<b>" . strtoupper($a['desc']) . "</b><br>";
                            echo "<small>Jumlah</small><br>";
                            echo "<span class='text-danger'><b>" . strtoupper($a['jumlah']) . "</span></b><br>";
                    ?>
                            <hr>
                            <div class="mt-2">
                                <a class="terima" href="<?= $this->BASE_URL ?>TerimaStok/terima/2/<?= $a['id'] ?>"><button class="rounded border-light">Batal</button></a>
                                <span> ---- </span>
                                <input type="text" style="text-align: center;font-weight:bold;text-transform:uppercase;width:60px" placeholder="RAK" name="rak">
                                <a class="terima" href="<?= $this->BASE_URL ?>TerimaStok/terima/1/<?= $a['id'] ?>"><button class="float-right rounded border-light"><b>Terima</b></button></a>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
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
        var rak_ = $("input[name=rak").val();
        $.ajax({
            url: href,
            data: {
                rak: rak_
            },
            type: "POST",
            success: function(res) {
                $("div#terima").hide();

                $("#info").hide();
                $("#info").fadeIn(1000);
                $("input#kode_barang").val("");
                if (res == 1) {
                    $("#info").html('<div class="alert alert-success" role="alert">SUKSES TERIMA!</div>')
                } else if (res == 2) {
                    $("#info").html('<div class="alert alert-warning" role="alert">DIBATALKAN!</div>')
                } else {
                    $("#info").html('<div class="alert alert-danger" role="alert">' + res + '</div>')
                }
                $("input#kode_barang").focus();
            },
        });
    });
</script>