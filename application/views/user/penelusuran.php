        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
          	
          	<div class="col-lg-6">
          		<div class="col-lg-8">
              	<?= $this->session->flashdata('message'); ?>
            	</div>

          		<form action="<?= base_url('user/hasil_penelusuran');?>" method="post">
          			 	<div class="form-group">
    					<label for="token ">Masukan Token</label>
   						<input type="text" class="form-control" id="token" name="token">
   						 <?= form_error('token','<small class="text-danger pl-3">','</small>'); ?>
  						</div>

  						<div class="form-group">
  							<button type="submit" class="btn btn-primary">Cari Token</button>
  						</div>
          		</form>
          	</div>
			  <div class="col-lg-12">
			  	<div class="col-lg-6">
				  <table>
				  <tbody>
				  </tbody>
				  </table>
				  </div>
			  </div>
          </div>
		</div>
	</div>
        <!-- /.container-fluid -->
