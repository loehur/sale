<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">
                <div class="alert alert-success">
                    <?php
                    foreach ($data as $a) {
                        echo "<b>" . strtoupper($a['desc']) . "<br> <span class='text-danger'>" . strtoupper($a['jumlah']) . "<br>" . strtoupper($a['op_status']) . "</span></b>";
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

</script>