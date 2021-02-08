<div class="container">

  <h1>Sign in</h1>
  <?= $this->session->flashdata('message'); ?>
  <form action="<?= base_url('signin'); ?>" method="POST">
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
        <input type="password" class="form-control" placeholder="Password" name="password"><br>
      </div>
      <?= form_error('password1', ' <small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <button type="submit" class="btn">Sign in</button>
  </form>
  <!-- <a id="pass" href="<?= base_url(); ?>">Forgot password?</a> -->
  <p>Don't have an account yet? <br><span><a href="<?= base_url(); ?>register">Register </a></span>here!</p>

</div>







<!-- <span>Photo by <a href="https://unsplash.com/@anniespratt?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Annie Spratt</a> on <a href="https://unsplash.com/s/photos/makeup?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a></span> -->
<!-- Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> -->
<!-- Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> -->
<!-- <span>Photo by <a href="https://unsplash.com/@anniespratt?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Annie Spratt</a> on <a href="https://unsplash.com/s/photos/makeup?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a></span> -->