<div class="main">
  <h2><?= $mainTitle ?></h2>
  <div class="titleBorder"></div>
  <div class="products">
    <div class="row">
      <?php foreach($products as $product) : ?>
      <div class="col-md-2">
        <a href="<?= base_url('main/product_detail/') . $product['id']; ?>">
          <img src="<?= base_url('assets/img/products/') . $product['image']; ?>">
          <p class="product-name"><?= $product['product_name']; ?></p>
          <i class="fa fa-fw fa-heart"></i>
          <span class="product-rating"><?= $product['rating']; ?></span>
          <p class="product-price">Rp<?= number_format($product['price']); ?></p>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>