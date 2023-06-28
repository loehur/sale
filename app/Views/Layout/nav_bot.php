		<!-- Bottom Navbar -->
		<?php
		if ($this->userData['id_user'] == $this->userData['id_master']) {
		?>

			<b>
				<nav class="navbar table-info navbar-expand border-top fixed-bottom m-auto p-0" style="max-width: 750px;min-width: <?= $min_width ?>;">
					<ul class="navbar-nav nav-justified w-100">
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>Staff" class="nav-link text-secondary text-nowrap"><i class="fas fa-users"></i><br>Outlate</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>SubMenu/i/stok" class="nav-link text-secondary text-nowrap"><i class="fas fa-layer-group"></i><br>Stock</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>SubMenu/i/inventaris" class="nav-link text-secondary text-nowrap"><i class="fas fa-layer-group"></i><br>Inventaris</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>SubMenu/i/approval" class="nav-link text-secondary text-nowrap"><i class="fas fa-check-double"></i><br>Approval</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>SubMenu/i/rekap" class="nav-link text-secondary text-nowrap">
								<i class="fas fa-chart-line"></i><br>Rekap
							</a>
						</li>
					</ul>
				</nav>
			</b>

		<?php } else { ?>

			<b>
				<nav class="navbar table-info navbar-expand border-top fixed-bottom m-auto p-0" style="max-width: 750px;min-width: <?= $min_width ?>;">
					<ul class="navbar-nav nav-justified w-100">
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>SubMenu/i/stok_staff" class="nav-link text-secondary text-nowrap"><i class="fas fa-layer-group"></i><br>Stock</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>SubMenu/i/inventaris_staff" class="nav-link text-secondary text-nowrap"><i class="fas fa-layer-group"></i><br>Inventaris</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>SubMenu/i/pengajuan" class="nav-link text-secondary text-nowrap"><i class="fas fa-check-double"></i><br>Pengajuan</a>
						</li>
					</ul>
				</nav>
			</b>

		<?php } ?>