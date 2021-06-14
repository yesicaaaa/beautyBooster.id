<!-- Navbar -->
<nav class="navbar sticky-top bg-nav">
  <a class="navbar-brand">beautyBooster.id</a>
  <div class="searchbar">
    <form>
      <!-- <input class="form-search" placeholder="Search">
      <a class="search fa fa-fw fa-search"></a> -->
      <a href="<?= base_url('main/cart') ?>">
        <li class="cart fa fa-opencart"></li>
      </a>
    </form>
  </div>
  <img src="<?= base_url(); ?>assets/img/user_profile/<?= $this->session->userdata('image'); ?>" class="img-circle">
      <button class="fa fa-caret-down btn-user" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class=""></div>
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item fa fa-fw fa-user" href="<?= base_url(); ?>master_user"><span class="item-desc"> My Profile</span></a>
        <div class="user-divider"></div>
        <a class="dropdown-item fa fa-fw fa-caret-right" href="<?= base_url(); ?>master_user/signout"><span class="item-desc">Sign Out</span></a>
      </div>
    </div>
</nav>
<!-- end navbar -->
<!-- side nav -->
<div class="sidenav">
  <h3 class="cat">Categories</h3>
  <div class="divider"></div>

    <div class="dropdown">
      <a class="dropbtn">Body Care<span class="fa fa-angle-down"></span></a>
      <div class="dropdown-content">
          <a href="<?= base_url('/main/products/2') ?>">Body Lotion</a>
      </div>
    </div>
</div>
<!-- end side nav -->