<div class="main">
  <h3 class="item-checkout"><?= $this->cart->total_items() ?> Items</h3>
<?php foreach($products as $p) : ?>
  <div class="product-checkout">
    <p>
      <span class="qty-checkout"><?= $p['qty'] ?>x</span> 
      <?= $p['name'] ?> 
      <span class="point-checkout">
        <?php for($i = 1; $i<=70; $i++) : ?>
          <span>.</span>
        <?php endfor; ?>
      </span>
      <span class="price-checkout"> <?= number_format($p['price'] * $p['qty'], 0, ',', '.') ?></span>
    </p>
  </div>
  <?php endforeach; ?>
  <div class="divider-checkout"></div>
  <h6 class="subtotal-checkout">Total : Rp<?= number_format($this->cart->total(),  0, ',', '.'); ?></h6>
  <div class="footer-checkout">
    <a href="<?= base_url('main/struk_pembayaran') ?>" class="btn btn-checkout">Buat Pesanan</a>
  </div>
</div>