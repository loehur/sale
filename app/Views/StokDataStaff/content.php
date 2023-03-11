<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <input type="text" id="myInput" class="form-control form-control-sm mb-3" onkeyup="myFunction()" placeholder="Cari Stok ... " title="Ketikan Nama Stok ... ">
            </div>
        </div>

        <label class="text-danger ml-1"><b>Data Stok Barang Kosong</b></label>
        <div class="row">
            <div class="col-md-12">
                <div>
                    <table class="table table-sm p-0 m-0" id="myTable">
                        <?php
                        $stok_0 = true;

                        foreach ($data as $d) {
                            $stok = $d['stok'];

                            if ($stok >= 1 && $stok_0 == true) { ?>
                                <tr>
                                    <th colspan="2"><br><label class="text-success"><b>Data Stok Barang (Ready)</b></label></th>
                                </tr>
                            <?php
                                $stok_0 = false;
                            }
                            ?>
                            <?php

                            if ($d['stok'] > $this->max_stok) {
                                continue;
                            }

                            if ($d['en'] == 0) {
                                continue;
                            }

                            ?>

                            <tr>
                                <td><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                                </td>
                                <td align="right">
                                    <b><?= $stok ?></b>
                                </td>
                            </tr>
                        <?php
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
</script>