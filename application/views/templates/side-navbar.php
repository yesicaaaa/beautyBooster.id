<!-- Navbar -->
<nav class="navbar sticky-top bg-nav">
  <a class="navbar-brand">beautyBooster.id</a>
  <div class="searchbar">
    <form>
      <!-- <input class="form-search" placeholder="Search">
      <a class="search fa fa-fw fa-search"></a> -->
      <a href=""><li class="cart fa fa-opencart"></li></a>
    </form>
  </div>
  <img src="<?= base_url(); ?>assets/img/<?= $user['image']; ?>" class="img-circle">
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
                  ORDER BY `category` ASC";
    $menu = $this->db->query($queryMenu)->result_array();
  ?>

  <!-- looping menu -->
  <?php foreach($menu as $m) : ?>
    <div class="dropdown">
      <a class="dropbtn"><?= $m['category']; ?> <span class="fa fa-angle-down"></span></a>

    <?php 
      $menuId = $m['id'];
      $querySubMenu = "SELECT * FROM `menu_sub_categories`
                      WHERE `menu_sub_categories`.`menu_id` = $menuId
                      AND `is_active` = 1
                      ORDER BY  `title` ASC";
      $subMenu = $this->db->query($querySubMenu)->result_array();
    ?>
      <div class="dropdown-content">
        <?php foreach($subMenu as $sm) : ?>
          <a href="<?= $sm['url'] ?>"><?= $sm['title'] ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<!-- end side nav -->