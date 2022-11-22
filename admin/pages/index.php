<?php include_once './components/header.php'; ?>
      <div id="main">
        <header class="mb-3">
          <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
          </a>
        </header>

        <div class="page-heading">
          <h3>Data Monitoring Harian</h3>
        </div>
        <div class="page-content">
          <section class="row">
            <div class="col-12">
              <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-4 py-4-5">
                      <div class="row">
                        <div
                          class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                        >
                          <div class="stats-icon purple mb-2">
                            <i class="iconly-boldLogin"></i>
                          </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                          <h6 class="text-muted font-semibold">
                            Sudah Datang
                          </h6>
                          <h6 class="font-extrabold mb-0 fs-3">112 <span class="fs-5"> Guru</span></h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-4 py-4-5">
                      <div class="row">
                        <div
                          class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                        >
                          <div class="stats-icon blue mb-2">
                            <i class="iconly-boldWork"></i>
                          </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                          <h6 class="text-muted font-semibold">Sedang Mengajar</h6>
                          <h6 class="font-extrabold mb-0 fs-3">183 <span class="fs-5"> Guru</span></h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-4 py-4-5">
                      <div class="row">
                        <div
                          class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                        >
                          <div class="stats-icon green mb-2">
                            <i class="iconly-boldChart"></i>
                          </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                          <h6 class="text-muted font-semibold">Persentase Kehadiran</h6>
                          <h6 class="font-extrabold mb-0 fs-3">80 <span class="fs-5">%</span></h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-4 py-4-5">
                      <div class="row">
                        <div
                          class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                        >
                          <div class="stats-icon red mb-2">
                            <i class="iconly-boldGraph"></i>
                          </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                          <h6 class="text-muted font-semibold">Persentase Mengajar</h6>
                          <h6 class="font-extrabold mb-0 fs-3">112 <span class="fs-5">%</span></h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Presensi Guru Bulanan</h4>
                    </div>
                    <div class="card-body">
                      <div id="chart-profile-visit"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-xl-4">
                  <div class="card">
                    <div class="card-header">
                      <h4>Data Guru</h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="d-flex align-items-center">
                            <svg
                              class="bi text-primary"
                              width="32"
                              height="32"
                              fill="blue"
                              style="width: 10px"
                            >
                              <use
                                xlink:href="assets/images/bootstrap-icons.svg#circle-fill"
                              />
                            </svg>
                            <h5 class="mb-0 ms-3">Guru Aktif</h5>
                          </div>
                        </div>
                        <div class="col-6">
                          <h5 class="mb-0">862</h5>
                        </div>
                        <div class="col-12">
                          <div id="chart-europe"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-xl-8">
                  <div class="card">
                    <div class="card-header">
                      <h4>Data Kehadiran Terbaru</h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-lg">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Comment</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="col-3">
                                <div class="d-flex align-items-center">
                                  <div class="avatar avatar-md">
                                    <img src="assets/images/faces/5.jpg" />
                                  </div>
                                  <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                </div>
                              </td>
                              <td class="col-auto">
                                <p class="mb-0">
                                  Congratulations on your graduation!
                                </p>
                              </td>
                            </tr>
                            <tr>
                              <td class="col-3">
                                <div class="d-flex align-items-center">
                                  <div class="avatar avatar-md">
                                    <img src="assets/images/faces/2.jpg" />
                                  </div>
                                  <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                                </div>
                              </td>
                              <td class="col-auto">
                                <p class="mb-0">
                                  Wow amazing design! Can you make another
                                  tutorial for this design?
                                </p>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>

        <footer>
          <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
              <p>2021 &copy; Mazer</p>
            </div>
            <div class="float-end">
              <p>
                Crafted with
                <span class="text-danger"><i class="bi bi-heart"></i></span> by
                <a href="https://saugi.me">Saugi</a>
              </p>
            </div>
          </div>
        </footer>
      </div>
    </div>

    <?php include './components/footer.php'; ?>