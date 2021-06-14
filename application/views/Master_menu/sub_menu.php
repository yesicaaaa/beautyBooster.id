<div class="main">
  <h4>SubMenu Management</h4>
  <div class="row">
    <div class="col-md-4">
      <form action="<?= base_url('master_sub_menu') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search Submenu Title..." name="keyword" autocomplete="off" autofocus>
          <div class="input-group-append">
            <input class="btn btn-info" type="submit" name="submit">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <a href="<?= base_url(); ?>master_sub_menu/refresh"><img src="<?= base_url(); ?>assets/img/refresh.png"></a>
    </div>
  </div>
  <div class="row">
    <div style="width: 79%;">
      <?= form_error('menu_id', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('title', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('icon', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('url', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= $this->session->flashdata('message'); ?>
      <b><a href="" class="btn btn-menu" data-toggle="modal" data-target="#newSubMenuModal">Add New SubMenu</a></b>
      <h6>Results: <?= $total_rows; ?></h6>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Menu</th>
            <th scope="col">Title</th>
            <th scope="col">Icon</th>
            <th scope="col">Url</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($subMenu)) : ?>
            <tr>
              <td colspan="3">
                <div class="alert alert-danger" role="alert">
                  Data not found!
                </div>
              </td>
            </tr>
          <?php endif; ?>
          <?php foreach ($subMenu as $sm) : ?>
            <tr>
              <th scope="row"><?= ++$start; ?></th>
              <td><?= $sm['menu']; ?></td>
              <td><?= $sm['title']; ?></td>
              <td><?= $sm['icon']; ?></td>
              <td><?= $sm['url']; ?></td>
              <td>
                <a href="javascript:getData(<?= $sm['id'] ?>);" class="badge badge-edit">Edit</a>
                <a href="<?= base_url(); ?>master_sub_menu/deleteSubMenu/<?= $sm['id']; ?>" class="badge badge-delete" onclick="return confirm('Are You Sure?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?= $this->pagination->create_links(); ?>
    </div>
  </div>
</div>


<!-- Modal New Menu-->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Add New SubMenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master_sub_menu'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <select name="menu_id" id="menu" class="form-control">
              <option>Select Menu</option>
              <?php foreach ($menu as $m) : ?>
                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="url" name="url" placeholder="Url">
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
<div class="modal fade" id="newEditSubMenuModal" tabindex="-1" aria-labelledby="newEditSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newEditSubMenuModalLabel">Edit SubMenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master_sub_menu/editSubMenu'); ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" id="idEdit" name="id">
          <div class="form-group">
            <select name="menu_id" id="menuEdit" class="form-control">
              <option value="">Select Menu</option>
              <?php foreach ($menu as $m) : ?>
                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="titleEdit" name="title">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="iconEdit" name="icon">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="urlEdit" name="url">
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