<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "tokolaptop");

//Keranjang Kosong
if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {
	echo "<script> alert('Keranjang Belanja Kosong, Silahkan Berbelanja'); </script>";
	echo "<script> location='index.php'; </script>";
}

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
	<?php include 'assets/navbar.php'; ?>

	<!-- konten -->
	<section class="konten">
		<div class="container">
			<h1><span><em class="glyphicon glyphicon-shopping-cart"></em> Keranjang</span>&nbsp;&nbsp;</h1>
			<hr>
			<table class="table table-bordered ">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Total</th>
						<th>Aksi</th>
					</tr>
				</thead>

				<tbody>
					<?php $nomor = 1; ?>
					<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
						<!-- Menampilkan Produk Perulangan Berdasarkan id_produk-->
						<?php $ambildata = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'"); ?>
						<?php $pecah = $ambildata->fetch_assoc(); ?>
						<tr>
							<td>
								<?php echo $nomor; ?>
							</td>
							<td>
								<?php echo $pecah['nama_produk']; ?>
							</td>
							<td>Rp.
								<?php echo number_format($pecah['harga_produk']); ?>
							</td>
							<td>
								<?php echo $jumlah ?>
							</td>
							<td>Rp.
								<?php echo number_format($pecah['harga_produk'] * $jumlah); ?>
							</td>
							<td>
								<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs"
									onclick="return confirm('Apakah Anda Yakin ?');">Hapus</a>
							</td>
						</tr>
						<?php $nomor++; ?>
					<?php endforeach ?>
				</tbody>
			</table>
			<a href="index.php" class="btn btn-success">Lanjut Belanja</a>
			<a href="bayar.php" class="btn btn-primary">Bayar</a>
			<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger"
				onclick="return confirm('Apakah Anda Yakin ?');">Hapus Semua</a>
		</div>
	</section>

</body>

</html>