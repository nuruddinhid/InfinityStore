<?php

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tambah Data Barang</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_produk']; ?>">
                </div>
                <div class="form-grup">
                    <label>Harga (Rp)</label>
                    <input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>">
                </div>
                <div class="form-grup">
                    <label>Berat (Gr)</label>
                    <input type="number" class="form-control" name="berat" value="<?php echo $pecah['berat_produk']; ?>">
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" class="form-control" name="foto">
                </div>
                <div class="form-grup">
                    <label>Stok Produk</label>
                    <input type="number" class="form-control" name="stok" value="<?php echo $pecah['stok_produk']; ?>">
                </div>	
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="10"> <?php echo $pecah['deskripsi_produk']; ?></textarea>
                </div>
                <button class="btn btn-primary" name="ubah">Ubah</button>
            </form>
                <?php
                
                if (isset($_POST['ubah'])) {
                    //foto
                    $namafoto = $_FILES['foto']['name'];
                    $lokasifoto = $_FILES['foto']['tmp_name'];
                    

                    //jika foto diubah
                    if (!empty($lokasifoto)) {
                        move_uploaded_file($lokasifoto,"../foto_produk/$namafoto");

                        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]', harga_produk='$_POST[harga]', berat_produk='$_POST[berat]', foto_produk='$namafoto', deskripsi_produk='$_POST[deskripsi]', stok_produk='$_POST[stok]' WHERE id_produk = '$_GET[id]'");
                    }
                    //jika tidak
                    else {
                        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]', harga_produk='$_POST[harga]', berat_produk='$_POST[berat]', deskripsi_produk='$_POST[deskripsi]', stok_produk='$_POST[stok]' WHERE id_produk = '$_GET[id]'");
                    }
            //-----------------------------------------------------------------------
                    //file resep
                    $namaresep = $_FILES['resep']['name'];
                    $lokasiresep = $_FILES['resep']['tmp_name'];
                    
                    //jika file diubah
                    if (!empty($lokasiresep)) {
                        move_uploaded_file($lokasiresep, "../resep_produk/$namaresep"); 

                        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]', harga_produk='$_POST[harga]', berat_produk='$_POST[berat]', deskripsi_produk='$_POST[deskripsi]', resep_produk='$namaresep', stok_produk='$_POST[stok]' WHERE id_produk = '$_GET[id]'");
                    }
                    //jika tidak
                    else {
                        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]', harga_produk='$_POST[harga]', berat_produk='$_POST[berat]', deskripsi_produk='$_POST[deskripsi]', stok_produk='$_POST[stok]' WHERE id_produk = '$_GET[id]'");
                    }

                echo "<script> alert('Produk Terubah'); </script>";
                echo "<script> location='index.php?x=barang'; </script>";
                }
            ?>
            </div>
        </div>
    </div>