<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Pelanggan</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
        <?php  
            $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id];'");
            $pecah = $ambil-> fetch_assoc();

            echo"<pre>";
            print_r($pecah);
            echo "</pre>";
        ?>
        
        <form method="post">
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_pelanggan']; ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control" name="password" value="<?php echo $pecah['password_pelanggan']; ?>">
            </div>
            <div class="form-group">
                <label>Email Pelanggan</label>
                <input type="text" class="form-control" name="gmail" value="<?php echo $pecah['gmail_pelanggan']; ?>">
            </div>
            <div class="form-group">
                <label>Telepon Pelanggan</label>
                <input type="text" class="form-control" name="telepon" value="<?php echo $pecah['telepon_pelanggan']; ?>">
            </div>
            <button class="btn btn-primary" name="ubah">Update</button>
        </form>
        <?php
            if (isset($_POST['ubah'])) {
                $koneksi->query("UPDATE pelanggan SET gmail_pelanggan='$_POST[gmail]', password_pelanggan='$_POST[password]', nama_pelanggan='$_POST[nama]', telepon_pelanggan='$_POST[telepon]' WHERE id_pelanggan='$_GET[id]'");
            

            echo "<script> alert ('Pelanggan Terubah'); </script>";
            echo "<script> location='index.php?x=pelanggan'; </script>";

            }
        ?>
        </div>
    </div>