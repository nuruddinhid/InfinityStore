<?php 
	session_start();
?>
<?php
	$koneksi = new mysqli("localhost","root","","tokolaptop");
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

	<section class="konten">
		<div class="container">
			<h2>Detail Pembelian</h2>
			<?php  
				$ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
				$detail=$ambil->fetch_assoc();
			?>

			<?php 
			//mendapatkan id yang beli
			$idpelangganyangbeli = $detail['id_pelanggan'];

			//mendapatkan id pelanggan yang login
			$idpelangganyanglogin = $_SESSION['pelanggan']['id_pelanggan'];

			if ($idpelangganyangbeli!==$idpelangganyanglogin) {
				echo "<script> alert('Gagal');</script>";
				echo "<script> location='riwayat .php'; </script>";
			}
			?>


			<p>
				Kode Pembelian : <strong>IFS-<?php echo $detail['id_pembelian']; ?>-B</strong><br>
				Tanggal Pembelian : <?php echo $detail['tanggal_pembelian']; ?> <br>
				Harga Pembelian : Rp. <?php echo number_format($detail['total_pembelian'])?>
			</p>
			<div class="row">
				<div class="col-md-4">
					<h3>Pelanggan</h3>
					<strong><?php echo $detail['nama_pelanggan']?></strong>
					<p>Nomor Telepon :  <?php echo $detail['telepon_pelanggan']?><br>Gmail : <?php echo $detail['gmail_pelanggan']; ?>
					</p>	
				</div>
				<div class="col-md-4">
					<h3>Pengirim</h3>
					<strong><?php echo $detail['nama_kurir']; ?></strong>
					<p>Tarif : Rp. <?php echo number_format($detail['tarif']); ?></p>
				</div>
				<div class="col-md-4">
					<h3>Alamat Pengiriman</h3>
					<strong><?php echo $detail['alamat_pengiriman']; ?></strong>
				</div>
			</div>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Total</th>
					</tr>
				</thead>

				<tbody>
					<?php $nomor=1; ?>
					<?php $totalbelanja=0;?>
					<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'");?>
					<?php while($pecah=$ambil->fetch_assoc()) { ?>
						<?php $subharga =  $pecah['harga_produk']*$pecah['jumlah_pembelian']; ?>
					<tr>
						<td> <?php echo $nomor; ?></td>
						<td> <?php echo $pecah['nama_produk']; ?></td>
						<td> Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
						<td> <?php echo $pecah['jumlah_pembelian']; ?></td>
						<td> Rp. <?php echo number_format($subharga); ?></td>
					</tr>
					<?php $nomor++ ?>
					<?php $totalbelanja+=$subharga; ?>
					<?php } ?>
				</tbody>


				<tfoot>
					<tr>
						<th colspan="4">Tarif</th>
						<td>Rp. <?php echo number_format($detail['tarif']); ?></td>
					</tr>
					<tr>
						<th colspan="4">TOTAL</th>
						<th>Rp. <?php echo number_format($totalbelanja+$detail['tarif']); ?></th>
					</tr>
				</tfoot>
			</table>
			<!cetak nota>
			<a href="cetaknota.php?id=<?php echo $_GET['id']; ?>" class="btn btn-primary">Cetak Nota</a>
			<br>
			<br>
			<div class="row">
				<div class="col-md-7">
					<div class="alert alert-info">
						<p>
							Silahkan melakukan Pembayaran <strong>Rp. <?php echo number_format($detail['total_pembelian'])?></strong>
							Ke <br>
							<strong>BANK BRI 663901026725532 AN. Nuruddin Hidayat</strong>
							
						</p>
					</div>
				</div>
			</div>

		</div>
	</section>

</body>
</html>