<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand  text-uppercase fw-bold" href="#">The Sneakers</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Belanja</a>
                    </li>
                    <?php if (!isset($_SESSION['keranjang'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="keranjang.php">Keranjang</a>
                        </li>
                    <?php else : ?>
                        <hide>
                            <?php $jml = 0; ?>
                            <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
                                <?php $ambildata = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'"); ?>
                                <?php $pecah = $ambildata->fetch_assoc(); ?>
                                <tr>
                                    <td><?php $jumlah ?></td>
                                </tr>
                                <?php $jml += $jumlah; ?>
                            <?php endforeach ?>
                        </hide>
                        <li class="nav-item">
                            <a class="nav-link" href="keranjang.php">Keranjang (<?php echo $jml; ?>)</a>
                        </li>
                    <?php endif ?>
                    <li class="nav-item">
                        <a class="nav-link" href="bayar.php">Pembayaran</a>
                    </li>
                </ul>
      <form class="d-flex" action="pencarian.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Cari" name="keyword">
        <button class="btn btn-outline-success" type="submit">Cari</button>
      </form>
    </div>
  </div>
</nav>