<div class="container containerfp">

  <h1>Change Password</h1>
  <h6 class="changepass">for <span><?= $this->session->userdata('reset_email') ?></span></h6>
  <form action="<?= base_url('signup/changePassword'); ?>" method="POST">
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text fa fa-envelope" id="basic-addon1"></span>
        </div>
        <input type="password" class="form-control" placeholder="New Password" name="password1"><br>
      </div>
      <?= form_error('password1', ' <small class="text-danger">', '</small>'); ?>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text fa fa-envelope" id="basic-addon1"></span>
        </div>
        <input type="password" class="form-control" placeholder="Confirm New Password" name="password2"><br>
      </div>
      <?= form_error('password2', ' <small class="text-danger">', '</small>'); ?>
    </div>
    <button type="submit" class="btn btn-change">Change Password</button>
  </form>

</div>







<!-- <span>Photo by <a href="https://unsplash.com/@anniespratt?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Annie Spratt</a> on <a href="https://unsplash.com/s/photos/makeup?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a></span> -->
<!-- Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> -->
<!-- Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> -->
<!-- <span>Photo by <a href="https://unsplash.com/@anniespratt?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Annie Spratt</a> on <a href="https://unsplash.com/s/photos/makeup?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a></span> -->