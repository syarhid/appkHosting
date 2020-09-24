        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <h5>Silahkan Pilih Range tanggal</h5>
          <form action="<?= base_url('manajer/reporting_filter') ?>" method="post">
            <div class="form-group row">
              <div class="col-lg-3">
                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal">
              </div>
              <div class="col-lg-1 text-center">
                <h1>-</h1>
              </div>
              <div class="col-lg-3">
                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
              </div>
            </div>
            <div>
              <button class="btn btn-primary" style="margin-bottom: 10px;margin-right: 20px;" id="sort" name="submit" value="filter">Lihat</button>
            </div>
            <div>
              <button class="btn btn-primary" style="margin-bottom: 20px;margin-right: 20px;" id="sort" name="submit" value="all">Lihat Semua Data</button>
            </div>
          </form>

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
            <tbody id="tabel">

              <?php $i = 1; ?>
              <?php foreach ($laporan as $l) : ?>
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

        <script>
          $(document).ready(function() {
            $("#sort").click(function() {
              var awal = $("#tanggal_awal").val(),
                akhir = $("#tanggal_akhir").val();
              var html = "";

              $.ajax({
                type: "POST",
                url: "<?= base_url('manajer/reporting_filter') ?>",
                data: {
                  awal: awal,
                  akhir: akhir,
                },
                success: function(data) {
                  console.log(data);
                  var isi = JSON.parse(data);
                  $("#tabel").html("");
                  isi.forEach(function(data, i) {
                    html += "<tr><th scope='row'>" + i + "</th>";
                    html += "<th>" + data.token + "</th>";
                    html += "<th>" + data.nik + "</th>";
                    html += "<th>" + data.divisi + "</th>";
                    html += "<th>" + data.nama + "</th>";
                    html += "<th>" + data.nama_perangkat + "</th>";
                    html += "<th>" + data.uraian_masalah + "</th>";
                    html += "<th>" + data.status + "</th></tr>";
                    $("#tabel").append(html);
                  });
                }
              })
            });
          })
        </script>

        </div>
        <!-- End of Main Content -->