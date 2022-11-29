<?php include './components/header.php' ?>

<link rel="stylesheet" href="assets/calendar/simple-calendar.css">
<body class="bg-light">
    <div class="content px-3 mb-5 pb-5">
        <div class="card border-0 bg-green-dark text-white mb-2">
            <div class="p-3">
                <h5 class="mb-3 text-white fs-6">Kalender Presensi</h5>
                <div id="container" class="calendar-container"></div>
            </div>
        </div>
        <div>
            <div id="content" class="page-subject">
                <h5 class="mb-3 fs-6 fw-bold my-3">Jadwal Pelajaran Hari Ini</h5>
                <ul class="timeline">
                    <?php
                    $userid = $_SESSION['user']['id'];
                    $day = date('w');
                    if ($isdev) {
                        $currentdatetime = $devtime;
                    } else {
                        $currentdatetime = date('Y-m-d H:i:s');
                    }
                    $querydate = date('w', strtotime($currentdatetime));

                    $query_schedule = "SELECT class.name AS class, class.room AS room, teacher.name AS teacher, subjects.name AS subject, schedule.timestart, schedule.timeend FROM schedule INNER JOIN teacher_subject ON schedule.teacher_subject_id = teacher_subject.id INNER JOIN teacher ON teacher.id = teacher_subject.teacher_id INNER JOIN user ON user.teacher_id = teacher.id INNER JOIN class ON schedule.class_id = class.id INNER JOIN subjects ON subjects.id = teacher_subject.subject_id WHERE schedule.day = '$querydate' AND user.id = $userid";
                    $stmt_schedule = $db->prepare($query_schedule);
                    $stmt_schedule->execute();
                    $result_schedule = $stmt_schedule->fetchAll(PDO::FETCH_ASSOC);
                    $rowcount = $stmt_schedule->rowCount();

                    foreach ($result_schedule as $rs): ?>
                        <li class="event p-3 pt-5" data-date="<?php echo $rs['timestart'] ?> - <?php echo $rs['timeend'] ?>">
                            <h3>Kelas <?php echo $rs['class'] ?></h3>
                            <div>
                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-classroom-user me-2"></i>
                        Ruang <?php echo $rs['room'] ?>
                        </div>
                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-classroom-user me-2"></i>
                                    <?php echo $rs['subject'] ?> - <?php echo $rs['teacher'] ?>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-end mt-2">
                                <button class="btn btn-success ms-1 mb-1">Ketua Kelas</button>
                            </div>
                        </li>
                    <?php endforeach;
                        ?>
                </ul>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Kehadiran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Presensi tidak dilakukan pada Senin, 25 April 2022.
                        Silahkan konfirmasi kehadiran kamu disini, tekan tombol hadir untuk dikonfirmasi oleh admin.
                        <div class="mt-2">
                            <button type="button" class="btn btn-primary">Hadir</button>
                            <button type="button" class="btn btn-danger">Tidak Hadir</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        <script src="./assets/calendar/jquery.simple-calendar.js"></script>
        <script>
        var $calendar;
        $(document).ready(function () {
            let container = $("#container").simpleCalendar({
            fixedStartDay: 0, // begin weeks by sunday
            disableEmptyDetails: true,
            events: [
                // // generate new event after tomorrow for one hour
                // {
                // startDate: new Date(new Date().setHours(new Date().getHours() + 24)).toDateString(),
                // endDate: new Date(new Date().setHours(new Date().getHours() + 25)).toISOString(),
                // summary: 'Visit of the Eiffel Tower'
                // },
                // // generate new event for yesterday at noon
                // {
                // startDate: new Date(new Date().setHours(new Date().getHours() - new Date().getHours() - 12, 0)).toISOString(),
                // endDate: new Date(new Date().setHours(new Date().getHours() - new Date().getHours() - 11)).getTime(),
                // summary: 'Restaurant'
                // },
                // // generate new event for the last two days
                // {
                // startDate: new Date(new Date().setHours(new Date().getHours() - 48)).toISOString(),
                // endDate: new Date(new Date().setHours(new Date().getHours() - 24)).getTime(),
                // summary: 'Visit of the Louvre'
                // }
            ],

            });
            $calendar = container.data('plugin_simpleCalendar')
        });
        </script>
              
        <?php include './components/footer.php' ?>