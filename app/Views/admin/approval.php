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
              <h6>List Transaksi Pending</h6>
            </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-4">
                <table id="mytable" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Penabung</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Transaksi</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Transaksi</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nominal</th> 
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Saldo</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Transaksi</th>
                      <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Approver</th> -->
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bukti Transfer</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                      <!-- <th class="text-secondary opacity-7"></th> -->
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($transaksi as $row) : ?>                
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?= $row->nama_penabung ?></h6>
                            <p class="text-xs text-secondary mb-0"><?= $row->nipp ?></p>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?php
                                                                        $newDateFormat = date("Ymd", strtotime($row->tanggal_transaksi));
                                                                        if ($row->id_penyetoran !== null) {
                                                                            echo 'K'.str_pad($row->id_transaksi.$row->id_penyetoran, 6, '0', STR_PAD_LEFT).$newDateFormat;
                                                                        } elseif ($row->id_penarikan !== null) {
                                                                            echo 'D'.str_pad($row->id_transaksi.$row->id_penarikan, 6, '0', STR_PAD_LEFT).$newDateFormat;
                                                                        } else {
                                                                            echo 'null';
                                                                        }
                                                                ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $row->tanggal_transaksi ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= 'Rp. '.number_format($row->nominal, 2, ',', '.') ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= 'Rp. ' . number_format(($row->saldo !== null ? $row->saldo : 0), 2, ',', '.') ?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                      <?php
                          $ket = $row->id_keterangan == '1' ? 'btn-outline-success btn-sm' : 'btn-outline-danger btn-sm';
                          ?>
                      <p class="btn <?= $ket ?> mb-0" disabled><?= $row->keterangan ?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                      <?php
                          $statusClass = $row->id_status == '2' ? 'bg-gradient-success' : ($row->id_status == '1' ? 'bg-gradient-warning' : ($row->id_status == '4' ? 'bg-gradient-secondary' : ($row->id_status == '5' ? 'bg-gradient-success' : 'bg-gradient-danger')));
                          ?>
                          <span class="badge <?= $statusClass ?>"><?= $row->status ?></span>
                      </td>
                      <td class="align-middle text-center">
                      <button class="btn btn-link text-dark text-sm mb-0 px-0" data-bs-toggle="modal" data-bs-target="#modal-notification<?php echo $row->keterangan.$row->id_transaksi;?>"><i class="ni ni-image"></i></i></button>
                      </td>
                      <td class="align-middle text-center">
                      <?php if ($row->id_status == 1) { ?>
                            <!-- Tombol Approve -->
                            <button type="button" class="btn btn-link text-dark text-sm mb-0 px-0" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Approve Transaksi" 
                                    data-container="body" 
                                    data-animation="true" 
                                    data-bs-target="#ApproveModel<?php echo $row->keterangan.$row->id_transaksi;?>"
                                    onclick="$('#ApproveModel<?php echo $row->keterangan.$row->id_transaksi;?>').modal('toggle');">
                                <i class="fa-solid fa-square-check fa-xs" style="color: #008000;"></i>
                            </button>
                            
                            <!-- Tombol Reject -->
                            <button type="button" class="btn btn-link text-dark text-sm mb-0 px-0" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Reject Transaksi" 
                                    data-container="body" 
                                    data-animation="true" 
                                    data-bs-target="#RejectModel<?php echo $row->keterangan.$row->id_transaksi;?>"
                                    onclick="$('#RejectModel<?php echo $row->keterangan.$row->id_transaksi;?>').modal('toggle');">
                                <i class="fa-solid fa-square-xmark fa-xs" style="color: #e21818;"></i>
                            </button>
                        <?php } elseif ($row->id_status == 4) { ?>
                            <!-- Tombol Konfirmasi Transfer -->
                            <button type="button" class="btn btn-link text-dark text-sm mb-0 px-0" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Konfirmasi Transfer" 
                                    data-container="body" 
                                    data-animation="true" 
                                    data-bs-target="#TransferModel<?php echo $row->keterangan.$row->id_transaksi;?>"
                                    onclick="$('#TransferModel<?php echo $row->keterangan.$row->id_transaksi;?>').modal('toggle');">
                                <i class="fa-solid fa-money-bill-transfer fa-xs" style="color: #008000;"></i>
                            </button>
                        <?php } ?>

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
      
    <!-- Modal Bukti Transfer Penyetoran-->
      <?php foreach ($transaksi as $row) { ?>
      <div class="modal fade" id="modal-notification<?php echo 'Setor'.$row->id_transaksi;?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="modal-title-notification"><?php echo $row->bukti_transfer_k;?></h6>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="py-3 text-center">
              <img src="<?= base_url('assets/img/uploads/'. $row->bukti_transfer_k) ?>" class="img-fluid border-radius-lg" alt="Tidak ada lampiran">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php };?>
    <!-- End of Modal -->

    <!-- Modal Bukti Transfer Penarikan-->
      <?php foreach ($transaksi as $row) { ?>
          <div class="modal fade" id="modal-notification<?php echo 'Tarik'.$row->id_transaksi;?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="modal-title-notification"><?php echo $row->bukti_transfer_d ? $row->bukti_transfer_d : 'Tidak ada lampiran'?></h6>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="py-3 text-center">
              <img src="<?= base_url('assets/img/uploads/'. $row->bukti_transfer_d) ?>" class="img-fluid border-radius-lg" alt="Tidak ada lampiran">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php };?>
  <!-- End of Modal -->

    <?php foreach ($transaksi as $row) { ?>
     <!-- Modal View Approval Penyetoran -->
     <div class="modal fade" id="ApproveModel<?php echo 'Setor'.$row->id_transaksi;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve Transaksi ?</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <form role="form" action="<?php echo base_url('admin/approve_setoran'); ?>" method="post" id="approve_setor">
                <input type="text" class="form-control" name="id_transaksi_k" id="id_transaksi_k" value="<?php echo $row->id_transaksi;?>" hidden>
                <button type="submit" class="btn bg-gradient-success text-white">Approve</button>
            </form>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Modal -->
    <?php };?>

    <?php foreach ($transaksi as $row) { ?>
     <!-- Modal View Reject Penyetoran -->
     <div class="modal fade" id="RejectModel<?php echo 'Setor'.$row->id_transaksi;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reject Transaksi ?</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <form role="form" action="<?php echo base_url('admin/reject_setoran'); ?>" method="post" id="reject_setor">
                <input type="text" class="form-control" name="id_transaksi_k" id="id_transaksi_k" value="<?php echo $row->id_transaksi;?>" hidden>
                <button type="submit" class="btn bg-gradient-danger text-white">Reject</button>
            </form>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Modal -->
    <?php };?>


    <?php foreach ($transaksi as $row) { ?>
     <!-- Modal View Approval Penarikan -->
     <div class="modal fade" id="ApproveModel<?php echo 'Tarik'.$row->id_transaksi;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve Transaksi ?</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="py-3 text-center">
              <i class="ni ni-bell-55 ni-3x"></i>
              <p>Silahkan proses transfer dana penabung setelah melakukan approval</p>
            </div>
          </div>
          <div class="modal-footer">
            <form role="form" action="<?php echo base_url('admin/proses_tarik'); ?>" method="post" id="proses_tarik">
                <input type="text" class="form-control" name="id_transaksi_d" id="id_transaksi_d" value="<?php echo $row->id_transaksi;?>" hidden>
                <button type="submit" class="btn bg-gradient-success text-white">Approve</button>
            </form>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
     </div>
    <!-- End of Modal -->
    <?php };?>

    <?php foreach ($transaksi as $row) { ?>
     <!-- Modal View Fund Transfer Penarikan -->
     <div class="modal fade" id="TransferModel<?php echo 'Tarik'.$row->id_transaksi;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Transfer Dana ?</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" action="<?php echo base_url('admin/transfer_dana'); ?>" method="post" id="transfer_dana" enctype="multipart/form-data">
              <div class="form-group">
                <label for="tanggal_transfer" class="form-control-label">Tanggal Transfer</label>
                <input class="form-control" type="date" placeholder="Masukkan tanggal transfer" name="tanggal_transfer" id="tanggal_transfer" required>
                </div>
              <div class="form-group">
                <label for="nama_pengirim_d">Nama Pengirim:</label>
                <input type="text" class="form-control" name="nama_pengirim_d" placeholder="Masukkan nama pengirim" id="nama_pengirim_d" required>
              </div>
              <div class="form-group">
                <label for="rekening_pengirim_d">Rekening Pengirim:</label>
                <input type="text" class="form-control" name="rekening_pengirim_d" placeholder="Masukkan rekening pengirim" id="rekening_pengirim_d" required>
              </div>
              <div class="form-group">
                <label for="bank_pengirim_d">Bank Pengirim</label>
                <select class="form-control select2" name="bank_pengirim_d" id="select2insidemodal" data-placeholder="Cari bank" required>
                <option value=""></option> <!-- Opsi kosong -->
                <?php foreach ($bank as $row) : ?>
                <option value="<?= $row[3]; ?>"><?= $row[3]; ?></option>
                <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="bukti_transfer_d" class="form-control-label">Bukti Transfer</label>
                <input class="form-control" type="file" placeholder="Upload bukti transfer" name="bukti_transfer_d" id="bukti_transfer_d" required>
              </div>  
          </div>
          <div class="modal-footer">
            <?php foreach ($transaksi as $row) : ?>
                <input type="text" class="form-control" name="id_transaksi_d" id="id_transaksi_d" value="<?= $row->id_transaksi;?>" hidden>
            <?php endforeach ?>
                <button type="submit" class="btn bg-gradient-success text-white">Konfirmasi</button>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End of Modal -->
    <?php };?>

    <?php foreach ($transaksi as $row) { ?>
     <!-- Modal View Reject Penarikan -->
     <div class="modal fade" id="RejectModel<?php echo 'Tarik'.$row->id_transaksi;?>" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reject Transaksi ?</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <form role="form" action="<?php echo base_url('admin/reject_penarikan'); ?>" method="post" id="reject_tarik">
                <input type="text" class="form-control" name="id_transaksi_d" id="id_transaksi_d" value="<?php echo $row->id_transaksi;?>" hidden>
                <button type="submit" class="btn bg-gradient-danger text-white">Reject</button>
            </form>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Modal -->
    <?php };?>

  </main>
  </div>
</body>
<script>

$(document).ready(function() {
    $('#mytable').DataTable({
        "pageLength": 5,
    });
});

<?php foreach ($transaksi as $row) { ?>
$('#TransferModel<?php echo 'Tarik'.$row->id_transaksi;?> .select2').each(function() {  
   var $p = $(this).parent(); 
   $(this).select2({  
     dropdownParent: $p  
   });  
});
<?php };?>

</script>

</html>