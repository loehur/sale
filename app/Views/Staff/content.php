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
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <form id="form" action="<?= $this->BASE_URL ?>Register/tambah_staff" method="post">
                    <div class="row mb-2">
                        <div class="col">
                            <label>Nama User</label>
                            <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label>ID User</label>
                            <input type="text" class="form-control form-control-sm" id="HP" name="HP" placeholder="ID User" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label>Fee</label>
                            <input type="number" class="form-control form-control-sm" name="fee" placeholder="% From Margin" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label>Tipe</label>
                            <select class="form-control form-control-sm" name="user_tipe" required>
                                <option value="10">Rekanan</option>
                                <option value="100">Toko Cabang</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">
                                Tambah User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<label class="ml-3">Default [Password: abcdef]</label>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 border pb-1">
                <table class="table table-borderless table-sm mb-0 pb-0">
                    <?php
                    $no = 0;
                    echo "<tbody>";
                    foreach ($data as $a) {
                        echo "<tr>";
                        echo "<td><span>" . $a['id_user'] . "</span><br><span>" . $a['nama'] . "</span></td>";
                        echo "<td>";
                        echo ($a['en'] == 1) ? "<span class='text-success'>Enabled</span>" : "Disabled";
                        echo "</td>";
                        echo "<td>";
                        echo ($a['user_tipe'] == 10) ? "<span class='text-success'>Rekanan</span>" : "Toko Cabang";
                        echo "</td>";
                        echo "<td><span>" . $a['fee'] . "</span></td>";
                        echo "<td><a class='text-success text-decoration-none' href='" . $this->BASE_URL . "Staff/updateCell_Staff/user_tipe/10/" . $a['id_user'] . "'>Rekanan</a><br>
                        <a class='text-danger text-decoration-none' href='" . $this->BASE_URL . "Staff/updateCell_Staff/user_tipe/100/" . $a['id_user'] . "'>Toko Cabang</a>
                        </td>";
                        echo "<td><a class='text-success text-decoration-none' href='" . $this->BASE_URL . "Staff/updateCell_Staff/en/1/" . $a['id_user'] . "'><i class='fas fa-check-circle'></i></a>
                        <a class='text-danger text-decoration-none' href='" . $this->BASE_URL . "Staff/updateCell_Staff/en/0/" . $a['id_user'] . "'><i class='fas fa-times-circle'></i></a>
                        </td>";
                        echo "</tr>";
                        echo "</tr>";
                        $no++;
                    }
                    echo "</tbody>";
                    ?>
                </table>
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
        $("#info").fadeOut();
        $("form").on("submit", function(e) {
            $("#spinner").show();
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                type: $(this).attr("method"),
                success: function(response) {
                    if (response == 1) {
                        location.reload(true);
                    } else if (response == 0) {
                        window.location.href = "<?= $this->BASE_URL ?>Login/logout";
                    } else {
                        $("#info").hide();
                        $("#info").fadeIn(1000);
                        $("#info").html('<div class="alert alert-danger" role="alert">' + response + '</div>');
                    }
                },
            });
        });
    });
</script>