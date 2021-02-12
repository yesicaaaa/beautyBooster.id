<!-- Navbar -->
<nav class="navbar bg-nav">
  <a class="navbar-brand">beautyBooster.id</a>
  <div class="searchbar">
    <form>
      <!-- <input class="form-search" placeholder="Search">
      <a class="search fa fa-fw fa-search"></a> -->
      <a href=""><li class="cart fa fa-opencart"></li></a>
    </form>
  </div>
  <img src="<?= base_url(); ?>assets/img/default.jpg" class="img-circle">
  <div class="fa fa-caret-down "></div>
</nav>
<!-- end navbar -->
<!-- side nav -->
<div class="sidenav">
  <h3 class="cat">Categories</h3>
  <div class="divider"></div>

  <!-- query menu -->
  <?php 
    $queryMenu = "SELECT * FROM `menu_categories`
                  ORDER BY `id` ASC";
    $menu = $this->db->query($queryMenu)->result_array();
  ?>

  <!-- looping menu -->
  <?php foreach($menu as $m) : ?>
    <div class="dropdown">
      <a class="dropbtn"><?= $m['menu']; ?> <span class="fa fa-angle-down"></span></a>

    <?php 
      $menuId = $m['id'];
      $querySubMenu = "SELECT * FROM `menu_sub_categories`
                      WHERE `menu_sub_categories`.`menu_id` = $menuId
                      AND `is_active` = 1";
      $subMenu = $this->db->query($querySubMenu)->result_array();
    ?>

    <?php foreach($subMenu as $sm) : ?>
      <div class="dropdown-content">
        <a href="<?= $sm['url'] ?>"><?= $sm['title'] ?></a>
      </div>
    <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
</div>
<!-- end side nav -->