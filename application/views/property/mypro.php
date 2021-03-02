
        <!-- Begin Page Content -->
        <div class="container-fluid">
		
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
			
			<a class="btn btn-success font-weight-bolder tombol "  type="button" href="<?= site_url('property/editpro')?>">Ubah Properti</a>
            
            <a class="btn btn-success font-weight-bolder tombol "  type="button" href="<?= site_url('property/delete')?>">Hapus Properti</a>
			
			<h1 class="h3 mb-4 text-gray-800"><?= $spasi; ?></h1>
			
			<div class="row">
				<div class="col-lg-6">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>
			
			


			<?php
			
			$id = $this->session->userdata('id');
			$email = $this->session->userdata('email');
			$queryMarket = " SELECT * FROM `user_property` WHERE `property_id` = '$id' AND `is_active` = 0
 ";
 			$Id = $this->session->userdata('id');
			$market = $this->db->query($queryMarket)->result_array();
			?>
			
			<?php foreach ($market as $row) :?>
			
			
<!-- <form class="property" method="post" action="<?= base_url('property/updateIs'); ?>">	
	<input type="hidden" name="id" value="<?= $row['id']; ?>"> -->					
			
<div class="card mb-3 col-lg-8">
	<div class="row no-gutters">
    	<div class="col-md-4">
      	<img src="<?= base_url('assets/img/property/') . $row['image']; ?>" class="card-img" >
    	</div>
    	<div class="col-md-8">
      		<div class="card-body">
        		<h5 class="card-title"><?= $row['username']; ?></h5>
        		<p class="card-text">Lokasi : <?= $row['location']; ?></p>
				<p class="card-text">Harga : Rp.<?= $row['price']; ?></p>
				<p class="card-text">Nomor Telp : 0<?= $row['number']; ?></p>
				<p class="card-text">Spesifikasi : <?= $row['spec']; ?></p>
        		<p class="card-text">Diunggah sejak <small class="text-muted"><?= date('d F Y', $row['date_created']); ?></small></p>
      		</div>
			<div class="form-group row justify-content-end">
				<div class="col-xs-7 col-sm-10 col-lg-8">
					<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#logoutModal">Tinggalkan</button>

				</div>	
			</div>
    	</div>
  	</div>
</div>

<!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tinggalkan Properti?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda yakin meninggalkan properti ini ?</div>
        <form class="property" method="post" action="<?= base_url('property/updateIs'); ?>">	
        <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <!-- <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Yakin</a> -->
          <button class="btn btn-primary" type="submit">Yakin</button>
        </div>
      </div>
    </div>
  </div>

</form>					
				<?php endforeach; ?>

        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->