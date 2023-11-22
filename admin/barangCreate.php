<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tambah Data Barang</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="form-grup">
                    <label>Harga (Rp)</label>
                    <input type="number" class="form-control" name="harga">
                </div>
                <div class="form-grup">
                    <label>Berat (Gr)</label>
                    <input type="number" class="form-control" name="berat">
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" class="form-control" name="foto">
                </div>
                <div class="form-grup">
                    <label>Stok Produk</label>
                    <input type="number" class="form-control" name="stok">
                </div>
                <div class="form-grup">
                    <label>Kategori Produk</label>
                    <input type="text" class="form-control" name="kategori">
                </div>	
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="10"></textarea>
                </div>
                <button class="btn btn-primary" name="save">Simpan</button>
            </form>
                <?php  
                    if (isset($_POST['save'])) {
                        //foto
                        $nama = $_FILES['foto']['name'];
                        $lokasi = $_FILES['foto']['tmp_name'];
                        move_uploaded_file($lokasi, "../foto_produk/".$nama);

                        //file resep
                        $namaresep = $_FILES['resep']['name'];
                        $lokasiresep = $_FILES['resep']['tmp_name'];
                        move_uploaded_file($lokasiresep, "../resep_produk/".$namaresep);

                        //input ke data base
                        $koneksi->query("INSERT INTO produk 
                            (nama_produk,harga_produk,berat_produk,foto_produk,deskripsi_produk,stok_produk, kategori_produk)
                            VALUES('$_POST[nama]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]','$_POST[stok]', '$_POST[kategori]')");

                        echo "<script> alert('Produk Terubah'); </script>";
                        echo "<script> location='index.php?x=barang'; </script>";
                    }

                ?>
            </div>
        </div>
    </div>