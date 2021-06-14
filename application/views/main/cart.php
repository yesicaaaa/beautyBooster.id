<div class="main">
  <?php foreach($cart as $c) : ?>
  <div class="row mt-3 cart-items">
    <div class="col-sm-1 border-check">
      <i class="fa fa-fw fa-circle"></i>
    </div>
    <div class="col-md-1 border-img">
      <img class="img-cart" src="<?= base_url('assets/img/products/') . $c['image'] ?>" alt="product_image">
    </div>
    <div class="col-md-4 border-desc">
      <h4><?= $c['name'] ?></h4>
      <h5>Rp<?= number_format($c['price'], 0, ',', '.') ?></h5>
    </div>
    <div class="col-md-1 border-qty">
      <h4>Qty</h4>
      <h5><?= $c['qty'] ?></h5>
    </div>
    <div class="col-md-1 border-delete">
      <a href=""><i class="fa fa-fw fa-minus-circle"></i> Delete</a>
    </div>
  </div>
  <div class="row footer">
    <div class="col-md-7 border-footer1">
      <h4>Total : Rp<?= number_format($this->cart->total(), 0, ',', '.'); ?></h4>
    </div>
    <div class="col-md-2 border-footer2">
      <h5><?= $this->cart->total_items(); ?> Items</h5>
    </div>
    <div class="col-md-3 border-footer3">
      <a href="">Checkout</a>
    </div>
  </div>
  <?php endforeach; ?>
</div>