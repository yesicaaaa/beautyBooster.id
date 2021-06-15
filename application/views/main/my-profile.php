<div class="main">
  <h4>My Profile</h4>
  <?= form_error('name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('image', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('current_password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('new_password1', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= form_error('new_password2', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>
  <div class="text-center">
    <img src="<?= base_url('assets/img/user_profile/') . $user['image']; ?>" class="profile-img">
  </div>
  <div class="user-info">
    <h6>Fullname</h6>
    <p><?= $user['name'] ?></p>
    <h6>Email</h6>
    <p><?= $user['email'] ?></p>
    <p><a href="javascript:getData(<?= $user['id'] ?>)" class="badge badge-edit">Edit</a>
      <a href="" data-toggle="modal" data-target="#newChangePasswordModal" class="badge badge-delete">Change Password</a>
    </p>
  </div>
</div>


<!-- Modal Edit User-->
<div class="modal fade" id="newEditUserModal" tabindex="-1" aria-labelledby="newEditUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newEditUserModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master_user/editUser'); ?>" method="POST">
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Change Password User-->
<div class="modal fade" id="newChangePasswordModal" tabindex="-1" aria-labelledby="newChangePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newChangePasswordModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master_user/changePassword'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="new_password1" name="new_password1" placeholder="New Password">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Repeat Password">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Change</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  var BASE_URL = '<?= base_url(); ?>';

  function getData(id) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: BASE_URL + 'master_user/getUserRow',
      data: {
        id: id
      },
      success: function(data) {
        $('#idEdit').val(data.id);
        $('#nameEdit').val(data.name);
        $('#emailEdit').val(data.email);
        $('#imageEdit').val(data.image);
        $('#newEditUserModal').modal();
      }
    });
  }
</script>