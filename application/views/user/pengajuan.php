        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
          	<div class="col-lg-12">
          		<?php if(validation_errors()) :  ?>
                <div class="alert alert-danger" role="alert">
                  <?= validation_errors(); ?>
                </div>
              <?php endif; ?>

          		<?= $this->session->flashdata('message'); ?>

          		<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPengajuanModal" id="tombol">Ajukan Perbaikan</a>


          		<table class="table table-bordered dataTable" id="table1" width="100%">
  <thead>
    <tr>
      <th>#</th>
      <th>Token</th>
      <th>NIK</th>
      <th>Divisi</th>
      <th>Nama Lengkap</th>
      <th>No Telepon</th>
      <th>Email</th>
      <th>Nama Perangkat</th>
      <th>Uraian Masalah</th>
      <th>Tanggal Pengajuan</th>
    </tr>
  </thead>
<tbody>

  	<?php $i = 1; ?>
  	<?php foreach($pengajuan as $p) :?>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?= $p['token']; ?></td>
      <td><?= $p['nik']; ?></td>
      <td><?= $p['divisi']; ?></td>
      <td><?= $p['nama']; ?></td>
      <td><?= $p['no_tlp']; ?></td>
      <td><?= $p['email']; ?></td>
      <td><?= $p['nama_perangkat']; ?></td>
      <td><?= $p['uraian_masalah']; ?></td>
      <td><?= $p['tgl_pengajuan']; ?></td>

<!--       <td>
      <a href="" class="badge badge-pill badge-success">Edit</a>	
      <a href=""class="badge badge-pill badge-danger">Delete</a>
      </td> -->
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
<div class="modal fade" id="newPengajuanModal" tabindex="-1" aria-labelledby="newPengajuanModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newPengajuanModalLabel">Ajukan Perbaikan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('user/pengajuan'); ?>" method="post">
      <div class="modal-body">



        <div class="form-group">
        	<p class="mb-2">Token</p>
    <input type="text" class="form-control" id="token" name="token" readonly="readonly" value="<?php 
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz'; 
    echo substr(str_shuffle($permitted_chars), 0, 10);  ?>" required>
  </div>

<div class="form-group">
	<p class="mb-2">Nomor Induk Karyawan</p>
    <input type="text" class="form-control" id="nik" name="nik" value="<?= $user['nik'];?>"readonly>
  </div>


      <div class="form-group">
      	<p class="mb-2">Nama</p>
    <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'];?>"readonly>
  </div>

  <div class="form-group">
      	<p class="mb-2">No Telepon</p>
    <input type="text" class="form-control" id="no_tlp" name="no_tlp" value="<?= $user['no_tlp'];?>"readonly>
  </div>

  <div class="form-group">
      	<p class="mb-2">Divisi</p>
    <input type="text" class="form-control" id="divisi" name="divisi" value="<?= $user['divisi'];?>"readonly>
  </div>

  <div class="form-group">
  	<p class="mb-2">Email Pengirim</p>
    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'];?>"readonly>
  </div>

  <div class="form-group">
  	<p class="mb-2">Nama Perangkat</p>
    <input type="text" class="form-control" id="nama_perangkat" name="nama_perangkat">
  </div>

  <div class="form-group">
  	<p class="mb-2">Uraian Masalah</p>
    <textarea type="text" class="form-control" id="uraian_masalah" name="uraian_masalah"> </textarea>
  </div>

  <div class="form-group">
  	<p class="mb-2">Tanggal Pengajuan</p>
    <input type="text" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan" value="<?= date("Y/m/d");?>" readonly>
  </div>

  <div class="form-group">
  	<p class="mb-2">Status Perbaikan</p>
    <input type="text" class="form-control" id="status" name="status" value="pengajuan" readonly>
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
        <button type="submit" class="btn btn-primary">Tambah Pengajuan</button>
      </div>
  </form>
    </div>
  </div>
</div>
</div>

<script>
	$(document).ready(function(){
    if(document.querySelectorAll('#table1 tbody tr').length === 1){
    $("#tombol").addClass('disabled');
  } else {
    console.log(document.querySelectorAll("#table1 tbody tr").length);
  }
  })
</script>

     
