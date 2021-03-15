<div class="main">
  <h4>Menu Management</h4>
  <div class="row">
    <div class="col-md-4">
      <form action="<?= base_url('master_menu') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search Submenu Title..." name="keyword" autocomplete="off" autofocus>
          <div class="input-group-append">
            <input class="btn btn-info" type="submit" name="submit">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <a href="<?= base_url(); ?>master_menu/refresh"><img src="<?= base_url(); ?>assets/img/refresh.png"></a>
    </div>
  </div>
  <div class="row">
    <div style="width: 79%;">
      <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= $this->session->flashdata('message'); ?>
      <b><a href="" class="btn btn-menu" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a></b>
      <h6>Results: <?= $total_rows; ?></h6>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Menu</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($menu)) : ?>
            <tr>
              <td colspan="6">
                <div class="alert alert-danger" role="alert">
                  Data not found!
                </div>
              </td>
            </tr>
          <?php endif; ?>
          <?php foreach ($menu as $m) : ?>
            <tr>
              <th scope="row"><?= ++$start; ?></th>
              <td><?= $m['menu']; ?></td>
              <td>
                <a href="javascript:getData(<?= $m['id'] ?>);" class="badge badge-edit">Edit</a>
                <a href="<?= base_url(); ?>master_menu/deleteMenu/<?= $m['id']; ?>" class="badge badge-delete" onclick="return confirm('Are You Sure?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="pagination">
        <?= $this->pagination->create_links(); ?>
      </div>
    </div>
  </div>
</div>


<!-- Modal New Menu-->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master_menu'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
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
<div class="modal fade" id="newEditMenuModal" tabindex="-1" aria-labelledby="newEditMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newEditMenuModalLabel">Edit Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master_menu/editMenu'); ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" id="idEdit" name="id">
          <div class="form-group">
            <input type="text" class="form-control" id="menuEdit" name="menu">
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
</script>