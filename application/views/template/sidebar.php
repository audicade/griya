<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('property'); ?>">
        <div class="sidebar-brand-icon">
          <!-- Icon -->
			<!--<i class="fas fa-laugh-wink"></i>    -->
	        <img src="<?= base_url('./assets/img/griya2.png'); ?>">

        </div>
        <div class="sidebar-brand-text mx-3"></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider ">
		
		<!-- Querry menu -->
		<?php
		$role_id = $this->session->userdata('role_id');
		$queryMenu = " SELECT `user_menu`.`id`, `menu` FROM `user_menu` JOIN `user_access_menu` ON `user_menu`.`id` = `user_access_menu`.`menu_id` WHERE `user_access_menu`.`role_id` = $role_id ORDER BY `user_access_menu`.`menu_id` ASC ";
		
		$menu = $this->db->query($queryMenu)->result_array();
		?>
		
		
		<!-- Looping Menu -->
		<?php foreach ($menu as $m) : ?>
		<!-- <?php if($m['menu'] == 'User') : ?> -->
		<!-- <?php else : ?> -->
      <div class="sidebar-heading">
        <?= $m['menu']; ?>
      </div>
		<!-- <?php endif; ?> -->
		
		
		<!-- Querry subMenu -->
		<?php
		$menuId = $m['id'];
		$querySubMenu = " SELECT * FROM `user_sub_menu` JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id` WHERE `user_sub_menu`.`menu_id` = {$m['id']} AND `user_sub_menu`.`is_active` = 1 ";
		
		$subMenu = $this->db->query($querySubMenu)->result_array();
		?>
			<!-- Looping subMenu -->	
		<?php foreach($subMenu as $sm) : ?>
		<?php if($title == $sm['title']) : ?>
		<li class="nav-item active">
			<?php else : ?>
			<li class="nav-item">
			<?php endif; ?>
        	<a class="nav-link" href="<?= base_url($sm['url']); ?>">
          	<i class="<?= $sm['icon']; ?>"></i>
          	<span><?= $sm['title']; ?></span></a>
      	</li>
		<?php endforeach; ?>

		
		
		
		<?php endforeach; ?>
		<hr class="sidebar-divider">
		


      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->