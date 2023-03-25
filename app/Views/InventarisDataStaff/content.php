<div class="content" style="padding-bottom: 70px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <input type="text" id="myInput" class="form-control form-control-sm mb-2" onkeyup="myFunction()" placeholder="Cari Inventaris ... " title="Ketikan Nama Stok ... ">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm p-0 m-0" id="myTable">
                    <tr class="table-borderless">
                        <th colspan="2" class="p-0 m-0"><label class="text-success"><b>Data Inventaris</b></label></th>
                    </tr>
                    <?php
                    foreach ($data as $d) {
                    ?>
                        <tr>
                            <td><?= $d['id'] ?>#D<?= number_format($d['umur']) ?> <?= strtoupper($d['merk'] . " " . $d['model'] . " " . $d['deskripsi']) ?></td>
                            <td align="right"><?= $d['insertTime'] ?></td>
                        </tr>
                    <?php } ?>
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