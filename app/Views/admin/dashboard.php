    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Saldo Penabung</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= 'Rp. '.number_format($total_saldo, 2, ',', '.') ?>
                      <!-- <span class="text-success text-sm font-weight-bolder">+55%</span> -->
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Penabung Aktif</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= $total_penabung ?>  
                      <!-- <span class="text-success text-sm font-weight-bolder">+3%</span> -->
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Transaksi Penyetoran</p>
                    <h5 class="font-weight-bolder mb-0 text-success">
                    <?= 'Rp. '.number_format($total_setoran, 2, ',', '.') ?>  
                      <!-- <span class="text-danger text-sm font-weight-bolder">-2%</span> -->
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="fa-solid fa-hand-holding-dollar text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Transaksi Penarikan</p>
                    <h5 class="font-weight-bolder mb-0 text-danger">
                    <?= 'Rp. '.number_format($total_penarikan, 2, ',', '.') ?> 
                      <!-- <span class="text-success text-sm font-weight-bolder">+5%</span> -->
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <!-- <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i> -->
                    <i class="fa-solid fa-money-bill-transfer text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-5 mb-lg-0 mb-4">
          <div class="card z-index-2">
            <div class="card-body p-3">
              <!-- <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                </div>
              </div> -->
              <h6 class="ms-2 mt-2 mb-0"> Jumlah Transaksi per Status </h6>
              <!-- <p class="text-sm ms-2"> (<span class="font-weight-bolder">+23%</span>) than last week </p> -->
              <div class="container border-radius-lg">
                <div class="row">
                <div class="col-4 py-3 ps-0">
                      <div class="d-flex mb-2">
                          <div class="col-4 text-end">
                              <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                  <i class="fa-regular fa-clock text-lg opacity-10" aria-hidden="true"></i>
                              </div>
                          </div>
                          <div class="col-8 ps-2">
                              <p class="text-sm mt-0 mb-0 font-weight-bold">Pending</p>
                              <h5 class="font-weight-bolder">1</h5>
                          </div>
                      </div>   
                  </div>
                  <div class="col-4 py-3 ps-0">
                      <div class="d-flex mb-2">
                          <div class="col-4 text-end">
                              <div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
                                  <i class="fa-solid fa-x text-lg opacity-10" aria-hidden="true"></i>
                              </div>
                          </div>
                          <div class="col-8 ps-2">
                              <p class="text-sm mt-0 mb-0 font-weight-bold">In Progress</p>
                              <h5 class="font-weight-bolder">12</h5>
                          </div>
                      </div>
                  </div>
                  <div class="col-4 py-3 ps-0">
                    <div class="d-flex mb-2">
                      <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                            <i class="fa-solid fa-x text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                      </div>
                          <div class="col-8 ps-2">
                              <p class="text-sm mt-0 mb-0 font-weight-bold">Rejected</p>
                              <h5 class="font-weight-bolder">12</h5>
                          </div>
                    </div>
                  </div>
                  <div class="col-4 py-3 ps-0">
                    <div class="d-flex mb-2">
                      <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                          <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                        </div>  
                      </div>
                          <div class="col-8 ps-2">
                                  <p class="text-sm mt-0 mb-0 font-weight-bold">Approved</p>
                                  <h5 class="font-weight-bolder">12</h5>
                          </div>
                    </div>
                  </div>
                  <div class="col-4 py-3 ps-0">
                      <div class="d-flex mb-2">
                          <div class="col-4 text-end">
                              <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                  <i class="fa-solid fa-money-bill-transfer text-lg opacity-10" aria-hidden="true"></i>
                              </div>
                          </div>
                          <div class="col-8 ps-2">
                              <p class="text-sm mt-0 mb-0 font-weight-bold">Funds Sent</p>
                              <h5 class="font-weight-bolder">1</h5>
                          </div>
                      </div>   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Trend Transaksi Penabung</h6>
              <!-- <p class="text-sm">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold">4% more</span> in 2021
              </p> -->
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
      