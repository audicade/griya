<div class="container-fluid">
	
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
		<div class="col-lg-8">
					
			<?= form_open_multipart('property/upload'); ?>
			<div class="form-group row">
    			<label for="email" class="col-sm-2 col-form-label">Email</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
    			</div>
  			</div>
			<div class="form-group row">
    			<label for="username" class="col-sm-2 col-form-label">Username</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
    			</div>
  			</div>
			<div class="form-group row">
				<div class="col-sm-2">Foto</div>
				<div class="col-sm-10">
					<div class="row">
						<div class="col-sm-3">
							<img src="<?= base_url('assets/img/property/default.jpg') ?>" class="img-thumbnail">
						</div>
						<div class="col-sm-9">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="image" name="image">
								<label class="custom-file-label" for="image">Pilih berkas</label>
							</div>
						</div>
					</div>
				</div>
  			</div>
			<div class="form-group row">
    			<label for="location" class="col-sm-2 col-form-label">Lokasi</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" id="location" name="location">
					<?= form_error('location', '<small class="text-danger pl-3">', '</small>'); ?>
    			</div>
  			</div>
			<div class="form-group row">
    			<label for="number" class="col-sm-2 col-form-label">Nomor Telp</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" id="number" name="number">
					<?= form_error('number', '<small class="text-danger pl-3">', '</small>'); ?>
    			</div>
  			</div>
			<div class="form-group row">
    			<label for="price" class="col-sm-2 col-form-label">Harga</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" id="price" name="price">
					<?= form_error('location', '<small class="text-danger pl-3">', '</small>'); ?>
    			</div>
  			</div>
			<div class="form-group row">
    			<label for="spec" class="col-sm-2 col-form-label">Spesifikasi</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" id="spec" name="spec">
					<?= form_error('location', '<small class="text-danger pl-3">', '</small>'); ?>
    			</div>
  			</div>
			
			<div class="form-group row justify-content-end">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-primary">Unggah</button>
				</div>	
			</div>
			
			
			</form>
		</div>
     </div>
	
</div>
</div>
      <!-- End of Main Content -->