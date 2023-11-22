<?php 
$koneksi = new mysqli("localhost","root","","tokolaptop"); 
session_start();
?>
<?php 

	$keyword = $_GET['keyword'];

	$semuadata = array();
	$ambildata = $koneksi-> query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
	while($pecah = $ambildata->fetch_assoc()) {
		$semuadata[]=$pecah;	
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
		<h1>Hasil Pencarian : <?php echo $keyword ?></h1>
		<?php if(empty($semuadata)):?>
			<div class="alert alert-danger"><?php echo $keyword ?> Tidak Ditemukan</div>
		<?php endif ?>
		<div class="row">

			<?php foreach($semuadata as $key => $value): ?>
				<div class="col-md-3">
					<div class="card" style="width: 18rem; height: 30rem;">
                        <div class="container">
                            <img src="foto_produk/<?php echo $value['foto_produk']; ?>" class="card-img-top" alt="...">                            
                        </div>
							<div class="card-body">
                                <h4 class="card-title"><?php echo $value['nama_produk']; ?></h4>
                                <p class="card-text">Stok ( <strong><?php echo $value['stok_produk'] ?></strong> ) </p>
                                <p class="card-text">Rp. <?php echo number_format($value['harga_produk']); ?></p>
								<a href="beli.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary">Beli</a>
								<a href="detail.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-warning">Detail</a>
							</div>
					</div>
				</div>
			<?php endforeach ?>

		</div>
	</div>

</body>
</html>
