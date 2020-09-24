        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
            <div class="col-lg-6">
              <?php if (validation_errors()) :  ?>
                <div class="alert alert-danger" role="alert">
                  <?= validation_errors(); ?>
                </div>
              <?php endif; ?>

              <?= $this->session->flashdata('message'); ?>

              <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newDaftarModal">Add New User</a>

            </div>
            <div class="col-lg-12">
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
                  <?php foreach ($daftar as $d) : ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td><?= $d['nik']; ?></td>
                      <td><?= $d['divisi']; ?></td>
                      <td><?= $d['nama']; ?></td>
                      <td><?= $d['no_tlp']; ?></td>
                      <td><?= $d['email']; ?></td>
                      <td><?= $d['role_id']; ?></td>
                      <td><?= $d['is_active']; ?></td>
                      <td>
                        <a href="<?= $d['nik']; ?>" class="btn btn-success edit" data-toggle="modal" data-target="#exampleModal" data-nik="<?= $d['nik']; ?>" data-divisi="<?= $d['divisi']; ?>" data-nama="<?= $d['nama']; ?>" data-no_tlp="<?= $d['no_tlp']; ?>" data-email="<?= $d['email']; ?>" data-role="<?= $d['role_id']; ?>" data-active="<?= $d['is_active']; ?>">Edit</a>
                        <a href="<?= base_url('admin/delete_user/') . $d['nik'] ?>" class="btn btn-danger">Hapus</a>
                      </td>
                    </tr>
                    <?php $i++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
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
                    <input type="text" max="20" class="form-control" id="nik" name="nik" placeholder="Nomor Induk Karyawan" required>
                  </div>

                  <div class="form-group">
                    <input type="text" max="25" class="form-control" id="divisi" name="divisi" placeholder="Divisi Atau Unit" required>
                  </div>


                  <div class="form-group">
                    <input type="text" max="45" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                  </div>

                  <div class="form-group">
                    <input type="email" max="30" class="form-control" id="email" name="email" placeholder="Email Pengguna" required>
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                  </div>

                  <div class="form-group">
                    <select name="role_id" id="role_id" class="form-control" required>
                      <option value="">Select Role</option>
                      <option value="1">Admin</option>
                      <option value="2">Karyawan</option>
                      <option value="3">Manager IT</option>
                      <option value="4">Teknisi IT</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <select name="is_active" id="is_active" class="form-control" required>
                      <option value="">Select Status</option>
                      <option value="1">Aktif</option>
                      <option value="2">Tidak Aktif</option>
                    </select>
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
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?= base_url('admin/edit_user'); ?>" method="post">
                  <div class="form-group">
                    <input type="text" max="20" class="form-control" id="nik1" name="nik1" placeholder="Nomor Induk Karyawan" required>
                    <input type="hidden" max="20" class="form-control" id="nik_lama" name="nik_lama" placeholder="Nomor Induk Karyawan" required>
                  </div>

                  <div class="form-group">
                    <input type="text" max="25" class="form-control" id="divisi1" name="divisi1" placeholder="Divisi Atau Unit" required>
                  </div>


                  <div class="form-group">
                    <input type="text" max="45" class="form-control" id="nama1" name="nama1" placeholder="Nama Lengkap" required>
                  </div>

                  <div class="form-group">
                    <input type="email" max="30" class="form-control" id="email1" name="email1" placeholder="Email Pengguna" required>
                  </div>

                  <div class="form-group">
                    <select name="role_id1" id="role_id1" class="form-control" required>
                      <option value="">Select Role</option>
                      <option value="1">Admin</option>
                      <option value="2">Karyawan</option>
                      <option value="3">Manager IT</option>
                      <option value="4">Teknisi IT</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <select name="is_active1" id="is_active1" class="form-control" required>
                      <option value="">Select Status</option>
                      <option value="1">Aktif</option>
                      <option value="2">Tidak Aktif</option>
                    </select>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit User</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <script>
          $(document).ready(function() {
            $(".edit").click(function() {
              var nik = $(this).attr("data-nik");
              var divisi = $(this).attr("data-divisi");
              var nama = $(this).attr("data-nama");
              var no_tlp = $(this).attr("data-no_tlp");
              var email = $(this).attr("data-email");
              var role = $(this).attr("data-role");
              var active = $(this).attr("data-active");

              $("#nik1").val(nik);
              $("#nik_lama").val(nik);
              $("#divisi1").val(divisi);
              $("#nama1").val(nama);
              $("#no_tlp1").val(no_tlp);
              $("#email1").val(email);
              $("#role_id1").val(role);
              $("#is_active1").val(active);
            });
          });
        </script>
        </div>