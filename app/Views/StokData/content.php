<div id="load">
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
                    <input type="text" id="myInput" class="form-control form-control-sm mb-2" onkeyup="luhurTableSearch()" placeholder="Cari Stok ... " title="Ketikan Nama Stok ... ">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm p-0 m-0" id="myTable">

                        <tr class="table-borderless">
                            <th colspan="3" class="p-0 m-0"><label class="text-danger"><b>Data Stok Barang Kosong</b></label></th>
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
                                    <th colspan="3"><b><?= strtoupper($id_user) ?></b></th>
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

                                    $sat = "PCS";
                                    foreach ($this->listSatuan as $ls) {
                                        if ($ls['id'] == $d['satuan']) {
                                            $sat = $ls['satuan'];
                                        }
                                    }

                                    $harga = $d['harga'];
                                    $margin = $d['margin'];
                                    $harga_jual = $harga + ($harga * ($margin / 100));
                                ?>
                                    <tr>
                                        <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                                            <br>
                                            <small> <?= strtoupper($d['kode_barang']) ?> <?= "M-" . number_format($harga) ?> <?= "J-" . number_format($harga_jual) ?></small>
                                        </td>
                                        <td align="right" nowrap>
                                            <b><?= $d['stok'] ?></b> <small><?= $sat ?></small><br>
                                            <?= "T-" . number_format($d['laku'], 1); ?>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="dropdown dropstart">
                                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                                <ul class="dropdown-menu">
                                                    <li style="cursor: pointer;"><a class="dropdown-item" href="<?= $this->BASE_URL ?>Input/index/<?= $d['kode_barang'] ?>">Tambah</a></li>
                                                    <li style="cursor: pointer;"><a class="dropdown-item stop_stok" data-id="<?= $d['id_barang'] ?>" data-user="<?= $id_user ?>">Stop Stok</a></li>
                                                </ul>
                                            </div>
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
            <th colspan="3" class="p-0 m-0"><label class="text-success"><b>Data Stok Barang Tersedia</b></label></th>
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
                    <th colspan="3"><b><?= strtoupper($id_user) ?></b></th>
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
                    $sat = "PCS";
                    foreach ($this->listSatuan as $ls) {
                        if ($ls['id'] == $d['satuan']) {
                            $sat = $ls['satuan'];
                        }
                    }

                    $harga = $d['harga'];
                    $margin = $d['margin'];
                    $harga_jual = $harga + ($harga * ($margin / 100));
                ?>
                    <tr>
                        <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                            <br>
                            <small><?= strtoupper($d['kode_barang']) ?> <?= "M-" . number_format($harga) ?> <?= "J-" . number_format($harga_jual) ?></small>
                        </td>
                        <td align="right" nowrap>
                            <b><?= $d['stok'] ?></b> <small><?= $sat ?></small><br>
                            <?= "T-" . number_format($d['laku'], 1); ?>
                        </td>
                        <td style="vertical-align: middle;">
                            <div class="dropdown dropstart">
                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu">
                                    <li style="cursor: pointer;"><a class="dropdown-item" href="<?= $this->BASE_URL ?>Input/index/<?= $d['kode_barang'] ?>">Tambah</a></li>
                                    <li style="cursor: pointer;"><a class="dropdown-item stop_stok" data-id="<?= $d['id_barang'] ?>" data-user="<?= $id_user ?>">Stop Stok</a></li>
                                </ul>
                            </div>
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

    <!-- SCRIPT -->
    <script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {});

        function luhurTableSearch() {
            var input, filter, table, tr, td, i, txtValue, filterCount;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            filterCount = filter.length;

            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent.toUpperCase() || td.innerText.toUpperCase();
                    var match = false;
                    var cekFind = [];
                    var sortCek = 0;

                    for (let k = 0; k < filter.length; k++) {
                        cekFind[k] = 0;
                        for (let j = sortCek; j < txtValue.length; j++) {
                            if (filter.charAt(k) == txtValue.charAt(j)) {
                                cekFind[k] = 1;
                                sortCek = j;
                                break;
                            }
                        }

                        if (cekFind[k] == 0) {
                            match = false;
                            break;
                        } else {
                            const sumFind = cekFind.reduce((partialSum, a) => partialSum + a, 0);
                            if (sumFind == filterCount) {
                                match = true;
                                break;
                            }
                        }
                    }

                    if (filter.length == 0) {
                        tr[i].style.display = "";
                    } else {
                        if (match == true) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
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

        $("a.stop_stok").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= $this->BASE_URL ?>StokOperasi/stop_stok",
                type: 'POST',
                data: {
                    id: $(this).attr("data-id"),
                    user: $(this).attr("data-user")
                },
                success: function() {
                    $("div#load").load("<?= $this->BASE_URL ?>StokData/load");
                }
            });
        });
    </script>
</div>