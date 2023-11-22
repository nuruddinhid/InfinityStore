<?php session_start(); ?>
<?php 
	$koneksi = new mysqli("localhost","root","","tokolaptop");
?>
<?php 
//mendapatkan id dari url
	$id_produk = $_GET['id'];
//ambil data id dari database
	$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
	$detail = $ambil->fetch_assoc();

	// echo "<pre>";
	// print_r($detail);
	// echo "</pre>";
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
    <div class="container">
        <div class="card mb-3">
            <img src="foto_produk/<?php echo $detail['foto_produk']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $detail['nama_produk']; ?></h5>
                <p class="card-text">Rp. <?php echo number_format($detail['harga_produk']); ?></p>                
                <p class="card-text"><?php echo $detail['deskripsi_produk']; ?></p>
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" min="1">
                        <button class="btn btn-primary" name="beli">Beli</button>
                    </div>
                </form>
            </div>
        </div>
	</div>
	<?php
		//mengambil id yang dibeli
		$id_produk = $_GET['id'];
		//jika ada tombol beli
		if (isset($_POST['beli'])) {
			//mendapatkan jumlah yang dibeli
			$jumlah = $_POST['jumlah'];
			//masukkan keranjang
			$_SESSION["keranjang"][$id_produk] += $jumlah;


			echo "<script> alert('Produk Masuk Kedalam Keranjang');</script>";
			echo "<script> location='keranjang.php' </script>";
		}
	?>

</body>
</html>