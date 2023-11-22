<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Pelanggan</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $nomor=1; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM pelanggan");?>
                        <?php while($pecah=$ambil->fetch_assoc()) { ?>
                        <tr>
                            <td> <?php echo $nomor; ?> </td>
                            <td> <?php echo $pecah["nama_pelanggan"]; ?> </td>
                            <td> <?php echo $pecah["gmail_pelanggan"]; ?></td>
                            <td> <?php echo $pecah["telepon_pelanggan"]; ?></td>
                            <td><a href="index.php?x=updatepelanggan&id=<?php echo $pecah['id_pelanggan'] ?>" class="btn btn-info">Update</a>
                                <a href="index.php?x=deletepelanggan&id=<?php echo $pecah['id_pelanggan'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php $nomor++ ?>
                        <?php } ?>
                    </tbody>
                </table>                
            </div>
        </div>
    </div>