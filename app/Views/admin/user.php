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
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>User Management</h6>
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
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
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