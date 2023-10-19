		<b>
			<nav class="navbar table-light shadow-sm navbar-expand mr-auto ml-auto border-bottom p-0 fixed-top" style="max-width: <?= $max_width ?>; min-width: <?= $min_width ?>;">
				<ul class="navbar-nav nav-justified w-100">
					<li class="nav-item">
						<a href="<?= $this->BASE_URL ?>Home" class="nav-link text-secondary text-nowrap"><i class="fas fa-money-check"></i><br>Home</a>
					</li>
					<?php
					if ($this->userData['id_user'] <> $this->userData['id_master']) { ?>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>Transaksi" class="nav-link text-secondary text-nowrap">
								<i class="fas fa-cash-register"></i><br>Transaksi
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>Penarikan" class="nav-link text-secondary text-nowrap"><i class="fas fa-receipt"></i><br>Setoran</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>Akun" class="nav-link text-secondary text-nowrap"><i class="fas fa-user"></i><br>Akun</a>
						</li>
					<?php  } else { ?>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>SubMenu/i/approval" class="nav-link text-secondary text-nowrap"><i class="fas fa-check-double"></i><br>Approval</a>
						</li>
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>SubMenu/i/rekap" class="nav-link text-secondary text-nowrap">
								<i class="fas fa-chart-line"></i><br>Rekap
							</a>
						</li>
					<?php } ?>
				</ul>
			</nav>
		</b>