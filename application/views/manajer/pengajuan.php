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

          		<!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPengajuanModal" id="tombol">Ajukan Perbaikan</a> -->


          		<table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Token</th>
      <th scope="col">NIK</th>
      <th scope="col">Divisi</th>
      <th scope="col">Nama Lengkap</th>
      <th scope="col">Nama Perangkat</th>
      <th scope="col">Uraian Masalah</th>
      <th scope="col">Tanggal Pengajuan</th>
      <th scope="col">Aksi</th>
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
      <td><?= $p['nama_perangkat']; ?></td>
      <td><?= $p['uraian_masalah']; ?></td>
      <td><?= $p['tgl_pengajuan']; ?></td>
      <td width="10%">
          <a href="<?= base_url('manajer/approve/') . $p['token']?>" class="btn btn-success"><i class="fas fa-check"></i></a>	
         <a href="<?= base_url('manajer/ditolak/') . $p['token']?>" class="btn btn-danger"><i class="fas fa-times"></i></a>
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

<!-- <script>
	$(document).ready(function(){
    if(document.querySelectorAll('#table1 tbody tr').length === 1){
    $("#tombol").addClass('disabled');
  } else {
    console.log(document.querySelectorAll("#table1 tbody tr").length);
  }
  })
</script> -->

     
