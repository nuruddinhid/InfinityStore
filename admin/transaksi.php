<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Transaksi</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $nomor=1; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");?>
                        <?php while($pecah=$ambil->fetch_assoc()) { ?>
                        <tr>
                            <td> <?php echo $nomor; ?> </td>
                            <td> <?php echo $pecah["nama_pelanggan"]; ?> </td>
                            <td> <?php echo $pecah["tanggal_pembelian"]; ?></td>
                            <td> <?php echo $pecah["status_pembelian"]; ?></td>
                            <td> Rp. <?php echo number_format($pecah["total_pembelian"]); ?></td>
                            <td> <a href="index.php?x=detail&id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-info">Detail</a>
                                <?php if ($pecah['status_pembelian']!=="Tertunda"): ?>
                                    <a href="index.php?x=lihatpembayaran&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-success">Lihat Pembayaran</a>
                                <?php endif ?>
                            </td>
                        </tr>
                        <?php $nomor++ ?>
                        <?php } ?>
                    </tbody>
                </table>                
            </div>
        </div>
    </div>