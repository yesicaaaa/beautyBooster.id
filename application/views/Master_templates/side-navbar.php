<!-- Navbar -->
<nav class="navbar sticky-top bg-nav">
  <a class="navbar-brand">beautyBooster.id</a>
  <img src="<?= base_url('assets/img/') . $user['image']; ?>" class="img-circle">
  <!-- <span><?= $user['name']; ?></span> -->
  <!-- <div class="fa fa-caret-down dropdown"></div> -->
  <div class="dropdown">
    <button class="fa fa-caret-down dropdown-user" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
  <h3 class="cat">Management</h3>
  <div class="divider"></div>

  <!-- query menu -->
  <?php
  $queryMenu = "SELECT * FROM `tb_m_menu`
                  ORDER BY `id` ASC";
  $menu = $this->db->query($queryMenu)->result_array();
  ?>

  <!-- looping menu -->
  <?php foreach ($menu as $m) : ?>
    <div class="sidebar-heading">
      <?= $m['menu']; ?>
    </div>
    <hr class="sidebar-divider">
    <!-- siapkan submenu sesuai menu -->
    <?php
    $menuId = $m['id'];
    $querySubMenu = "SELECT * FROM `tb_m_sub_menu`
                        WHERE `tb_m_sub_menu`.`menu_id` = $menuId
                        AND `is_active` = 1
                        ";
    $subMenu = $this->db->query($querySubMenu)->result_array();
    ?>

    <?php foreach ($subMenu as $sm) : ?>
      <?php if ($title == $sm['title']) : ?>
        <ul class="nav nav-pills nav-stacked active">
        <?php else : ?>
          <ul class="nav nav-pills nav-stacked">
          <?php endif; ?>
          <div class="submenu">
            <li><a href="<?= base_url($sm['url']); ?>"><i class="<?= $sm['icon'] ?>"></i>
                <span><?= $sm['title']; ?></span></a></li>
          </div>
          </ul>
        <?php endforeach; ?>

      <?php endforeach; ?>

</div>
<!-- end side nav -->