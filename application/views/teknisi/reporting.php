        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <table class="table table-bordered dataTable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Pemohon</th>
      <th scope="col">Nama Perangkat</th>
      <th scope="col">Uraian Masalah</th>
      <th scope="col">Tanggal Pengajuan</th>
      <th scope="col">Tanggal Penyelesaian</th>
      <th scope="col">Diagnosa</th>
      <th scope="col">Uraian Penyelesaian</th>
      <th scope="col">nama_teknisi</th>
      <th scope="col">Status Perbaikan</th>
    </tr>
  </thead>
  <tbody>

  	<?php $i = 1; ?>
  	<?php foreach($tugas as $t) :?>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?= $t['nama']; ?></td>
      <td><?= $t['nama_perangkat']; ?></td>
      <td><?= $t['uraian_masalah']; ?></td>
      <td><?= $t['tgl_pengajuan']; ?></td>
      <td><?= $t['tgl_penyelesaian']; ?></td>
      <td><?= $t['diagnosa']; ?></td>
      <td><?= $t['uraian_penyelesaian']; ?></td>
      <td><?= $t['nama_teknisi']; ?></td>
      <td><?= $t['status']; ?></td>
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

     
