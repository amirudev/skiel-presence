<?php include_once './components/header.php';
?>
      <div id="main">
        <header class="mb-3">
          <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
          </a>
        </header>
        
        <div class="page-content">
          <section class="row">
            <div class="col-12">
              <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h4 class="card-title">Aktivitas Presensi Terbaru</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body pt-2">
                      <p class="card-text">
                        Aktivitas presensi yang baru saja dilakukan oleh guru, baik presensi masuk, presensi pulang, maupun presensi mengajar.
                      </p>
                      <!-- Table with outer spacing -->
                      <div class="table-responsive">
                        <table class="table table-lg">
                        <thead>
                            <tr>
                              <th class="col-6">Nama Lengkap</th>
                              <th class="col-4">Tanggal</th>
                              <th class="col-1">Masuk</th>
                              <th class="col-1">Keluar</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $query_presence = "SELECT * FROM presence_user INNER JOIN user ON presence_user.user_id = user.id  INNER JOIN teacher ON user.teacher_id = teacher.id ORDER BY presence_user.updated_at DESC LIMIT 25";
                            $stmt_presence = $db->prepare($query_presence);
                            $stmt_presence->execute();
                            $result_presence = $stmt_presence->fetchAll(PDO::FETCH_ASSOC);
                            $rowcount = $stmt_presence->rowCount();
                            
                            foreach ($result_presence as $value) { ?>
                              <tr>
                                <td class="text-bold-500">
                                  <div class="d-flex align-items-center">
                                      <div class="avatar bg-primary me-3">
                                          <span class="avatar-content"><?php echo strtoupper(substr($value['name'], 0, 2)); ?></span>
                                      </div>
                                      <?php echo $value['name'] ?>
                                  </div>
                                  </td>
                                <td><?php echo date( 'l, d-F-Y', strtotime($value['timestart']) ); ?></td>
                                <td class="text-bold-500"><?php echo date( 'H:m:s', strtotime($value['timestart'] . " +7 hours")); ?></td>
                                <td class="text-bold-500"><?php
                                if (isset($value['timeend'])) {
                                  echo date( 'H:m:s', strtotime($value['timeend'] . " +7 hours"));
                                } ?>
                                  </td>
                              </tr>
                              <?php
                            }
                            ?>
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