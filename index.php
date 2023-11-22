<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "tokolaptop");
?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<title>InfinityStore</title>
</head>

<body>
	<link href="assets/style.css" rel="stylesheet">

	<?php include 'assets/navv.php'; ?>
	<?php include 'assets/carousel.php'; ?>

	<!--konten-->
	<br>
	<br>
	<section class="konten">
		<div class="container">
			<div class="meta-post">
				<div class="styleLanding">
					<span></span>
					<h2 class="text-center judulLanding">TERBARU</h2>
					<span></span>
				</div>
				<div class="row">
					<?php $tb = 0; ?>
					<?php $ambil = $koneksi->query("SELECT * FROM produk ORDER BY id_produk DESC"); ?>
					<?php foreach ($ambil as $perproduk): ?>
						<div class="col mb-4">
							<div class="card" style="width: 16rem;">
								<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" class="card-img-top"
									style="width : 100%; height: 180px;">
								<div class="card-body">
									<h4 class="card-title">
										<?php echo $perproduk['nama_produk']; ?>
									</h4>
									<!-- Jika Stok ada tampilkan angka, jika tidak maka muncul habis -->
									<p style="color:red">*Stok
										<?php if ($perproduk['stok_produk'] >= 1) {
											echo $perproduk['stok_produk'];
										} else
											echo "<strong>Habis</strong>";
										?>
									</p>
									<h5> Rp.
										<?php echo number_format($perproduk['harga_produk']); ?>
									</h5>
									<!-- Jika ada stok maka bisa beli, jika tidak maka tidak bisa membeli -->
									<?php if ($perproduk['stok_produk'] >= 1): { ?>
											<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>"
												class="btn btn-primary">Beli</a>
											<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>"
												class="btn btn-success">Detail</a>
											<!-- <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-">Keranjang</a> -->
										<?php } ?>
									<?php else: { ?>
											<button class="btn btn-danger">Habis</button>
										<?php } ?>
									<?php endif ?>
								</div>
							</div>
						</div>
						<?php if (++$tb == 4)
							break; ?>
					<?php endforeach; ?>
				</div>
				<br>
				<br>
				<div class="styleLanding">
					<span></span>
					<h2 class="text-center judulLanding">KATEGORI</h2>
					<span></span>
				</div>
				<div class="roww">
					<div class="row justify-content-md-center">
						<div class="col">
							<div class="article-container-secondRow text-uppercase">
								<a href="kategori.php?kategori=<?= $table = 'bola'; ?>"
									style="text-decoration: none;">
									<div class="article-img-holder-secondRow bola"></div>
								</a>
							</div>
						</div>
						<div class="col ">
							<div class="article-container-secondRow text-uppercase">
								<a href="kategori.php?kategori=<?= $table = 'futsal'; ?>"
									style="text-decoration: none;">
									<div class="article-img-holder-secondRow futsal"></div>
								</a>
							</div>
						</div>
						<div class="col ">
							<div class="article-container-secondRow text-uppercase">
							<a href="kategori.php?kategori=<?= $table = 'running'; ?>"
									style="text-decoration: none;">
									<div class="article-img-holder-secondRow running"></div>
								</a>
							</div>
						</div>
					</div>
					<div class="row justify-content-md-center">
						<div class="col">
							<div class="article-container-secondRow text-uppercase">
							<a href="kategori.php?kategori=<?= $table = 'sneakers'; ?>"
									style="text-decoration: none;">
									<div class="article-img-holder-secondRow sneaker"></div>
								</a>
							</div>
						</div>
						<div class="col ">
							<div class="article-container-secondRow text-uppercase">
							<a href="kategori.php?kategori=<?= $table = 'sandal'; ?>"
									style="text-decoration: none;">
									<div class="article-img-holder-secondRow sandal"></div>
								</a>
							</div>
						</div>
						<div class="col ">
							<div class="article-container-secondRow text-uppercase">
							<a href="kategori.php?kategori=<?= $table = 'basket'; ?>"
									style="text-decoration: none;">
									<div class="article-img-holder-secondRow basket"></div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>

	<?php include 'assets/footer.php'; ?>
	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	-->
</body>

</html>

<style>
	.row {
		margin: 30px 40px;
	}

	.article-img-holder-secondRow {
		width: 200px;
		height: 200px;
		transition: all 0.7s;
		display: flex;
		justify-content: center;
		align-items: center;
		color: white;
		text-decoration: none;
		font-size: 35px;
	}

	.bola {
		background: url("assets/img/bola.png");
		background-position: center;
		background-size: cover;
		background-repeat: no-repeat;
		border-radius: 30px;
	}

	.futsal {
		background: url("assets/img/futsal.png");
		background-position: center;
		background-size: cover;
		background-repeat: no-repeat;
		border-radius: 30px;
	}

	.running {
		background: url("assets/img/running.png");
		background-position: center;
		background-size: cover;
		background-repeat: no-repeat;
		border-radius: 30px;
	}

	.sneaker {
		background: url("assets/img/sneaker.png");
		background-position: center;
		background-size: cover;
		background-repeat: no-repeat;
		border-radius: 30px;
	}

	.sandal {
		background: url("assets/img/sandal.png");
		background-position: center;
		background-size: cover;
		background-repeat: no-repeat;
		border-radius: 30px;
	}

	.basket {
		background: url("assets/img/basket.png");
		background-position: center;
		background-size: cover;
		background-repeat: no-repeat;
		border-radius: 30px;
	}


	.article-img-holder-secondRow:hover {
		transform: scale(1.15);
		filter: saturate(0%);
	}

	.kategori {
		margin: 30px 40px;
	}
</style>