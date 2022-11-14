		<!-- Bottom Navbar -->
		<?php
		if (isset($this->userData['user_tipe']) && $this->userData['user_tipe'] == 1) {
		?>

			<b>
				<nav class="navbar table-info navbar-expand border-top fixed-bottom m-auto p-0" style="max-width: 750px;min-width: <?= $min_width ?>;">
					<ul class="navbar-nav nav-justified w-100">
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>Staff" class="nav-link text-secondary text-nowrap"><i class="fas fa-users"></i><br>Staff</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>SubMenu/stok" class="nav-link text-secondary text-nowrap"><i class="fas fa-layer-group"></i><br>Stock</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>SubMenu/rekap" class="nav-link text-secondary text-nowrap">
								<i class="fas fa-chart-line"></i><br>Rekap
							</a>
						</li>
					</ul>
				</nav>
			</b>

		<?php } ?>

		<?php
		if (isset($this->userData['user_tipe']) && $this->userData['user_tipe'] == 10) {
		?>

			<b>
				<nav class="navbar table-info navbar-expand border-top fixed-bottom m-auto p-0" style="max-width: 750px;min-width: <?= $min_width ?>;">
					<ul class="navbar-nav nav-justified w-100">
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>Blank" class="nav-link text-secondary text-nowrap"><i class="fas fa-users"></i><br>Preferensi</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>TerimaStok" class="nav-link text-secondary text-nowrap"><i class="fas fa-tags"></i><br>Stok Masuk</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>Blank" class="nav-link text-secondary text-nowrap"><i class="fas fa-check-double"></i><br>Approval</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>Blank" class="nav-link text-secondary text-nowrap">
								<i class="fas fa-wallet"></i><br>Stok Data
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>Blank" class="nav-link text-secondary text-nowrap">
								<i class="fas fa-chart-line"></i><br>Rekap
							</a>
						</li>
					</ul>
				</nav>
			</b>

		<?php }

		if (isset($this->userData['user_tipe']) && $this->userData['user_tipe'] == 100) {
		?>

			<b>
				<nav class="navbar table-info navbar-expand border-top fixed-bottom m-auto p-0" style="max-width: 750px;min-width: <?= $min_width ?>;">
					<ul class="navbar-nav nav-justified w-100">
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>TerimaStok" class="nav-link text-secondary text-nowrap"><i class="fas fa-tags"></i><br>Stok Masuk</a>
						</li>
					</ul>
				</nav>
			</b>

		<?php } ?>