
            <?php $tb = 0; ?>
            <?php foreach ($produk as $prdk) : ?>
                <div class="col mb-4">
                    <div class="card" style="width: 16rem;">
                        <img style="background-position: center;" src="assets/img/dbs/<?= $prdk["productImage"]; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $prdk["productName"]; ?></h5>
                            <h5 style="color: green;" class="card-price">Rp<?= $prdk["productPrice"]; ?></h5>
                            <p class="card-text">Toko <?= $prdk["productOwner"]; ?></p>
                            <!--<a href="<?= $prdk["productLink"]; ?>" class="btn btn-success">Detail Produk</a>!-->
                            <a href="view/client/detail.php" class="btn btn-success">Detail Produk</a>
                        </div>
                    </div>
                </div>
                <?php if (++$tb == 4) break; ?>
            <?php endforeach; ?>
            <!-- endforeach -->
            <div class="toko">
                <div class="card text-center">
                    <div class="card-header bg-success">
                        <h5 class="text-light">TOKO</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Mau liat lebih banyak lagi ?</h5>
                        <p class="card-text">Ayo kunjungi toko kami, kamu bisa pilih barang sesuai kategori dan ada fitur cari produknya juga lhoo.<br> kamu bisa lebih cepat mencari barang yang kamu ingin kan.</p>
                        <a href="view/client/shopAllCategory.php?kategori=<?= $table = 'firstshop'; ?>" class="btn btn-success">Kunjungi Toko <i class="fas fa-store"></i></a>
                    </div>
                </div>
            </div>
        </div>