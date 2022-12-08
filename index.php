<?php include './components/header.php' ?>

<body class="bg-light">
    <div class="content px-3 mb-5 pb-5">
        <?php
        $todaydate = date('Y-m-d');
        $userid = $_SESSION['user']['id'];
        $query_presence = "SELECT * FROM presence_user INNER JOIN user ON presence_user.user_id = user.id  INNER JOIN teacher ON user.teacher_id = teacher.id WHERE presence_user.created_at > '$todaydate 00:00:00' AND presence_user.user_id = $userid";
        $stmt_presence = $db->prepare($query_presence);
        $stmt_presence->execute();
        $result_presence = $stmt_presence->fetchAll(PDO::FETCH_ASSOC);
        $rowcount = $stmt_presence->rowCount(); ?>
        <div class="card border-0 bg-green-dark text-white mb-2">
            <div class="p-3">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="text-bg-primary d-flex justify-content-center align-items-center rounded-circle fs-3" style="width: 60px; height: 60px">
                            W
                        </div>
                        <div class="ms-3 d-flex flex-column justify-content-center">
                            <p class="fw-bold pb-1">Hai, <?php echo $_SESSION['user']['name'] ?></p>
                            <p><?php echo date("l, d-m-Y") ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center" style="width: 60px">
                        <i class="fas fa-gear" style="width: 20px; height: 20px;" data-bs-toggle="dropdown" aria-expanded="false" id="index-setting-button"></i>
                        <ul class="dropdown-menu mt-2">
                            <li><a id="index-gear-expanded-signout" class="dropdown-item" href="./db/signout.php">Keluar</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div>
                    <div>
                        <?php if ($result_presence[0]['timeend'] != null) { ?>
                            Presensi hari ini sudah lengkap ( Masuk dan Keluar berhasil )
                        <?php } else if ($result_presence[0]['timeend'] != null) { ?>
                            Presensi masuk berhasil, kembali ke aplikasi pukul 15.00 untuk presensi keluar
                        <?php } else { ?>
                            Silahkan kembali pukul 7.00 untuk presensi masuk
                        <?php } ?>
                    </div>

                    <div>
                        <?php if ($isdev) { ?>
                            Mode Development, waktu development : <?php echo $devtime ?>
                        <?php } ?>
                    </div>
                </div>
                <!-- <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-chevron-down me-2"></i>
                        <p>Lihat Detail</p>
                    </div>
                    <form action="./db/send-location.php" method="post">
                        <button class="btn btn-white d-flex align-items-center rounded-pill text-bg-success">
                            <?php if ($rowcount == 0): ?>
                                <i class="fas fa-in me-2"></i>
                                <p>Presensi Masuk</p>
                            <?php else: ?>
                                <i class="fas fa-in me-2"></i>
                                <p>Presensi Keluar</p>
                            <?php endif; ?>
                        </button>
                    </form>
                </div> -->
            </div>
        </div>
        <div class="card border-0 bg-green-dark p-3 mb-2">
            <h5 class="mb-3 text-white fs-6">Presensi Hari Ini</h5>
            <?php
            foreach ($result_presence as $value) { ?>
                <div class="card border-0 bg-success p-3 mb-2">
                    <h5 class="mb-3 text-white fs-6"><?php echo date( 'l, d-F-Y', strtotime($value['timestart']) ); ?></h5>
                    <?php if ($value['timestart'] != null): ?>
                    <div class="card border-0 w-full mb-2 text-bg-success">
                        <div class="d-flex">
                            <div class="d-flex align-items-center p-4">
                                <p><?php echo date( 'H:i', strtotime($value['timestart'] . " +7 hours")); ?></p>
                            </div>
                            <div class="vr"></div>
                            <div class="p-3">
                                <p class="mb-2 fw-bold">Presensi Hadir</p>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-location-pin me-3"></i>
                                    <p>Wanaherang 16965, West Java, Indonesia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($value['timeend'] != null): ?>
                    <div class="card border-0 w-full mb-2 text-bg-success">
                        <div class="d-flex">
                            <div class="d-flex align-items-center p-4">
                                <p><?php echo date( 'H:i', strtotime($value['timeend'] . " +7 hours")); ?></p>
                            </div>
                            <div class="vr"></div>
                            <div class="p-3">
                                <p class="mb-2 fw-bold">Presensi Keluar</p>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-location-pin me-3"></i>
                                    <p>Wanaherang 16965, West Java, Indonesia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php
            }
            ?>
        </div>
        <div>
            <h5 class="mb-3 fs-6 fw-bold my-3">Kelas Sedang Berlangsung</h5>
            <div>
                <?php
                $userid = $_SESSION['user']['id'];
                $day = date('w');
                if ($isdev) {
                    $currentdatetime = $devtime;
                } else {
                    $currentdatetime = date('Y-m-d H:i:s');
                }

                $currenttime = date("H:i:s", strtotime($currentdatetime));

                $querydate = date('w', strtotime($currentdatetime));
                $query_schedule = "SELECT class.name AS class, class.room AS room, teacher.name AS teacher, subjects.name AS subject, schedule.timestart, schedule.timeend FROM schedule INNER JOIN teacher_subject ON schedule.teacher_subject_id = teacher_subject.id INNER JOIN teacher ON teacher.id = teacher_subject.teacher_id INNER JOIN user ON user.teacher_id = teacher.id INNER JOIN class ON schedule.class_id = class.id INNER JOIN subjects ON subjects.id = teacher_subject.subject_id WHERE schedule.day = '$querydate' AND schedule.timestart <= '$currenttime' AND schedule.timeend >= '$currenttime' AND user.id = $userid";
                $stmt_schedule = $db->prepare($query_schedule);
                $stmt_schedule->execute();
                $result_schedule = $stmt_schedule->fetchAll(PDO::FETCH_ASSOC);
                $rowcount = $stmt_schedule->rowCount();

                foreach ($result_schedule as $rs): ?>
                    <div class="card border-0 w-full mb-2 text-bg-success">
                        <div class="d-flex">
                            <div class="d-flex align-items-center p-4">
                                <p><?php echo $rs['timestart'] ?></p>
                            </div>
                            <div class="vr"></div>
                            <div class="p-3 w-100">
                                <div class="mb-3">
                                    <p class="mb-2 fw-bold"><?php echo $rs['class'] ?></p>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-clock me-3"></i>
                                        <p><?php echo $rs['timestart'] ?> - <?php echo $rs['timeend'] ?></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-chalkboard-user me-3"></i>
                                        <p>Ruang <?php echo $rs['room'] ?></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-graduation-cap me-3"></i>
                                        <p><?php echo $rs['subject'] ?></p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end flex-wrap">
                                    <button class="btn btn-white btn-sm d-flex align-items-center rounded-pill bg-green-dark text-white mb-1 me-1">
                                        <i class="fas fa-out me-2"></i>
                                        <p>Beri Pengingat Tugas</p>
                                    </button>
                                    <button class="btn btn-white btn-sm d-flex align-items-center rounded-pill bg-green-dark text-white mb-1 me-1">
                                        <i class="fas fa-out me-2"></i>
                                        <p>Hubungi Ketua Kelas</p>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <div class="card border-0 bg-green-dark p-3 mb-2">
            <h5 class="mb-3 text-white fs-6">Presensi Kemarin</h5>
            <?php
            $todaydatedate = date('Y-m-d');
            $yesterdaydate = date('Y-m-d', strtotime($currentdatetime . "-1 day"));
            $userid = $_SESSION['user']['id'];
            $query_presence = "SELECT presence_user.timestart, presence_user.timeend FROM presence_user INNER JOIN user ON presence_user.user_id = user.id WHERE presence_user.created_at > '$yesterdaydate 00:00:00' AND presence_user.created_at < '$todaydate 00:00:00' AND presence_user.user_id = $userid";
            $stmt_presence = $db->prepare($query_presence);
            $stmt_presence->execute();
            $result_presence = $stmt_presence->fetchAll(PDO::FETCH_ASSOC);
            $rowcount = $stmt_presence->rowCount();

            foreach ($result_presence as $rs): ?>
                <div class="card border-0 w-full mb-2 text-bg-success">
                    <div class="d-flex">
                        <div class="d-flex align-items-center p-4">
                            <p><?php echo date("H:i:s", strtotime($rs['timestart'])) ?></p>
                        </div>
                        <div class="vr"></div>
                        <div class="p-3">
                            <p class="mb-2 fw-bold">Presensi Hadir</p>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-location-pin me-3"></i>
                                <p>Wanaherang 16965, West Java, Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-0 w-full mb-2 text-bg-success">
                    <div class="d-flex">
                        <div class="d-flex align-items-center p-4">
                            <p><?php echo date("H:i:s", strtotime($rs['timeend'])) ?></p>
                        </div>
                        <div class="vr"></div>
                        <div class="p-3">
                            <p class="mb-2 fw-bold">Presensi Keluar</p>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-location-pin me-3"></i>
                                <p>Wanaherang 16965, West Java, Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php include './components/footer.php' ?>