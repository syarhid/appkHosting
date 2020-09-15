        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <table class="table table-bordered dataTable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Token</th>
      <th scope="col">NIK Pemohon</th>
      <th scope="col">Divisi</th>
      <th scope="col">Nama Pemohon</th>
      <th scope="col">Nama Perangkat</th>
      <th scope="col">Uraian Masalah</th>
      <th scope="col">Status Pengajuan</th>
    </tr>
  </thead>
  <tbody>

  	<?php $i = 1; ?>
  	<?php foreach($laporan as $l) :?>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?= $l['token']; ?></td>
      <td><?= $l['nik']; ?></td>
      <td><?= $l['divisi']; ?></td>
      <td><?= $l['nama']; ?></td>
      <td><?= $l['nama_perangkat']; ?></td>
      <td><?= $l['uraian_masalah']; ?></td>
      <td><?= $l['status']; ?></td>
      <!-- <td>
      <a href="" class="badge badge-pill badge-success">Edit</a>	
      <a href=""class="badge badge-pill badge-danger">Delete</a>
      </td> -->
    </tr>
    <?php $i++; ?>
<?php endforeach; ?>
  </tbody>
</table>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     
