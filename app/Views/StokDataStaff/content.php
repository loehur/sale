<div id="load">
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

                            foreach ($data['main'] as $d) {
                                $stok = $d['stok'];

                                if ($stok >= 1 && $stok_0 == true) { ?>
                                    <tr class="table-borderless">
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

                                $proses_pakai = 0;
                                foreach ($data['pakai'] as $dp) {
                                    if ($dp['id_barang'] == $d['id_barang']) {
                                        $proses_pakai += $dp['jumlah'];
                                    }
                                }

                                ?>

                                <tr>
                                    <td style="vertical-align: middle;"><?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?>
                                    </td>
                                    <td style="vertical-align: middle;" align="right">
                                        <b><?= $stok ?></b> <?= ($proses_pakai > 0) ? "/<span class='text-danger'>" . $proses_pakai . "</span>" : "" ?>
                                    </td>
                                    <td>
                                        <?php if ($d['stok'] > 0) { ?>
                                            <button class="border-light rounded pakai" data-id="<?= $d['id_barang'] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">Pakai</button>
                                        <?php } ?>
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


    <!-- Modal -->

</div>

<div class="modal
" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Jumlah Pakai</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control form-control-sm text-center" value="1" step="0.01" min="0.01" id="jumlah_pakai" type="number" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="sub_pakai" data-bs-dismiss="modal" class="btn btn-sm btn-primary">Pakai</button>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
    var id_barang = "";

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

    $("button#sub_pakai").click(function() {
        var jumlah = $("input#jumlah_pakai").val();
        $.ajax({
            type: "POST",
            url: "<?= $this->BASE_URL ?>StokDataStaff/pakai/" + id_barang + "/" + jumlah,
            data: {},
            success: function() {
                $("div#load").load("<?= $this->BASE_URL ?>StokDataStaff/load");
            }
        });
    });

    $("button.pakai").click(function() {
        id_barang = $(this).attr("data-id");
        $("input#jumlah_pakai").val(1);
    });
</script>

</div>