		<?php $id_barang = $data['id'];
		$nama_barang = $data['merk'] . " " . $data['model'] . " " . $data['deskripsi'];
		?>
		<b>
			<div>
				<h3 class="navbar mb-0 pb-0 text-danger"><?= strtoupper($nama_barang) ?></h3><br>
				<nav class="navbar border navbar-expand mx-3">
					<ul class="navbar-nav nav-justified w-100">
						<li class="nav-item">
							<a href="<?= $this->BASE_URL ?>StokOperasi/stop_stok/<?= $id_barang ?>/<?= $data['id_user'] ?>" class="nav-link text-secondary text-nowrap">
								<i class="fas fa-ban"></i><br>Stop Stok</a>
						</li>
					</ul>
				</nav>
			</div>
		</b>