        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
            <div class="col-lg">
              <?php if (validation_errors()) :  ?>
                <div class="alert alert-danger" role="alert">
                  <?= validation_errors(); ?>
                </div>
              <?php endif; ?>

              <?= $this->session->flashdata('message'); ?>

              <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Sub-Menu</a>


              <table class="table table-bordered dataTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Url</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Active</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($subMenu as $sm) : ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td><?= $sm['title']; ?></td>
                      <td><?= $sm['menu']; ?></td>
                      <td><?= $sm['url']; ?></td>
                      <td><?= $sm['icon']; ?></td>
                      <td><?= $sm['is_active']; ?></td>
                      <td>
                        <a href="" class="btn btn-success edit" data-toggle="modal" data-target="#newEditModal" data-title="<?= $sm['title']; ?>" data-menu="<?= $sm['menu']; ?>" data-url="<?= $sm['url']; ?>" data-icon="<?= $sm['icon']; ?>" data-is_active="<?= $sm['is_active']; ?>">Edit</a>
                        <a href="<?= base_url('menu/delete_submenu/') . $sm['title'] ?>" class="btn btn-danger">Delete</a>
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
        <!-- Modal -->
        <div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">

                  <div class="form-group">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu Title">
                  </div>
                  <div class="form-group">
                    <select name="menu_id" id="menu_id" class="form-control">
                      <option value="">Select Menu</option>
                      <?php foreach ($menu as $m) : ?>
                        <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                      <?php endforeach; ?>
                    </select>

                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu url">
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu icon">
                  </div>

                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                      <label class="form-check-label" for="is_active">
                        Active?
                      </label>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
        </div>

        <div class="modal fade" id="newEditModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?= base_url('menu/edit_submenu'); ?>" method="post">
                <div class="modal-body">

                  <div class="form-group">
                    <input type="text" class="form-control" id="title1" name="title1" placeholder="Sub Menu Title">
                    <input type="hidden" class="form-control" id="title11" name="title11" placeholder="Sub Menu Title">
                  </div>
                  <div class="form-group">
                    <select name="menu_id1" id="menu_id1" class="form-control">
                      <option value="">Select Menu</option>
                      <?php foreach ($menu as $m) : ?>
                        <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                      <?php endforeach; ?>
                    </select>

                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="url1" name="url1" placeholder="Sub Menu url">
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" id="icon1" name="icon1" placeholder="Sub Menu icon">
                  </div>

                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" name="is_active1" id="is_active1" checked>
                      <label class="form-check-label" for="is_active">
                        Active?
                      </label>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
        </div>
        </div>
        <script>
          $(".edit").click(function() {
            var title = $(this).attr('data-title');
            var menu = $(this).attr('data-menu');
            var url = $(this).attr('data-url');
            var icon = $(this).attr('data-icon');
            var is_active = $(this).attr('data-is_active');

            $("#title1").val(title);
            $("#title11").val(title);
            $("#menu_id1").val(menu);
            $("#url1").val(url);
            $("#icon1").val(icon);
            $("#is_active1").val(is_active);
          });
        </script>