        <!-- Begin Page Content -->
        <div class="container-fluid">

        	<!-- Page Heading -->
        	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        	<div class="row">
        		<div class="col-lg-8">

        			<?= form_open_multipart('manajer/edit'); ?>
        			<div class="form-group row">
        				<label for="nik" class="col-sm-2 col-form-label">Nomor Induk Karyawan</label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="nik" name="nik" value="<?= $user['nik']; ?>">
        					<?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
        				</div>
        			</div>

        			<div class="form-group row">
        				<label for="divisi" class="col-sm-2 col-form-label">Divisi atau Unit</label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="divisi" name="divisi" value="<?= $user['divisi']; ?>">
        					<?= form_error('divisi', '<small class="text-danger pl-3">', '</small>'); ?>
        				</div>
        			</div>

        			<div class="form-group row">
        				<label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>">
        					<?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
        				</div>
        			</div>

        			<div class="form-group row">
        				<label for="divisi" class="col-sm-2 col-form-label">No Telepon</label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="no_tlp" name="no_tlp" value="<?= $user['no_tlp']; ?>">
        					<?= form_error('no_tlp', '<small class="text-danger pl-3">', '</small>'); ?>
        				</div>
        			</div>

        			<div class="form-group row">
        				<label for="email" class="col-sm-2 col-form-label">Email</label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
        				</div>
        			</div>

        			<div class="form-group row justify-content-end">
        				<div class="col-sm-10">
        					<button type="submit" class="btn btn-primary">Edit Profile</button>
        				</div>
        			</div>

        			</form>
        			<hr>
        			<h1 class="h3 mb-4 text-gray-800">Ganti Password</h1>
        			<?= $this->session->flashdata('message'); ?>
        			<form action="<?= base_url('manajer/changepassword'); ?>" method="post">
        				<div class="form-group row">
        					<label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
        					<div class="col-md-10">
        						<input type="password" class="form-control" id="current_password" name="current_password">
        						<?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
        					</div>
        				</div>

        				<div class="form-group row">
        					<label for="new_password1" class="col-sm-2 col-form-label">New Password</label>
        					<div class="col-md-10">
        						<input type="password" class="form-control" id="new_password1" name="new_password1">
        						<?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
        					</div>
        				</div>

        				<div class="form-group row">
        					<label for="new_password2" class="col-sm-2 col-form-label">Repeat Password</label>
        					<div class="col-md-10">
        						<input type="password" class="form-control" id="new_password2" name="new_password2">
        						<?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
        					</div>
        				</div>

        				<div class="form-group row justify-content-end">
        					<div class="col-md-10">
        						<button type="submit" class="btn btn-primary">Change Password</button>
        					</div>
        				</div>

        			</form>

        		</div>

        	</div>


        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->