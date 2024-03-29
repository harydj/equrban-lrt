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
                <button type="button" class="btn bg-gradient-primary btn-block" data-bs-toggle="modal" data-bs-target="#AddModal">
                  Tambah User
                </button>
              </div>
            </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-4">
                <table id="mytable" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
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
                        <button type="button" class="btn btn-outline-secondary mb-0" data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $row->nipp;?>"><i class="fa-solid fa-user-pen"></i></button>
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
    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
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
                <input type="password" class="form-control" name="password" placeholder="Password" id="insertPassword">
              </div>
              <div class="form-group">
              <label for="role">Role:</label>
                <select class="form-control" name="role_user">
                   <option value="1">Admin</option>
                   <option value="2">Penabung</option>
                </select>
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="insertShowPasswordCheckbox" onchange="togglePasswordVisibility('insertPassword', 'insertShowPasswordCheckbox')">
                <label class="custom-control-label" for="insertShowPasswordCheckbox">Lihat Password</label>
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

    <?php foreach ($user as $row) { ?>
     <!-- Modal Edit User -->
     <div class="modal fade" id="EditModal<?php echo $row->nipp;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" action="<?php echo base_url('admin/edit_user'); ?>" method="post" id="adduser">
              <div class="form-group">
                <label for="nipp">NIPP:</label>
                <input type="text" class="form-control" name="nipp" placeholder="NIPP" id="nipp" value="<?php echo $row->nipp;?>" readonly>
              </div>
              <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama" id="nama" value="<?php echo $row->nama;?>">
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" placeholder="Email" id="email" value="<?php echo $row->email;?>">
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" placeholder="Password" id="editPassword<?php echo $row->nipp;?>" value="<?php echo $row->password;?>">
              </div>
              <div class="form-group">
              <label for="role">Role:</label>
                <select class="form-control" name="role_user">
                   <option value="1"  <?php echo ($row->id_role == 1) ? 'selected' : ''; ?>>Admin</option>
                   <option value="2"  <?php echo ($row->id_role == 2) ? 'selected' : ''; ?>>Penabung</option>
                </select>
              </div>
              <div class="form-group">
              <label for="status">Status:</label>
                <select class="form-control" name="status">
                   <option value="1"  <?php echo ($row->is_active == 1) ? 'selected' : ''; ?>>Aktif</option>
                   <option value="0"  <?php echo ($row->is_active == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                </select>
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="editShowPasswordCheckbox<?php echo $row->nipp;?>" onchange="togglePasswordVisibility('editPassword<?php echo $row->nipp;?>', 'editShowPasswordCheckbox<?php echo $row->nipp;?>')">
                <label class="custom-control-label" for="editShowPasswordCheckbox<?php echo $row->nipp;?>">Lihat Password</label>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn bg-gradient-primary">Update</button>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End of Modal -->
    <?php };?>

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

function togglePasswordVisibility(passwordFieldId, checkboxId) {
        var passwordField = document.getElementById(passwordFieldId);
        var checkbox = document.getElementById(checkboxId);

        if (checkbox.checked) {
            passwordField.type = "text"; // Change input type to text
        } else {
            passwordField.type = "password"; // Change input type to password
        }
    }

</script>

</html>