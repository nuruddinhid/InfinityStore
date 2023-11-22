<?php 
session_start();
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

<div class="container">
    <div class="card login-form">             
        <div class="card-body">
            <h6 class="card-subtitle text-muted mb-4 text-center">Pendaftaran</h6>
            <form method="post">
                <div class="mb-4">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control">
                </div>
                <div class="mb-4">
                    <label>Email</label>
                    <input type="email" name="gmail" class="form-control">
                </div>
                <div class="mb-4">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="mb-4">
                    <label>Telepon</label>
                    <input type="text" name="telepon" class="form-control">
                <div class="d-grid mt-5">
                    <button class="btn btn-primary" name="daftar">Daftar</button><br>
                    <a href="login.php"<button class="btn btn-warning" name="daftar">Batal</button></a>
                </div>
            </form>
    </div>
</div>



	

</body>
</html>

<?php  
	if (isset($_POST['daftar'])) {
		
		//mengambil input 
		$nama = $_POST['nama'];
		$password = $_POST['password'];
		$email = $_POST['gmail'];
		$telepon = $_POST['telepon'];

		//check apakah gmail sudah dipakai apa belum
		$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE gmail_pelanggan='$email'");
		$yangcocok = $ambil->num_rows;
		if ($yangcocok==1) {
			echo "<script> alert('Pendaftaran Gagal Karena Gmail Sudah Digunakan');</script>";
			echo "<script> location='daftar.php' </script>";
		}
		else {
			$koneksi->query("INSERT INTO pelanggan (gmail_pelanggan, password_pelanggan,nama_pelanggan,telepon_pelanggan) VALUES ('$email','$password','$nama','$telepon')");
			echo "<script> alert('Pendaftaran Sukses, Silahkan Login');</script>";
			echo "<script> location='login.php' </script>";
		}

		echo "<script> alert('Data Tersimpan, Silakan Login') </script>";
		echo "<meta http-equiv='refresh' content='1;url=login.php?hal=produk'>";
	}

?>
