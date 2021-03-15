<div class="main">
  <h4>Product Management</h4>
  <div class="row">
    <div class="col-md-4">
      <form action="<?= base_url('master_products') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search Product Name..." name="keyword" autocomplete="off" autofocus>
          <div class="input-group-append">
            <input class="btn btn-info" type="submit" name="submit">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <a href="<?= base_url(); ?>master_products/refresh"><img src="<?= base_url(); ?>assets/img/refresh.png"></a>
    </div>
  </div>
  <div class="row">
    <div style="width: 79%;">
      <?= form_error('category_id', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('sub_category', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('product_name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('stock', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('price', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('description', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= $this->session->flashdata('message'); ?>
      <b><a href="" class="btn btn-menu" data-toggle="modal" data-target="#newProductModal">Add New Product</a></b>
      <h6>Results: <?= $total_rows; ?></h6>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col">Sub Category</th>
            <th scope="col">Product Name</th>
            <th scope="col">Stock</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($products)) : ?>
            <tr>
              <td colspan="6">
                <div class="alert alert-danger" role="alert">
                  Data not found!
                </div>
              </td>
            </tr>
          <?php endif; ?>
          <?php foreach ($products as $pr) : ?>
            <tr>
              <th scope="row"><?= ++$start; ?></th>
              <td><?= $pr['category']; ?></td>
              <td><?= $pr['title']; ?></td>
              <td><?= $pr['product_name']; ?></td>
              <td><?= $pr['stock']; ?></td>
              <td><?= $pr['price']; ?></td>
              <td><?= $pr['description']; ?></td>
              <td>
                <a href="javascript:getData(<?= $pr['id'] ?>);" class="badge badge-edit">Edit</a>
                <a href="<?= base_url(); ?>master_products/deleteProduct/<?= $pr['id']; ?>" class="badge badge-delete" onclick="return confirm('Are You Sure?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?= $this->pagination->create_links(); ?>
    </div>
  </div>
</div>

<!-- Modal New Product-->
<div class="modal fade" id="newProductModal" tabindex="-1" aria-labelledby="newProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newProductModalLabel">Add New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master_products'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <select name="category_id" id="category" class="form-control">
              <option>Select Category</option>
              <?php foreach ($product_categories as $pc) : ?>
                <option value="<?= $pc['id']; ?>"><?= $pc['category']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <select name="sub_category_id" id="sub_category" class="form-control">
              <option>Select Sub Category</option>
              <?php foreach ($product_sub_categories as $psc) : ?>
                <option value="<?= $psc['id']; ?>"><?= $psc['title']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="price" name="price" placeholder="Price">
          </div>
          <div class="form-group">
            <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Edit Menu-->
<div class="modal fade" id="newEditProductModal" tabindex="-1" aria-labelledby="newEditProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newEditProductModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master_products/editProduct'); ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" id="idEdit" name="id">
          <div class="form-group">
            <select name="category_id" id="categoryEdit" class="form-control">
              <option>Select Category</option>
              <?php foreach ($product_categories as $pc) : ?>
                <option value="<?= $pc['id']; ?>"><?= $pc['category']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <select name="sub_category_id" id="sub_categoryEdit" class="form-control">
              <option>Select Sub Category</option>
              <?php foreach ($product_sub_categories as $psc) : ?>
                <option value="<?= $psc['id']; ?>"><?= $psc['title']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="product_nameEdit" name="product_name">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" id="stockEdit" name="stock">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="priceEdit" name="price">
          </div>
          <div class="form-group">
            <textarea class="form-control" id="descriptionEdit" name="description"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  var BASE_URL = '<?= base_url(); ?>'

  function getData(id){
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: BASE_URL + 'master_products/getProductRow',
      data: {
        id: id
      },
      success: function(data){
        $('#idEdit').val(data.id),
        $('#categoryEdit').val(data.category_id),
        $('#sub_categoryEdit').val(data.sub_category_id),
        $('#product_nameEdit').val(data.product_name),
        $('#stockEdit').val(data.stock),
        $('#priceEdit').val(data.price),
        $('#descriptionEdit').val(data.description),
        $('#newEditProductModal').modal()
      }
    });
  }
</script>