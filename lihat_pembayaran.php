<?php 
	session_start();
	$koneksi = new mysqli("localhost","root","","tokolaptop");

	$id_pembelian = $_GET['id'];

	$ambil = $koneksi->query("SELECT * FROM pembayaran 
		LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
		WHERE pembelian.id_pembelian='$id_pembelian'");
	$pecah = $ambil->fetch_assoc();

	//jika belum ada data pembayaran
	if(empty($pecah)){
		echo "<script> alert('Anda Tidak Dapat Mengakses'); </script>";
		echo "<script> location='riwayat.php'; </script>";
		exit();
	}

	//jika data pelanggan yang bayar dan login tidak sama
	if($_SESSION['pelanggan']['id_pelanggan']!==$pecah['id_pelanggan']) {
		echo "<script> alert('Anda Tidak Dapat Mengakses'); </script>";
		echo "<script> location='riwayat.php'; </script>";
		exit();
	}

	// echo "<pre>";
	// 	print_r($pecah);
	// 	print_r($_SESSION);
	// 	echo "</pre>";
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>InfinityStore</title>
</head>
<body>
<link href="assets/style.css" rel="stylesheet">
<?php include 'assets/navbar.php'; ?>

	<?php 

	$koneksi = new mysqli("localhost","root","","hidupsehat");

	$id_pembelian = $_GET['id'];

	$ambil = $koneksi->query("SELECT * FROM pembayaran 
		LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
		WHERE pembelian.id_pembelian='$id_pembelian'");
	$pecah = $ambil->fetch_assoc();

	?>

		<div class="container">
			<h3>Lihat Pembayaran</h3>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<table class="table">
							<tr>
								<th>Nama Penyetor</th>
								<td><?php echo $pecah['nama']; ?></td>
							</tr>
							<tr>
								<th>Bank</th>
								<td><?php echo $pecah['bank']; ?></td>
							</tr>
							<tr>
								<th>Tanggal</th>
								<td><?php echo $pecah['tanggal']; ?></td>
							</tr>
							<tr>
								<th>Jumlah</th>
								<td>Rp. <?php echo number_format($pecah['jumlah']); ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<img src="bukti_pembayaran/<?php echo $pecah['bukti']; ?>" class="img-responsive">
				</div>
			</div>
		</div>

</body>
</html>