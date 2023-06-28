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
                <form id="form" action="<?= $this->BASE_URL ?>Akun/updatePass" method="post">
                    <div class="row mb-2">
                        <div class="col">
                            <label>Password Lama</label>
                            <input type="password" class="form-control form-control-sm" name="pass" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label>Password Baru</label>
                            <input type="password" class="form-control form-control-sm" name="pass_" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label>Ulangi Password Baru</label>
                            <input type="password" class="form-control form-control-sm" name="pass__">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<div style="padding-bottom: 70px;">
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
                        alert("Ganti Password Success!");
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