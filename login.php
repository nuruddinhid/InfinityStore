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
<?php include 'assets/navv.php'; ?>

<div class="container">
    <div class="card login-form">             
        <div class="card-body">
            <h6 class="card-subtitle text-muted mb-4 text-center">Login</h6>
            <form method="post">
                <div class="mb-4">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="d-grid mt-5">
                    <button class="btn btn-primary" name="login">Login</button>
                    <br>
                    <a href="daftar.php"<button class="btn btn-warning" name="daftar">Daftar</button></a>
                </div>
            </form>
    </div>
</div>

<?php
	if (isset($_POST["login"])) {
		//$email = $_POST["gmail"];
		//$password = $_POST["password"];
		//check account pada db
		$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE gmail_pelanggan='$_POST[gmail]' AND password_pelanggan='$_POST[password]'");
		//menghitung account yang cocok pada db
		$akunyangcocok = $ambil->num_rows;
		if ($akunyangcocok==1) {
			$_SESSION['pelanggan'] = $ambil->fetch_assoc();
			//$akun = $ambil->fetch_assoc();
			//$_SESSION["pelanggan"] = $akun;
			echo "<script> alert('Login Berhasil'); </script>";
			echo "<script> location='index.php'; </script>";
			
		}
		else {
			echo "<script> alert('Login Gagal, Tekan Ok Untuk Coba Lagi'); </script>";
			echo "<script> location='login.php'; </script>";
		}
	}
?>
</body>
</html>