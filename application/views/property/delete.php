<div class="container-fluid">
	
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
	    <?= $this->session->flashdata('message'); ?>
		<div class="col-lg-8">
			<?= form_open_multipart('property/delete'); ?>
			<?php
			$email = $this->session->userdata('email');
			$queryMarket = " SELECT * FROM `user_property` WHERE `email` = '$email' ";

			$market = $this->db->query($queryMarket)->result_array();
			?>
			
			<div class="input-group mb-3">
			  <div class="input-group-prepend">
				<label class="input-group-text" for="pilihan">Opsi</label>
			  </div>
			  <select class="custom-select" id="pilihan" name="pilihan">
				<option selected>Pilih Properti...</option>
				<?= form_error('pilihan', '<small class="text-danger pl-3">', '</small>'); ?>
			<?php foreach ($market as $p) : ?>
				<option value="<?=$p['id'];?>"><?= $p['image']; ?></option>
			<?php endforeach; ?>
			  </select>
				
			</div>
			<div class="form-group row">
    			<label for="id" class="col-sm-2 col-form-label">id</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" id="id" name="id" readonly>
    			</div>
  			</div>
			<div class="form-group row">
				<div class="col-sm-2">Gambar</div>
				<div class="col-sm-10">
					<div class="row">
						<div class="col-sm-3">
							<img src="<?= base_url('assets/img/property/default.jpg'); ?>" id="img" class="img-thumbnail">
						</div>

					</div>
				</div>
  			</div>
			
			<div class="form-group row justify-content-end">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-primary">Hapus</button>
				</div>	
			</div>
			
			
			</form>
			
			<form action="<?= base_url('property/back') ?>" method="post">
	            <div class="form-group row justify-content-end">
				    <div class="col-xs-10">
					    <button type="submit" class="btn btn-primary">Kembali</button>
				    </div>	
			    </div>
			</form>
			
			
		</div>
     </div>
	
</div>
</div>
      <!-- End of Main Content -->