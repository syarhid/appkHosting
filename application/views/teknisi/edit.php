        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
          	<div class="col-lg-8">
          		
          		<?= form_open_multipart('teknisi/edit'); ?>
          			<div class="form-group row">
          				<label for="nik" class="col-sm-2 col-form-label">Nomor Induk Karyawan</label>
          				<div class="col-sm-10">
          					<input type="text" class="form-control" id="nik" name="nik" value="<?= $user['nik'];?>">
          					<?= form_error('nik','<small class="text-danger pl-3">','</small>');?>
          				</div>
          			</div>

          			<div class="form-group row">
          				<label for="divisi" class="col-sm-2 col-form-label">Divisi atau Unit</label>
          				<div class="col-sm-10">
          					<input type="text" class="form-control" id="divisi" name="divisi" value="<?= $user['divisi'];?>">
          					<?= form_error('divisi','<small class="text-danger pl-3">','</small>');?>
          				</div>
          			</div>

          			<div class="form-group row">
          				<label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
          				<div class="col-sm-10">
          					<input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'];?>">
          					<?= form_error('nama','<small class="text-danger pl-3">','</small>');?>
          				</div>
          			</div>

          			<div class="form-group row">
          				<label for="divisi" class="col-sm-2 col-form-label">No Telepon</label>
          				<div class="col-sm-10">
          					<input type="text" class="form-control" id="no_tlp" name="no_tlp" value="<?= $user['no_tlp'];?>" >
          					<?= form_error('no_tlp','<small class="text-danger pl-3">','</small>');?>
          				</div>
          			</div>

          			<div class="form-group row">
          				<label for="email" class="col-sm-2 col-form-label">Email</label>
          				<div class="col-sm-10">
          					<input type="text" class="form-control" id="email" name="email" value="<?= $user['email'];?>" readonly>
          				</div>
          			</div>

          			<div class="form-group row justify-content-end">
          				<div class="col-sm-10">
          					<button type= "submit" class="btn btn-primary">Edit Profile</button>
          				</div>
          			</div>

          		</form>


          	</div>

          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     
