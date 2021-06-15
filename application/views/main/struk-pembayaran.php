<div class="main bg-struk">
  <div class="container-struk">
    <h1>Terima Kasih</h1>
    <h6>beautyBooster.id</h6>
    <div class="divider-struk"></div>
    <h5>No. Pesanan : <?= date('dmy') . rand(1, 10000) ?></h5>
    <h5>Tgl. Pesanan : <?= date('d M Y') ?></h5>
    <h5>Estimasi Barang Diterima : <?= date('d') + 5 . date(' M Y') ?></h5>
  </div>
  <a href="<?= base_url('main/dashboard') ?>"><- Kembali</a>
</div>