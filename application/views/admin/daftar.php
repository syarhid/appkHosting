        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
          	<div class="col-lg-6">
          		<?php if(validation_errors()) :  ?>
                <div class="alert alert-danger" role="alert">
                  <?= validation_errors(); ?>
                </div>
              <?php endif; ?>

          		<?= $this->session->flashdata('message'); ?>

          		<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newDaftarModal">Add New User</a>


          		<table class="table table-bordered dataTable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIK</th>
      <th scope="col">Divisi</th>
      <th scope="col">Nama Lengkap</th>
      <th scope="col">No Telepon</th>
      <th scope="col">Email</th>
      <th scope="col">Daftar Sebagai</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
<tbody>

  	<?php $i = 1; ?>
  	<?php foreach($daftar as $d) :?>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?= $d['nik']; ?></td>
      <td><?= $d['divisi']; ?></td>
      <td><?= $d['nama']; ?></td>
      <td><?= $d['no_tlp']; ?></td>
      <td><?= $d['email']; ?></td>
      <td><?= $d['role_id']; ?></td>
      <td><?= $d['is_active']; ?></td>
      <td width=>
      <a href="" class="btn btn-success" style="margin-bottom: 10px;">Edit</a>	
      <a href=""class="btn btn-danger">Hapus</a>
      </td>
    </tr>
    <?php $i++; ?>
<?php endforeach; ?>
  </tbody>
</table>

          	</div>


          </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newDaftarModal" tabindex="-1" aria-labelledby="newDaftarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newDaftarModalLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/daftar'); ?>" method="post">
      <div class="modal-body">

        <div class="form-group">
    <input type="text" class="form-control" id="nik" name="nik" placeholder="Nomor Induk Karyawan">
  </div>

<div class="form-group">
    <input type="text" class="form-control" id="divisi" name="divisi" placeholder="Divisi Atau Unit">
  </div>


      <div class="form-group">
    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
  </div>

  <div class="form-group">
    <input type="text" class="form-control" id="email" name="email" placeholder="Email Pengguna">
  </div>

  <div class="form-group">
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>

  <div class="form-group">
    <input type="text" class="form-control" id="role_id" name="role_id" placeholder="Role Id (isikan angka)">
    1.admin
    2.karyawan
    3.manajer IT
    4.teknisi IT
  </div>

  <div class="form-group">
    <input type="text" class="form-control" id="is_active" name="is_active" placeholder="Status (isikan angka)">
    1.aktif
    2.tidak aktif
  </div>

  <div class="form-group">
    <div class="form-check">
<!--   <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
  <label class="form-check-label" for="is_active">
    Active?
  </label> -->
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add User</button>
      </div>
  </form>
    </div>
  </div>
</div>
</div>

     
