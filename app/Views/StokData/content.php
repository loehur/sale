<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mb-2">
                <select id="toko" class="form-control form-control-sm" name="user_tipe" required>
                    <?php
                    foreach ($this->stafData as $a) { ?>
                        <option value="<?= $a['id_user'] ?>" <?= ($this->setting['toko'] == $a['id_user'] ? "selected" : "") ?>><?= strtoupper($a['nama']) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6">
                <input type="text" id="myInput" class="form-control form-control-sm mb-2" onkeyup="myFunction()" placeholder="Cari Stok ... " title="Ketikan Nama Stok ... ">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm p-0 m-0" id="myTable">

                    <tr class="table-borderless">
                        <th colspan="2" class="p-0 m-0"><label class="text-danger"><b>Data Stok Barang Kosong</b></label></th>
                    </tr>

                    <?php
                    $id_user = "";
                    $counter = 0;
                    $run = false;
                    if (!isset($data[0])) {
                        $data[0] = [];
                    }

                    foreach ($data[0] as $colom => $col) {
                        foreach ($col as $id_user => $val) {
                            if (count($val) == 0) {
                                continue;
                            } ?>
                            <tr class="table-danger">
                                <th colspan="2"><b><?= strtoupper($id_user) ?></b></th>
                            </tr>
                            <?php foreach ($val as $d) {
                                if (isset($d['en'])) {
                                    if ($d['en'] == 0) {
                                        continue;
                                    }
                                }
                                if ($d['stok'] > $this->max_stok) {
                                    continue;
                                }
                            ?>
                                <tr>
                                    <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                                        <br>
                                        <?= "<a href='" . $this->BASE_URL . "StokOperasi/index/" . $d['kode_barang'] . "/" . $id_user . "'>" . strtoupper($d['kode_barang']) . "</a> Rp" . number_format($d['harga']) ?>
                                    </td>
                                    <td align="right" nowrap>
                                        <b><?= $d['stok'] ?></b><br>
                                        <?= "T-" . number_format($d['laku'], 1); ?>
                                    </td>
                                </tr>
                            <?php } ?>

            </div>
    <?php }
                    }
    ?>
    <tr class="table-borderless">
        <th></th>
    </tr>
    <tr class="table-borderless">
        <th colspan="2" class="p-0 m-0"><label class="text-success"><b>Data Stok Barang Tersedia</b></label></th>
    </tr>

    <?php
    $id_user = "";
    $counter = 0;
    $run = false;

    if (!isset($data[1])) {
        $data[1] = [];
    }
    foreach ($data[1] as $colom => $col) {
        echo '<div class="col-md-6">';
        foreach ($col as $id_user => $val) {
            if (count($val) == 0) {
                continue;
            }
    ?>
            <tr class="table-success">
                <th colspan="2"><b><?= strtoupper($id_user) ?></b></th>
            </tr>
            <?php foreach ($val as $d) {
                if (isset($d['en'])) {
                    if ($d['en'] == 0) {
                        continue;
                    }
                }

                if ($d['stok'] > $this->max_stok) {
                    continue;
                }
            ?>
                <tr>
                    <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                        <br>
                        <?= "<a href='" . $this->BASE_URL . "StokOperasi/index/" . $d['kode_barang'] . "/" . $id_user . "'>" . strtoupper($d['kode_barang']) . "</a> Rp" . number_format($d['harga']) ?>
                    </td>
                    <td align="right" nowrap>
                        <b><?= $d['stok'] ?></b><br>
                        <?= "T-" . number_format($d['laku'], 1); ?>
                    </td>
                </tr>
            <?php } ?>
    <?php }
    }
    ?>
    </table>
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
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    $('select#toko').on("change", function(event) {
        var val = $(this).val();
        $.ajax({
            url: "<?= $this->BASE_URL ?>Input/updateLogToko/",
            data: {
                toko: val
            },
            type: "POST",
            success: function() {
                location.reload(true);
            },
        });
    });
</script>