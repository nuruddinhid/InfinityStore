<?php session_start(); ?>
<?php $koneksi = new mysqli("localhost","root","","tokolaptop"); ?>
<?php 
//jika tidak ada session pelanggan maka tidak bisa diakses
if (!isset($_SESSION['pelanggan'])) {
	echo "<script> alert('Silahkan Login Terlebih Dahulu'); </script>";
	echo "<script> location='login.php' </script>";
	exit();
}
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
		<!-- section -->
		<section class="riwayat">
			<div class="container">
			<h3><span> Riwayat Pembelian <?php echo $_SESSION['pelanggan']['nama_pelanggan'];?></span>&nbsp;&nbsp;</h3><br>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pembelian</th>
							<th>Status Pembelian</th>
							<th>Total</th>
							<th>Keterangan</th>
						</tr>
					</thead>

					<tbody>
						<?php $nomor=1; ?>
						<?php 
						//mendapatkan id yang login
						$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
						//ambil dan pecahkan
						$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan'");
						while($pecah = $ambil->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $pecah['tanggal_pembelian']; ?></td>
							<td><?php echo $pecah['status_pembelian']; ?>
								<br>
								<?php if(!empty($pecah['resi_pengiriman'])): ?>
								No.Resi <?php echo $pecah['resi_pengiriman']; ?>
								<?php endif  ?>
							</td>
							<td>Rp. <?php echo number_format($pecah['total_pembelian']); ?></td>
							<td>
								<a href="nota.php?id=<?php echo $pecah['id_pembelian']?>" class="btn btn-warning">Nota</a>
								
								<?php if($pecah['status_pembelian']=='Tertunda'): ?>
									<a href="pembayaran.php?id=<?php echo $pecah['id_pembelian']?>" class="btn btn-success">Pembayaran</a>
									<?php else: ?>
										<!-- <a href="lihat_pembayaran.php?id=<?php echo $pecah['id_pembelian']?>" class="btn btn-warning">Lihat</a> -->
								<?php endif ?>
							</td>
						</tr>
						<?php $nomor++ ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</section>

</body>
</html>
