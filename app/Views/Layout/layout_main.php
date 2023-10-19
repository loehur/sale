<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset=" UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<link rel="icon" href="<?= $this->ASSETS_URL ?>icon/logo1.png">
	<title>Sale | <?= $data['title'] ?></title>
	<link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= $this->ASSETS_URL ?>/css/bootstrap-4.3.1.min.css">
	<link rel="stylesheet" href="<?= $this->ASSETS_URL ?>css/selectize.bootstrap3.min.css" rel="stylesheet" />


	<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
	<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
	<!-- FONT -->

	<?php $fontStyle = "'Titillium Web', sans-serif;" ?>

	<style>
		html .table {
			font-family: <?= $fontStyle ?>;
		}

		html .content {
			font-family: <?= $fontStyle ?>;
		}

		html body {
			font-family: <?= $fontStyle ?>;
		}

		@media print {
			p div {
				font-family: <?= $fontStyle ?>;
				font-size: 14px;
			}
		}

		html {
			height: 100%;
			background-color: #F4F4F4;
		}

		body {
			min-height: 100%;
		}
	</style>
</head>

<?php if (isset($data['view_load'])) {
	$method = $data['view_load'];
} else {
	$method = "Blank";
} ?>

<?php require_once("layout_config.php"); ?>

<body style="max-width: <?= $max_width ?>; min-width:  <?= $min_width ?>;" class="m-auto small border border-bottom-0">
	<?php require_once("nav_top.php"); ?>
	<?php if ($_SESSION['user_tipe'] <> 1) { ?>
		<div style="padding-top:70px" class="row ml-2 pl-2">
			<span class="h6 text-danger"><strong><?= strtoupper($this->userData['nama']) ?></strong></span>
		</div>
		<hr>
	<?php } else { ?>
		<div style="padding-top:65px;" class="row w-100 m-0 border-0 mb-2 pl-2 pb-2 bg-light border-bottom">
			<div class="col-auto pr-0">
				<input class="border-0 rounded-0 form-control form-control-sm text-right" value="User Logged" disabled />
			</div>
			<div class="col-auto pl-0 border pr-0">
				<select name="id_user" id="toko_master" class="border-0 form-control form-control-sm text-success" style="width: auto;">
					<?php
					foreach ($this->stafData as $a) { ?>
						<option value="<?= $a['id_user'] ?>" <?= ($this->userData['id_user'] == $a['id_user'] ? "selected" : "") ?>><?= strtoupper($a['nama']) ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	<?php } ?>
</body>

</html>

<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script>
	$('select#toko_master').on("change", function(event) {
		var val = $(this).val();
		$.ajax({
			url: "<?= $this->BASE_URL ?>Home/setID/",
			data: {
				toko: val
			},
			type: "POST",
			success: function() {
				location.href = "<?= $this->BASE_URL ?>Home";
			},
		});
	});

	var time = new Date().getTime();
	$(document.body).bind("mousemove keypress", function(e) {
		time = new Date().getTime();
	});

	function refresh() {
		if (new Date().getTime() - time >= 420000)
			window.location.reload(true);
		else
			setTimeout(refresh, 10000);
	}
	setTimeout(refresh, 10000);
</script>