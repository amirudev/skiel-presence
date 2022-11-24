<?php 
include_once './components/header.php';
?>
<!-- Modal Guru -->
<div class="modal fade" id="add-teacher-modal" tabindex="-1" aria-labelledby="add-teacher-modal" aria-hidden="true">
  <div class="modal-dialog">
    <form action="../../../db/admin-add-teacher.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="add-teacher-modal">Tambah Guru</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input name="add_user" value="1" hidden>
            <label for="input-teacher-name" class="pb-2">Nama Guru</label>
            <input type="text" id="input-teacher-name" class="form-control mb-2" name="name">
            <label for="input-teacher-username" class="pb-2">Username</label>
            <input type="text" id="input-teacher-username" class="form-control mb-2" name="username">
            <label for="input-teacher-email" class="pb-2">Alamat E-Mail</label>
            <input type="email" id="input-teacher-email" class="form-control mb-2" name="email">
            <label for="input-teacher-email" class="pb-2">Nomor Telepon</label>
            <div class="input-group mb-3">
              <span class="input-group-text">+62</span>
              <div class="form-floating">
                <input type="text" class="form-control" id="form-signup-phone" name="phone">
                <label for="form-signup-phone">Nomor Telepon</label>
              </div>
            </div>
            <select class="form-select mb-3" aria-label="Default select example" id="form-signup-role" name="role">
              <option selected>Peran Pengguna Baru</option>
              <option value="student">Sekretaris</option>
              <option value="teacher">Guru</option>
              <option value="admin">Admin</option>
            </select>
            <div class="form-floating pb-3">
              <input type="password" class="form-control" id="form-signup-password" placeholder="Password" name="password">
              <label for="form-signup-password">Password</label>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Buat Akun Baru</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Guru -->
<div class="modal fade" id="add-teacher-modal" tabindex="-1" aria-labelledby="add-teacher-modal" aria-hidden="true">
  <div class="modal-dialog">
    <form action="../../../db/admin-add-teacher.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="add-teacher-modal">Tambah Guru</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input name="add_user" value="1" hidden>
            <label for="input-subject-name" class="pb-2">Mata Pelajaran</label>
            <input type="text" id="input-subject-name" class="form-control mb-2" name="name">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Buat Akun Baru</button>
          </div>
      </form>
    </div>
  </div>
</div>

      <div id="main">
        <header class="mb-3">
          <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
          </a>
        </header>
        
        <div class="page-content">
          <section class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header pb-0">
                  <h4 class="card-title">Mata Pelajaran</h4>
                </div>
                <div class="card-content">
                  <div class="card-body py-0 pb-4">
                    Informasi Mata Pelajaran dan Guru yang mengampu
                  </div>
                </div>
              </div>

              <?php
              if (isset($_SESSION['message']['danger'])) {
                echo '<div class="alert alert-danger" role="alert">'.$_SESSION['message']['danger'].'</div>';
                unset($_SESSION['message']['danger']);
              } else if (isset($_SESSION['message']['success'])) {
                echo '<div class="alert alert-success" role="alert">'.$_SESSION['message']['success'].'</div>';
                unset($_SESSION['message']['success']);
              }?>
          </section>

          <div class="row">
            <div class="col-xl-4 col-md-6 col-sm-12">
              <?php if(isset($_SESSION['special']['account-creation']['success'])): ?>
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5>Data Guru Baru</h5>
                  
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <table>
                      <tr>
                        <td class="fw-bold pe-3">Nama Lengkap</td>
                        <td><?php echo $_SESSION['special']['account-creation']['success']['name'] ?></td>
                      </tr>
                      <tr>
                        <td class="fw-bold pe-3">Username</td>
                        <td><?php echo $_SESSION['special']['account-creation']['success']['username'] ?></td>
                      </tr>
                      <tr>
                        <td class="fw-bold pe-3">E-Mail</td>
                        <td><?php echo $_SESSION['special']['account-creation']['success']['email'] ?></td>
                      </tr>
                      <tr>
                        <td class="fw-bold pe-3">Password</td>
                        <td><?php echo $_SESSION['special']['account-creation']['success']['password'] ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <?php
                unset($_SESSION['special']['account-creation']['success']);
              ?>
              <?php endif; ?>

              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5>Guru</h5>
                  <button class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#add-teacher-modal">Tambah Guru</button>
                  
                </div>
                <div class="card-content">
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-lg">
                      <thead>
                          <tr>
                            <th class="col-6">Nama Lengkap</th>
                            <th class="col-6">Alamat E-Mail</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query_presence = "SELECT teacher.name, user.email FROM teacher INNER JOIN user ON user.teacher_id = teacher.id";
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
                              <td>
                                <?php echo $value['email'] ?>
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

              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5>Mata Pelajaran</h5>
                  <button class="btn btn-light-primary">Tambah Mata Pelajaran</button>
                </div>
                <div class="card-content">
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-lg">
                      <thead>
                          <tr>
                            <th class="col-9">Mata Pelajaran</th>
                            <th class="col-3">Jumlah Guru</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query_presence = "SELECT subjects.name, COUNT(subject_id) AS count_teacher FROM teacher_subject INNER JOIN subjects ON subjects.id = teacher_subject.subject_id GROUP BY subject_id ORDER BY subjects.name";
                          $stmt_presence = $db->prepare($query_presence);
                          $stmt_presence->execute();
                          $result_presence = $stmt_presence->fetchAll(PDO::FETCH_ASSOC);
                          $rowcount = $stmt_presence->rowCount();
                          
                          foreach ($result_presence as $value) { ?>
                            <tr>
                              <td class="text-bold-500">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-success me-3">
                                        <span class="avatar-content"><?php echo strtoupper(substr($value['name'], 0, 1)); ?></span>
                                    </div>
                                    <?php echo $value['name'] ?>
                                </div>
                              </td>
                              <td>
                                <?php echo $value['count_teacher'] ?>
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

              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5>Kelas</h5>
                  <button class="btn btn-light-primary">Tambah Kelas</button>
                </div>
                <div class="card-content">
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-lg">
                      <thead>
                          <tr>
                            <th class="col-12">Kelas</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query_presence = "SELECT * FROM class ORDER BY name";
                          $stmt_presence = $db->prepare($query_presence);
                          $stmt_presence->execute();
                          $result_presence = $stmt_presence->fetchAll(PDO::FETCH_ASSOC);
                          $rowcount = $stmt_presence->rowCount();
                          
                          foreach ($result_presence as $value) { ?>
                            <tr>
                              <td class="text-bold-500">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-success me-3">
                                        <span class="avatar-content"><?php echo strtoupper(substr($value['name'], 0, 1)); ?></span>
                                    </div>
                                    <?php echo $value['name'] ?>
                                </div>
                              </td>
                              <td>
                                <?php echo $value['count_teacher'] ?>
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

            <div class="col-md-8 col-sm-12">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5>Mata Pelajaran</h5>
                  <button class="btn btn-light-primary">Tambah Relasi</button>
                </div>
                <div class="card-content">
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-lg">
                      <thead>
                          <tr>
                            <th class="col-6">Mata Pelajaran</th>
                            <th class="col-6">Guru</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query_presence = "SELECT teacher.name as teacher, subjects.name as subjects FROM teacher_subject INNER JOIN teacher ON teacher.id = teacher_subject.teacher_id INNER JOIN subjects ON subjects.id = teacher_subject.subject_id ORDER BY subjects.name";
                          $stmt_presence = $db->prepare($query_presence);
                          $stmt_presence->execute();
                          $result_presence = $stmt_presence->fetchAll(PDO::FETCH_ASSOC);
                          $rowcount = $stmt_presence->rowCount();

                          $teacher_subject = array();

                          $index = 0;
                          foreach ($result_presence as $rp) {
                            $isExists = false;
                            foreach ($teacher_subject as $ts) {
                              $index++;

                              if ($ts['subject'] == $rp['subjects']) {
                                array_push($ts['teacher'], $rp['teacher']);
                                $isExists = true;

                                array_pop($teacher_subject);
                                array_push($teacher_subject, array("subject" => $rp['subjects'], "teacher" => $ts['teacher']));
                              }
                            }

                            if (!$isExists) {
                              array_push($teacher_subject, array("subject" => $rp['subjects'], "teacher" => array($rp['teacher'])));
                            }
                          }
                          
                          ?>

                          <?php foreach ($teacher_subject as $ts_row): ?>
                            <tr>
                              <td><?php echo $ts_row['subject']; ?></td>
                              <td>
                                <?php foreach ($ts_row['teacher'] as $ts_teacher): ?>
                                  <div class="mb-2">
                                    <div class="d-flex align-items-center">
                                      <div class="avatar bg-primary me-3">
                                          <span class="avatar-content"><?php echo strtoupper(substr($ts_teacher, 0, 2)); ?></span>
                                      </div>
                                      <?php echo $ts_teacher ?>
                                  </div>
                                  </div>
                                <?php endforeach; ?>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                  <h5>Jadwal Mengajar Guru</h5>
                  <button class="btn btn-light-primary">Tambah Jadwal</button>
                </div>
                <div class="card-content">
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-lg">
                      <thead>
                          <tr>
                            <th class="col-3">Guru</th>
                            <th class="col-3">Mata Pelajaran</th>
                            <th class="col-3">Kelas</th>
                            <th class="col-3">Hari dan Jam</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query_presence = "SELECT teacher.name as teacher, subjects.name as subjects FROM teacher_subject INNER JOIN teacher ON teacher.id = teacher_subject.teacher_id INNER JOIN subjects ON subjects.id = teacher_subject.subject_id ORDER BY subjects.name";
                          $stmt_presence = $db->prepare($query_presence);
                          $stmt_presence->execute();
                          $result_presence = $stmt_presence->fetchAll(PDO::FETCH_ASSOC);
                          $rowcount = $stmt_presence->rowCount();

                          $teacher_subject = array();

                          $index = 0;
                          foreach ($result_presence as $rp) {
                            $isExists = false;
                            foreach ($teacher_subject as $ts) {
                              $index++;

                              if ($ts['subject'] == $rp['subjects']) {
                                array_push($ts['teacher'], $rp['teacher']);
                                $isExists = true;

                                array_pop($teacher_subject);
                                array_push($teacher_subject, array("subject" => $rp['subjects'], "teacher" => $ts['teacher']));
                              }
                            }

                            if (!$isExists) {
                              array_push($teacher_subject, array("subject" => $rp['subjects'], "teacher" => array($rp['teacher'])));
                            }
                          }
                          
                          ?>

                          <?php foreach ($teacher_subject as $ts_row): ?>
                            <tr>
                              <td><?php echo $ts_row['subject']; ?></td>
                              <td>
                                <?php foreach ($ts_row['teacher'] as $ts_teacher): ?>
                                  <div class="mb-2">
                                    <div class="d-flex align-items-center">
                                      <div class="avatar bg-primary me-3">
                                          <span class="avatar-content"><?php echo strtoupper(substr($ts_teacher, 0, 2)); ?></span>
                                      </div>
                                      <?php echo $ts_teacher ?>
                                  </div>
                                  </div>
                                <?php endforeach; ?>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <footer>
          <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
              <p>2021 &copy; Mazer</p>
            </div>
          </div>
        </footer>
      </div>
    </div>

    <?php include './components/footer.php'; ?>