<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Barang</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="index.php?x=createbarang" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga (Rp)</th>
                            <th>Berat (Gr)</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor=1; ?>
                        <?php $ambil=$koneksi->query(" SELECT * FROM produk"); ?>
                        <?php while($pecah=$ambil->fetch_assoc()) { ?>
                            <tr>
                                <td> <?php echo $nomor; ?></td>
                                <td> <?php echo $pecah['nama_produk']; ?> </td>
                                <td> <?php echo $pecah['harga_produk']; ?></td>
                                <td> <?php echo $pecah['berat_produk']; ?></td>
                                <td> <img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100"></td>
                                <td>
                                    <a href="index.php?x=updatebarang&id=<?php echo $pecah['id_produk']; ?>" class="btn-warning btn">Ubah</a>
                                    <a href="index.php?x=deletebarang&id=<?php echo $pecah['id_produk']; ?>" class="btn-danger btn">Hapus</a>
                                </td>
                            </tr>
                            <?php $nomor++ ?>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>