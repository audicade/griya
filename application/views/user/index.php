
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <form action="<?= base_url('user/editb'); ?>" method="post">
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
			
			<div class="row">
				<div class="col-lg-6">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>
			
			<div class="card mb-3" col-lg-8">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img" >
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $user['username']; ?></h5>
        <p class="card-text"><?= $user['email']; ?></p>
        <p class="card-text">Pengguna Sejak <small class="text-muted"><?= date('d F Y', $user['date_created']); ?></small></p>
        	<div class="form-group">
					<button type="submit" class="btn btn-primary">Edit Profile</button>
				</div>
      </div>
    </div>
  </div>
  </form>
</div>

        
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      
