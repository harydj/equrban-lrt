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
              <!-- <h6>Formulir Penabung</h6> -->
            </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-4">
                    <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#profile-tabs-icons" role="tab" aria-controls="profile-tabs-icons" aria-selected="true">
                                    <i class="fa-solid fa-hand-holding-dollar"></i> Form Penyetoran
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-icons" role="tab" aria-controls="dashboard-tabs-icons" aria-selected="false">
                                    <i class="fa-solid fa-money-bill-transfer"></i> Form Penarikan
                                    </a>
                                </li>
                            </ul>
                     </div>

                     <div class="tab-content">
                        <div class="tab-pane fade show active" id="profile-tabs-icons">
                            <div class="card-body px-0 pt-0 pb-2 d-flex justify-content-center align-items-center" style="min-height: 70vh;">
                                <div class="table-responsive p-4" style= "width: 80%;">
                                    <div class="row">
                                        <div class="col-6">
                                            <form role="form" action="<?php echo base_url('admin/add_penyetoran'); ?>" method="post" id="add_penyetoran" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="id_penabung" class="form-control-label">Nama Penabung</label>
                                                    <select class="form-control select2" name="id_penabung" id="id_penabung" data-placeholder="Cari nama penabung" required>
                                                        <option value=""></option> <!-- Opsi kosong -->
                                                        <?php foreach ($user as $row) : ?>
                                                            <option value="<?= $row->id_penabung; ?>"><?= $row->nipp . ' - ' . $row->nama; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div> 
                                                <div class="form-group">
                                                    <label for="tanggal_penyetoran" class="form-control-label">Tanggal Penyetoran</label>
                                                    <input class="form-control" type="date" placeholder="Masukkan tanggal penyetoran" name="tanggal_penyetoran" id="tanggal_penyetoran" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_pengirim" class="form-control-label">Nama Rekening Pengirim</label>
                                                    <input class="form-control" type="text" placeholder="Ex: Budi Pekerti" name="nama_pengirim" id="nama_pengirim" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rekening_pengirim" class="form-control-label">Nomor Rekening Pengirim</label>
                                                    <input class="form-control" type="text" placeholder="Ex: 13100xxx" name="rekening_pengirim" id="rekening_pengirim" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bank_pengirim">Bank Pengirim</label>
                                                    <select class="form-control select2" name="bank_pengirim" id="bank_pengirim" data-placeholder="Cari bank">
                                                    <option value=""></option> <!-- Opsi kosong -->
                                                    <?php foreach ($bank as $row) : ?>
                                                    <option value="<?= $row[3]; ?>"><?= $row[3]; ?></option>
                                                    <?php endforeach ?>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="nama_penerima" class="form-control-label">Nama Rekening Penerima</label>
                                                    <input class="form-control" type="text" placeholder="Ex: LRT Jabodebek" name="nama_penerima" id="nama_penerima" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rekening_penerima" class="form-control-label">Nomor Rekening Penerima</label>
                                                    <input class="form-control" type="text" placeholder="Ex: 13100xxx" name="rekening_penerima" id="rekening_penerima" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bank_penerima" class="Cari bank">Bank Penerima</label>
                                                    <select class="form-control select2" name="bank_penerima" id="bank_penerima" data-placeholder="Cari bank" required>
                                                    <option value=""></option> <!-- Opsi kosong -->
                                                    <?php foreach ($bank as $row) : ?>
                                                    <option value="<?= $row[3]; ?>"><?= $row[3]; ?></option>
                                                    <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlah_setoran" class="form-control-label">Jumlah Setoran</label>
                                                    <input class="form-control" type="number" placeholder="Ex : 100000" name="jumlah_setoran" id="jumlah_setoran" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bukti_transfer" class="form-control-label">Bukti Transfer</label>
                                                    <input class="form-control" type="file" placeholder="Upload bukti transfer" name="bukti_transfer" id="bukti_transfer" required>
                                                </div>                                             
                                        </div>
                                        <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-primary" style="width: 30%;">Submit</button>
                                                </div> 
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="dashboard-tabs-icons">
                            <div class="card-body px-0 pt-0 pb-2 d-flex justify-content-center align-items-center" style="min-height: 70vh;">
                                <div class="table-responsive p-4" style= "width: 80%;">
                                    <div class="row">
                                        <div class="col-6">
                                            <form role="form" action="<?php echo base_url('admin/add_penarikan'); ?>" method="post" id="add_penarikan" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="id_penabung_d" class="form-control-label">Nama Penabung</label>
                                                    <select class="form-control select2" name="id_penabung_d" id="id_penabung_d" data-placeholder="Cari nama penabung" required>
                                                        <option value=""></option> <!-- Opsi kosong -->
                                                        <?php foreach ($user as $row) : ?>
                                                            <option value="<?= $row->id_penabung; ?>"><?= $row->nipp . ' - ' . $row->nama; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div> 
                                                <div class="form-group">
                                                    <label for="tanggal_pengajuan" class="form-control-label">Tanggal Pengajuan Penarikan</label>
                                                    <input class="form-control" type="date" placeholder="Masukkan tanggal pengajuan penarikan" name="tanggal_pengajuan" id="tanggal_pengajuan" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_pengirim_d" class="form-control-label">Nama Rekening Pengirim</label>
                                                    <input class="form-control" type="text" placeholder="Ex: DKM LRT Jabodebek" name="nama_pengirim_d" id="nama_pengirim_d">
                                                </div>
                                                <div class="form-group">
                                                    <label for="rekening_pengirim_d" class="form-control-label">Nomor Rekening Pengirim</label>
                                                    <input class="form-control" type="text" placeholder="Ex: 13100xxx" name="rekening_pengirim_d" id="rekening_pengirim_d">
                                                </div>
                                                <div class="form-group">
                                                    <label for="bank_pengirim_d">Bank Pengirim</label>
                                                    <select class="form-control select2" name="bank_pengirim_d" id="bank_pengirim_d" data-placeholder="Cari bank">
                                                    <option value=""></option> <!-- Opsi kosong -->
                                                    <?php foreach ($bank as $row) : ?>
                                                    <option value="<?= $row[3]; ?>"><?= $row[3]; ?></option>
                                                    <?php endforeach ?>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="nama_penerima_d" class="form-control-label">Nama Rekening Penerima</label>
                                                    <input class="form-control" type="text" placeholder="Ex: Budi Pekerti" name="nama_penerima_d" id="nama_penerima_d" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rekening_penerima_d" class="form-control-label">Nomor Rekening Penerima</label>
                                                    <input class="form-control" type="text" placeholder="Ex: 13100xxx" name="rekening_penerima_d" id="rekening_penerima_d" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bank_penerima_d" class="Cari bank">Bank Penerima</label>
                                                    <select class="form-control select2" name="bank_penerima_d" id="bank_penerima_d" data-placeholder="Cari bank" required>
                                                    <option value=""></option> <!-- Opsi kosong -->
                                                    <?php foreach ($bank as $row) : ?>
                                                    <option value="<?= $row[3]; ?>"><?= $row[3]; ?></option>
                                                    <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlah_penarikan" class="form-control-label">Jumlah Penarikan</label>
                                                    <input class="form-control" type="number" placeholder="Ex : 100000" name="jumlah_penarikan" id="jumlah_penarikan" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bukti_transfer_d" class="form-control-label">Bukti Transfer</label>
                                                    <input class="form-control" type="file" placeholder="Upload bukti transfer" name="bukti_transfer_d" id="bukti_transfer_d">
                                                </div>                                             
                                        </div>
                                        <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-primary" style="width: 30%;">Submit</button>
                                                </div> 
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    $('.nav-link').on('click', function() {
        // Hide all tab content
        $('.tab-pane').removeClass('show active');
        
        // Show the tab content corresponding to the clicked tab
        $($(this).attr('href')).addClass('show active');
    });
});

$(document).ready(function() {
    $('.select2').each(function() {
        var placeholder = $(this).data('placeholder');
        $(this).select2({
            placeholder: placeholder,
            allowClear: false // Aktifkan tombol clear di field
        });
    });
});
</script>
</html>