<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "tokolaptop");
$ambil = $_GET;
$coloumn = implode(" ", $ambil);
$ambildata = $koneksi->query("SELECT * FROM produk WHERE kategori_produk ='$coloumn'");
?>

<!DOCTYPE html>
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
    <?php include 'assets/navbar-kategori.php'; ?>
    <div class="container">
        <div class="row">
            <!-- foreach -->
				<?php foreach ($ambildata as $perproduk): ?>
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
			    <?php endforeach; ?>
            <!-- end foreach -->
        </div>
    </div>
</body>

</html>