<div class="main">
  <h4>User Management</h4>
  <!-- <div class="row">
    <div class="col-md-4">
      <form action="<?= base_url('master_user/usersShow') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search Username..." name="keyword" autocomplete="off" autofocus>
          <div class="input-group-append">
            <input class="btn btn-info" type="submit" name="submit">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <a href="<?= base_url(); ?>master_user/refresh"><img src="<?= base_url(); ?>assets/img/refresh.png"></a>
    </div>
  </div> -->
  <div class="row">
    <div style="width: 79%;">
      <?= form_error('name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('image', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('role_id', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('is_active', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= $this->session->flashdata('message'); ?>
      <!-- <b><a href="" class="btn btn-menu" data-toggle="modal" data-target="#newUserModal">Add New User</a></b> -->
      <!-- <h6>Results: <?= $total_rows; ?></h6> -->
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Image</th>
            <th scope="col">Role Id</th>
            <th scope="col">Is Active</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($userdata)) : ?>
            <tr>
              <td colspan="6">
                <div class="alert alert-danger" role="alert">
                  Data not found!
                </div>
              </td>
            </tr>
          <?php endif; ?>
          <?php $i = 1; ?>
          <?php foreach ($userdata as $ud) : ?>
            <tr>
              <th scope="row"><?= $i; ?></th>
              <td><?= $ud['name']; ?></td>
              <td><?= $ud['email']; ?></td>
              <td><?= $ud['image']; ?></td>
              <td><?= $ud['role_id']; ?></td>
              <td><?= $ud['is_active']; ?></td>
              <td>
                <a href="javascript:getData(<?= $ud['id'] ?>);" class="badge badge-edit">Edit</a>
                <a href="<?= base_url(); ?>master_user/deleteUser/<?= $ud['id']; ?>" class="badge badge-delete" onclick="return confirm('Are You Sure?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <!-- <?= $this->pagination->create_links(); ?> -->
    </div>
  </div>
</div>


<!-- Modal New Menu
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newUserModalLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master_user/addUser'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="Fullname">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="image" name="image" placeholder="Image">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div> -->


<!-- Modal Edit Menu-->
<div class="modal fade" id="newEditUserModal" tabindex="-1" aria-labelledby="newEditUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newEditUserModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master_user/editUserByAdmin'); ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" id="idEdit" name="id">
          <div class="form-group">
            <input type="text" class="form-control" id="nameEdit" name="name">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="emailEdit" name="email">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="imageEdit" name="image">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="role_idEdit" name="role_id">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="is_activeEdit" name="is_active">
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

  function getData(id) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: BASE_URL + 'master_user/getUserRowByAdmin',
      data: {
        id: id
      },
      success: function(data) {
        $('#idEdit').val(data.id),
          $('#nameEdit').val(data.name),
          $('#emailEdit').val(data.email),
          $('#imageEdit').val(data.image),
          $('#role_idEdit').val(data.role_id),
          $('#is_activeEdit').val(data.is_active),
          $('#newEditUserModal').modal()
      }
    });
  }
</script>