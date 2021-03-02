
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

			
<form class="user" method="post" action="<?= base_url('admin/IsActive'); ?>">	
	
			
			<div class="row">
				<div class="col-lg-6">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>
		
			<?php
			$queryMember = " SELECT * FROM `user` WHERE `is_active` = 1 ";

			$member = $this->db->query($queryMember)->result_array();
			?>
			
			<?php foreach ($member as $row) :?>


			<div class="card mb-3" col-lg-8">
				<input type="hidden" name="id" value="<?= $row['id']; ?>">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="<?= base_url('assets/img/profile/') . $row['image']; ?>" class="card-img" >
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $row['username']; ?></h5>
        <p class="card-text"><?= $row['email']; ?></p>
        <p class="card-text">Pengguna Sejak <small class="text-muted"><?= date('d F Y', $row['date_created']); ?></small></p>

        <div class="form-group row justify-content-end">
			<div class="col-xs-7 col-sm-10 col-lg-8">
				<button type="submit" class="btn btn-primary">Cekal Akun</button>

			</div>	
		</div>

      </div>
    </div>
  </div>
</div>
</form>	
			<?php endforeach; ?>
        
        <!-- /.container-fluid -->

      </div>