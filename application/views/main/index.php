
        <!-- Begin Page Content -->
        <div class="container-fluid">
		
          <!-- Page Heading -->
			<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
			
			<section class="page-section" id="Pasar">
			    <div class="section-title  text-center">
                <h2> PASAR </h2>
	            </div>
	        </section>

	        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

			<div class="row">
				<div class="col-lg-6">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>
			
			<?php
			$queryMarket = " SELECT * FROM `user_property` WHERE `is_active` = 1 ";

			$market = $this->db->query($queryMarket)->result_array();
			?>

			
			<?php foreach ($market as $p ) : ?>

<form class="user" method="post" action="<?= base_url('property/updateIsActive'); ?>">
    <input type="hidden" name="email" value="<?= $p['email']; ?>">	
	<input type="hidden" name="id" value="<?= $p['id']; ?>">		
	<div class="card mb-3" col-lg-8">
		<div class="row no-gutters">
    		<div class="col-md-4">
      		<img src="<?= base_url('assets/img/property/') . $p['image']; ?>" class="card-img" height="240" width="320" >
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
    		</div>
  		</div>
	</div>
</form>					

			<?php endforeach; ?>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <!-- cara Kerja -->
     <section class="page-section" id="Cara-Kerja">	
    <div class="container site-section mb-5">
      <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
          <div class="section-title  text-center">
                <h2>Cara Kerja</h2>
                <!--<span class="title-line"><i class="fa fa-car"></i></span>-->
                
            </div>
          <p>Menyewa ataupun membeli properti di Griya.id sangatlah mudah dengan step sebagai berikut.</p>
        </div>
      </div>
      <div class="how-it-works d-flex">
        <div class="step">
          <span class="number"><span>01</span></span>
          <span class="caption">Buat Akun</span>
        </div>
        <div class="step">
          <span class="number"><span>02</span></span>
          <span class="caption">Verifikasi</span>
        </div>
        <div class="step">
          <span class="number"><span>03</span></span>
          <span class="caption">Upload Properti</span>
        </div>
        <div class="step">
          <span class="number"><span>04</span></span>
          <span class="caption">Pembayaran</span>
        </div>
        <div class="step">
          <span class="number"><span>05</span></span>
          <span class="caption">Selesai</span>
        </div>

      </div>
    </div>
    </section>
    <!-- akhir cara kerja -->