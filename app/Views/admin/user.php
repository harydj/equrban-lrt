<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<div class="container-fluid py-3">
      <!-- Button trigger modal -->
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
            <div class="text-start">
              <h6>User Management</h6>
              <div class="text-end">
                <button type="button" class="btn bg-gradient-primary btn-block" data-bs-toggle="modal" data-bs-target="#exampleModalMessage">
                  Add New User
                </button>
              </div>
            </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-4">
                <table id="mytable" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created Date</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($user as $row) : ?>                
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?= $row->nama ?></h6>
                            <p class="text-xs text-secondary mb-0"><?= $row->email ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $row->role ?></p>
                        <p class="text-xs text-secondary mb-0"><?= $row->desc ?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                      <?php
                          $statusClass = $row->is_active == '1' ? 'bg-gradient-success' : 'bg-gradient-danger';
                          ?>
                          <span class="badge <?= $statusClass ?>"><?= $row->status ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $row->created_date ?></span>
                      </td>
                      <td class="align-middle">
                        <button type="button" class="btn btn-outline-secondary mb-0" data-toggle="modal" data-target="#editModal" title="Edit User"><i class="fa-solid fa-user-pen"></i></button>
                        <!-- <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a> -->
                      </td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      
    <!-- Modal Add new User -->
    <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" action="<?php echo base_url('admin/add_user'); ?>" method="post" id="adduser">
              <div class="form-group">
                <label for="nipp">NIPP:</label>
                <input type="text" class="form-control" name="nipp" placeholder="NIPP" id="nipp">
              </div>
              <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama" id="nama">
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" placeholder="Email" id="email" >
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" class="form-control" name="password" placeholder="Password" id="password">
              </div>
              <div class="form-group">
              <label for="role">Role:</label>
                <select class="form-control" name="role_user">
                   <option value="1">Admin</option>
                   <option value="2">Penabung</option>
                </select>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn bg-gradient-primary">Daftar</button>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End of Modal -->

  </div>
  </main>
  </div>
</body>
<script>

$(document).ready(function() {
    $('#mytable').DataTable({
        "pageLength": 5,
    });
});
</script>
</html>