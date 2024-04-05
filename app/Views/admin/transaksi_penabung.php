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
              <h6>Riwayat Transaksi</h6>
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
                      <th class="text-secondary opacity-7"></th>
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
                      <td class="align-middle text-left">
                        <button type="button" class="btn btn-link text-dark text-sm mb-0 px-0" data-bs-toggle="modal" data-bs-target="#ViewModal<?php echo $row->keterangan.$row->id_transaksi;?>"><i class="fa-solid fa-circle-info"></i></button>
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
     <!-- Modal View Detail Penyetoran -->
     <div class="modal fade" id="ViewModal<?php echo 'Setor'.$row->id_transaksi;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" action="" method="post" id="viewdetail">
              <div class="row">
                <div class="col-md-6">
                  <h6>Transaksi Penabung</h6>
                  <div class="form-group">
                    <label for="id_transaksi">ID Transaksi:</label>
                    <input type="text" class="form-control" name="id_transaksi" placeholder="" id="id_transaksi" value="<?php echo $row->id_transaksi;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama_penabung">Nama Penabung</label>
                    <input type="text" class="form-control" name="nama_penabung" placeholder="" id="nama_penabung" value="<?php echo $row->nama_penabung;?>">
                  </div>
                  <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                    <input type="text" class="form-control" name="tanggal_transaksi" placeholder="" id="tanggal_transaksi" value="<?php echo $row->tanggal_transaksi;?>">
                  </div>
                  <div class="form-group">
                    <label for="nominal">Nominal:</label>
                    <input type="text" class="form-control" name="nominal" placeholder="" id="nominal" value="<?= number_format($row->nominal, 2, ',', '.') ?>">
                  </div>
                  <div class="form-group">
                    <label for="saldo">Saldo:</label>
                    <input type="text" class="form-control" name="saldo" placeholder="" id="saldo" value="<?= number_format($row->saldo, 2, ',', '.') ?>">
                  </div>
                  <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" class="form-control" name="keterangan" placeholder="" id="keterangan" value="<?= $row->keterangan ?>">
                  </div>
                  <div class="form-group">
                    <label for="status">Status Transkasi:</label>
                    <input type="text" class="form-control" name="status" placeholder="" id="status" value="<?= $row->status ?>">
                  </div>
                  <div class="form-group">
                    <label for="approver"><?php if ($row->id_status == 3): ?>
                                              Rejector
                                          <?php else: ?>
                                              Approver
                                          <?php endif; ?>
                    </label>
                    <input type="text" class="form-control" name="approver" placeholder="" id="approver" value="<?= $row->nama_approver ?>">
                  </div>
                </div>    
                <div class="col-md-6">
                  <h6>Detail Penyetoran</h6>
                  <div class="form-group">
                    <label for="id_penyetoran">ID Penyetoran:</label>
                    <input type="text" class="form-control" name="id_penyetoran" placeholder="" id="id_penyetoran" value="<?php echo $row->id_penyetoran;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama_pengirim">Nama Pengirim:</label>
                    <input type="text" class="form-control" name="nama_pengirim" placeholder="" id="nama_pengirim" value="<?php echo $row->nama_pengirim_k;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="rekening_pengirim">Rekening Pengirim:</label>
                    <input type="text" class="form-control" name="rekening_pengirim" placeholder="" id="rekening_pengirim" value="<?php echo $row->rekening_pengirim_k;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="bank_pengirim">Bank Pengirim:</label>
                    <input type="text" class="form-control" name="bank_pengirim" placeholder="" id="bank_pengirim" value="<?php echo $row->bank_pengirim_k;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama_penerima">Nama Penerima:</label>
                    <input type="text" class="form-control" name="nama_penerima" placeholder="" id="nama_penerima" value="<?php echo $row->nama_penerima_k;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="rekening_penerima">Rekening Penerima:</label>
                    <input type="text" class="form-control" name="rekening_penerima" placeholder="" id="rekening_penerima" value="<?php echo $row->rekening_penerima_k;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="bank_penerima">Bank Penerima:</label>
                    <input type="text" class="form-control" name="bank_penerima" placeholder="" id="bank_penerima" value="<?php echo $row->bank_penerima_k;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="metode_pembayaran">Metode Pembayaran:</label>
                    <input type="text" class="form-control" name="metode_pembayaran" placeholder="" id="metode_pembayaran" value="<?php echo $row->metode_pembayaran_k;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="approver">Bukti Transfer:</label>
                    <br>
                    <img src="<?= base_url('assets/img/uploads/'. $row->bukti_transfer_k) ?>" class="img-fluid border-radius-lg" alt="Tidak ada lampiran">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          </div>
          
        </div>
      </div>
    </div>
    <!-- End of Modal -->
    <?php };?>


    <?php foreach ($transaksi as $row) { ?>
     <!-- Modal View Detail Penarikan -->
     <div class="modal fade" id="ViewModal<?php echo 'Tarik'.$row->id_transaksi;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" action="" method="post" id="viewdetail">
              <div class="row">
                <div class="col-md-6">
                  <h6>Transaksi Penabung</h6>
                  <div class="form-group">
                    <label for="id_transaksi">ID Transaksi:</label>
                    <input type="text" class="form-control" name="id_transaksi" placeholder="" id="id_transaksi" value="<?php echo $row->id_transaksi;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama_penabung">Nama Penabung</label>
                    <input type="text" class="form-control" name="nama_penabung" placeholder="" id="nama_penabung" value="<?php echo $row->nama_penabung;?>">
                  </div>
                  <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                    <input type="text" class="form-control" name="tanggal_transaksi" placeholder="" id="tanggal_transaksi" value="<?php echo $row->tanggal_transaksi;?>">
                  </div>
                  <div class="form-group">
                    <label for="nominal">Nominal:</label>
                    <input type="text" class="form-control" name="nominal" placeholder="" id="nominal" value="<?= number_format($row->nominal, 2, ',', '.') ?>">
                  </div>
                  <div class="form-group">
                    <label for="saldo">Saldo:</label>
                    <input type="text" class="form-control" name="saldo" placeholder="" id="saldo" value="<?= number_format($row->saldo, 2, ',', '.') ?>">
                  </div>
                  <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" class="form-control" name="keterangan" placeholder="" id="keterangan" value="<?= $row->keterangan ?>">
                  </div>
                  <div class="form-group">
                    <label for="status">Status Transkasi:</label>
                    <input type="text" class="form-control" name="status" placeholder="" id="status" value="<?= $row->status ?>">
                  </div>
                  <div class="form-group">
                    <label for="approver"><?php if ($row->id_status == 3): ?>
                                              Rejector
                                          <?php elseif ($row->id_status == 5): ?>
                                              Fund Sender
                                          <?php else: ?>
                                              Approver
                                          <?php endif; ?></label>
                    <input type="text" class="form-control" name="approver" placeholder="" id="approver" value="<?= $row->nama_approver ?>">
                  </div>
                </div>    
                <div class="col-md-6">
                  <h6>Detail Penarikan</h6>
                  <div class="form-group">
                    <label for="id_penarikan">ID Penarikan:</label>
                    <input type="text" class="form-control" name="id_penarikan" placeholder="" id="id_penarikan" value="<?php echo $row->id_penarikan;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama_pengirim">Nama Pengirim:</label>
                    <input type="text" class="form-control" name="nama_pengirim" placeholder="" id="nama_pengirim" value="<?php echo $row->nama_pengirim_d;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="rekening_pengirim">Rekening Pengirim:</label>
                    <input type="text" class="form-control" name="rekening_pengirim" placeholder="" id="rekening_pengirim" value="<?php echo $row->rekening_pengirim_d;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="bank_pengirim">Bank Pengirim:</label>
                    <input type="text" class="form-control" name="bank_pengirim" placeholder="" id="bank_pengirim" value="<?php echo $row->bank_pengirim_d;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama_penerima">Nama Penerima:</label>
                    <input type="text" class="form-control" name="nama_penerima" placeholder="" id="nama_penerima" value="<?php echo $row->nama_penerima_d;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="rekening_penerima">Rekening Penerima:</label>
                    <input type="text" class="form-control" name="rekening_penerima" placeholder="" id="rekening_penerima" value="<?php echo $row->rekening_penerima_d;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="bank_penerima">Bank Penerima:</label>
                    <input type="text" class="form-control" name="bank_penerima" placeholder="" id="bank_penerima" value="<?php echo $row->bank_penerima_d;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="metode_pembayaran">Metode Pembayaran:</label>
                    <input type="text" class="form-control" name="metode_pembayaran" placeholder="" id="metode_pembayaran" value="<?php echo $row->metode_pembayaran_d;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="approver">Bukti Transfer:</label>
                    <br>
                    <img src="<?= base_url('assets/img/uploads/'. $row->bukti_transfer_d) ?>" class="img-fluid border-radius-lg" alt="Tidak ada lampiran">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          </div>
          
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



</script>

</html>