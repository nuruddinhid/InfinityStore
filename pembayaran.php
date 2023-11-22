<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "tokolaptop");

//jika tidak ada session pelanggan maka tidak bisa diakses
if (!isset($_SESSION['pelanggan']) or empty($_SESSION['pelanggan'])) {
	echo "<script> alert('Silahkan Login Terlebih Dahulu'); </script>";
	echo "<script> location='login.php' </script>";
	exit();
}

//mendapatkan id dari url
$id_pem = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pem'");
$detpem = $ambil->fetch_assoc();

//mendapatkan id pelanggan yang beli
$id_pelanggan_beli = $detpem['id_pelanggan'];
//mendapatkan id pelanggan yang login
$id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];

if ($id_pelanggan_login !== $id_pelanggan_beli) {
	echo "<script> alert('Tidak Dapat Mengakses'); </script>";
	echo "<script> location='riwayat.php' </script>";
	exit();

}

// echo "<pre>";
// print_r($detpem);
// print_r($_SESSION);
// echo "</pre>";
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

	<div class="container">
		<h2>Konfirmasi Pembayaran</h2>
		<p>Kirim Bukti Pembayaran Anda Disini</p>
		<div class="alert alert-info">Total Tagihan Anda <strong>Rp.
				<?php echo number_format($detpem['total_pembelian']); ?>
			</strong></div>

		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Penyetor</label>
				<input type="text" name="nama" class="form-control" required=""
					placeholder="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>">
			</div>
			<div class="form-group">
				<label>Bank</label>
				<input type="text" name="bank" class="form-control" required="">
			</div>
			<div class="form-group">
				<label>Jumlah (Rp.)</label>
				<input type="number" name="jumlah" class="form-control" min="1" required=""
					placeholder="<?php echo $detpem['total_pembelian']; ?>">
			</div>
			<div class="form-group">
				<label>Foto Bukti</label>
				<input type="file" name="bukti" class="form-control" required="">
				<p class="text-danger">Format Foto Bukti JPG Maksimal 2MB</p>
			</div>
			<button class="btn btn-primary" name="kirim">Kirim</button>
		</form>
	</div>

	<?php
	if (isset($_POST['kirim'])) {

		//upload foto bukti
		$namabukti = $_FILES['bukti']['name'];
		$lokasibukti = $_FILES['bukti']['tmp_name'];
		//agar tidak sama fotonya
		$namafiks = date('YmdHis') . $namabukti;
		//lokasi foto
		move_uploaded_file($lokasibukti, "bukti_pembayaran/" . $namafiks);

		$tanggal = date('Y-m-d');

		$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
				VALUES ('$id_pem','$_POST[nama]','$_POST[bank]','$_POST[jumlah]','$tanggal','$namafiks') ");

		//update data pembelian dari pending menjadi sudah kirim pembayaran
		$koneksi->query("UPDATE pembelian SET status_pembelian = 'Proses' WHERE id_pembelian='$id_pem'");
		echo "<script> alert('Terima Kasih Sudah Memberikan Bukti Pembayaran'); </script>";
		echo "<script> location='riwayat.php' </script>";
		exit();
	}
	?>

</body>

</html>