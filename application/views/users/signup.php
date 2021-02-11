<div class="container">
  <h1>Create Your Account!</h1>
  <form action="<?= base_url('signup'); ?>" method="POST">
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text fa fa-user" id="basic-addon1"></span>
        </div>
        <input type="text" class="form-control" placeholder="Fullname" name="name" value="<?= set_value('name'); ?>"><br>
      </div>
      <?= form_error('name', ' <small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text fa fa-envelope" id="basic-addon1"></span>
        </div>
        <input type="email" class="form-control" placeholder="Email" name="email" value="<?= set_value('email'); ?>"><br>
      </div>
      <?= form_error('email', ' <small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text fa fa-key" id="basic-addon1"></span>
        </div>
        <input type="password" class="form-control" placeholder="Password" name="password1"><br>
      </div>
      <?= form_error('password1', ' <small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text fa fa-key" id="basic-addon1"></span>
        </div>
        <input type="password" class="form-control" placeholder="Confirm Password" name="password2"><br>
      </div>
    </div>
    <button type="submit" class="btn btn-register">Sign up</button>
  </form>
  <p class="p">Already have an account? <br><span><a href="<?= base_url(); ?>signin">Sign in </a></span>here!</p>
</div>







<!-- <span>Photo by <a href="https://unsplash.com/@anniespratt?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Annie Spratt</a> on <a href="https://unsplash.com/s/photos/makeup?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a></span> -->
<!-- Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> -->
<!-- Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> -->
<!-- <span>Photo by <a href="https://unsplash.com/@anniespratt?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Annie Spratt</a> on <a href="https://unsplash.com/s/photos/makeup?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a></span> -->