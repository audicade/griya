
        <!-- Begin Page Content -->
        <div class="container-fluid">
		
          <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
			
        <nav class="navbar navbar-light bg-light">
		  <a class="navbar-brand">Pencarian</a>
		  <form class="form-inline" method="post" action="<?= base_url('property/cari'); ?>">
		    <input class="form-control mr-sm-2" type="search" placeholder="Cari" aria-label="Search" id="cari" name="cari">
		    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
		  </form>
		</nav>


			<div class="row">
				<div class="col-lg-6">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>
			
			<?php
			$queryMarket = " SELECT * FROM `user_property` WHERE `is_active` = 1 && `location` = '$cari' ";

			$market = $this->db->query($queryMarket)->result_array();
			?>


			
			
			<?php foreach ($market as $p) : ?>
<!-- <form class="property" method="post" action="<?= base_url('property/updateIsActive'); ?>">
    <input type="hidden" name="email" value="<?= $p['email']; ?>">	
	<input type="hidden" name="id" value="<?= $p['id']; ?>"> -->		
	<div class="card mb-3 col-lg-8">
		<div class="row no-gutters">
    		<div class="col-md-4">
      		<img src="<?= base_url('assets/img/property/') . $p['image']; ?>" class="card-img" >
    		</div>
    		<div class="col-md-8">
      			<div class="card-body">
        			<h5 class="card-title"><?= $p['username']; ?></h5>
        			<p class="card-text">Lokasi : <?= $p['location']; ?></p>
					<p class="card-text">Harga : Rp.<?= $p['price']; ?></p>
					<p class="card-text">Nomor Telp : 0<?= $p['number']; ?></p>
					<p class="card-text">Spesifikasi : <?= $p['spec']; ?></p>
        			<p class="card-text">Diunggah sejak <small class="text-muted"><?= date('d F Y', $p['date_created']); ?></small></p>
      			</div>
				<div class="form-group row justify-content-end">
					<div class="col-xs-7 col-sm-10 col-lg-8">
						<button class="btn btn-primary" data-toggle="modal" data-target="#no_<?= $p['id']; ?>">Sewa</button>
						
					</div>	
				</div>
    		</div>
  		</div>
	</div>

	<!-- Modal Pembayaran-->
          <div class="modal fade " id="no_<?= $p['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bolder" id="exampleModalCenterTitle ">Pembayaran</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="Modal-body" method="post" action="<?= base_url('property/updateIsActive'); ?>">
                <input type="hidden" name="email" id="email" value="<?= $p['email']; ?>"> 
                <input type="hidden" name="id" id="id" value="<?= $p['id']; ?>">
                <div class="form-group">
                  <label for="exampleInputEmail1">Id Properti</label>
                  <input type="text" name="id2" class="form-control" id="id2" aria-describedby="emailHelp" value="<?= $p['id']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Pemilik</label>
                  <input type="text" class="form-control" name="pemilik" id="pemilik" value="<?= $p['username']; ?>"readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">No Telp</label>
                  <input type="text" name="no" class="form-control" id="no" aria-describedby="emailHelp" value="<?= $p['number']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Harga</label>
                  <input type="text" name="harga" class="form-control" id="harga" aria-describedby="emailHelp" value="<?= $p['price']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pembayaran</label>
                    <select class="form-control">
                        <option>Pilih mode</option>
                        <option>Tunai</option>
                        <option>Transfer</option>
                    </select>
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                  <label class="form-check-label" for="exampleCheck1">Saya telah menyetujui persyaratan</label>
                </div>
                <button type="submit" class="btn btn-warning btn-block mb-3 tombol font-weight-bolder">Rental</button>
                </form>
                <a href="#lost" type="button" data-toggle="modal" data-target="#modalPersyaratan" data-dismiss="modal">Persyaratan
                  <button type="submit" class="badge badge-pill badge-primary" >Eula</button>
                </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Akhir Modal Pembayaran-->
																
			<?php endforeach; ?>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      




      <!-- Modal Ketentuan-->
      <div class="modal fade " id="modalPersyaratan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg-3 modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bolder" id="exampleModalCenterTitle ">Eula</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h5 class="modal-body">A. Ketentuan Umum</h5>
              <p class="modal-body">1. Dengan menggunakan, berbelanja dan/atau mendaftarkan diri Anda di Griya.id, berarti Anda setuju untuk terikat dan patuh pada syarat dan ketentuan yang berlaku.</p>
              <p class="modal-body">2. Syarat dan ketentuan ini dapat berubah sewaktu-waktu dan kami tidak berkewajiban untuk memberitahukannya kepada Anda.</p>
              <p class="modal-body">3. Syarat dan ketentuan ini kami buat untuk kepentingan bersama, untuk menjaga hak dan kewajiban masing-masing pihak, dan tidak dimaksudkan untuk merugikan salah satu pihak.</p>
              	<a href="#lost" type="button" data-toggle="modal" data-target="#no_<?= $p['id']; ?>" data-dismiss="modal">Kembali ke pembayaran
  				</a>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Akhir Modal Ketentuan-->

<!-- </form> -->
			
																
			
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->