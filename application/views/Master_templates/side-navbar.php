<!-- Navbar -->
<nav class="navbar bg-nav">
  <a class="navbar-brand">beautyBooster.id</a>
  <img src="<?= base_url('assets/img/') . $user['image']; ?>" class="img-circle">
  <div class="fa fa-caret-down "></div>
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