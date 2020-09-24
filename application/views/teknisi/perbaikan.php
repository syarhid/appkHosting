        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
            <div class="col-lg-12">
              <?php if (validation_errors()) :  ?>
                <div class="alert alert-danger" role="alert">
                  <?= validation_errors(); ?>
                </div>
              <?php endif; ?>

              <?= $this->session->flashdata('message'); ?>

              <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPengajuanModal" id="tombol">Ajukan Perbaikan</a> -->


              <table class="table table-bordered dataTable" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Token</th>
                    <th>NIK</th>
                    <th>Divisi</th>
                    <th>Nama Lengkap</th>
                    <th>Nama Perangkat</th>
                    <th>Uraian Masalah</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php $i = 1; ?>
                  <?php foreach ($perbaikan as $p) : ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td><?= $p['token']; ?></td>
                      <td><?= $p['nik']; ?></td>
                      <td><?= $p['divisi']; ?></td>
                      <td><?= $p['nama']; ?></td>
                      <td><?= $p['nama_perangkat']; ?></td>
                      <td><?= $p['uraian_masalah']; ?></td>
                      <td><?= $p['tgl_pengajuan']; ?></td>
                      <td>
                        <?php if ($p['status'] == "Dikerjakan") {
                          if ($user['nama'] === $p['nama_teknisi']) {
                            echo "<a id='perbaikan' href='" . base_url('teknisi/approve/') . $p['token'] . "' data-token='" . $p['token'] . "' data-toggle='modal' data-target='#newDiagnosa' class='btn btn-warning'>Diagnosa Akhir</a>";
                          } else {
                          }
                        } else {
                          echo "<a href='" . base_url('teknisi/approve/') . $p['token'] . "' class='btn btn-success'>Ambil Tugas</a>";
                        }
                        ?>
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
        <div class="modal fade" id="newDiagnosa" tabindex="-1" aria-labelledby="newPengajuanModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newPengajuanModalLabel">Ajukan Perbaikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?= base_url('teknisi/diagnosa'); ?>" method="post">
                <div class="modal-body">
                  <div class="col-lg-12">
                    <div class="form-group col-lg-12">
                      <input type="hidden" id="token_diagnosa" name="token_diagnosa">
                      <p class="mb-2">Tanggal Penyelesaian</p>
                      <input type="text" class="form-control" id="tgl_penyelesaian" name="tgl_penyelesaian" value="<?= date("Y/m/d"); ?>" readonly>
                    </div>
                    <div class="form-group col-lg-12">
                      <p class="mb-2">Diagnosa</p>
                      <textarea type="text" class="form-control" id="diagnosa" name="diagnosa" require> </textarea>
                    </div>

                    <div class="form-group col-lg-12">
                      <p class="mb-2">Uraian Penyelesaian</p>
                      <textarea type="text" class="form-control" id="uraian_penyelesaian" name="uraian_penyelesaian" require> </textarea>
                    </div>

                    <div class="form-group col-lg-12">
                      <p class="mb-2">Nama Teknisi</p>
                      <input type="text" class="form-control" id="nama_divisi" name="nama_divisi" value="<?= $user['nama']; ?>" readonly>
                    </div>

                    <div class="form-group col-lg-12">
                      <p class="mb-2">NIK Teknisi</p>
                      <input type="text" class="form-control" id="nik_teknisi" name="nik_teknisi" value="<?= $user['nik']; ?>" readonly>
                    </div>


                    <div class="form-group col-lg-12">
                      <p class="mb-2">Status Perbaikan</p>
                      <input type="text" class="form-control" id="status" name="status" value="Selesai" readonly>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tutup Tugas</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
        </div>