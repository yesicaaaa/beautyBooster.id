<div class="main">
  <div class="message-cart"><?= $this->session->flashdata('message'); ?></div>
  <div class="row">
    <div class="col-md-4">
      <img class="product-img" src="<?= base_url('assets/img/products/') . $product['image'] ?>" alt="<?= $product['product_name'] ?>">
    </div>
    <div class="col-md-6 product-detail">
      <h1><?= $product['product_name'] ?></h1>
      <p class="desc-product"><?= $product['description'] ?></p>
      <p class="rating-product"><i class="fa fa-fw fa-heart"></i> <?= $product['rating'] ?></p>
      <p class="price-product">Rp<?= number_format($product['price'], 0, ',', '.') ?></p>
      <a href="<?= base_url('/main/add_to_cart/') . $product['id'] ?>" class="btn btn-cart">Add to Cart</a>
    </div>
  </div>
</div>