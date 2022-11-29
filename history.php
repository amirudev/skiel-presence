<?php include_once './components/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <div class="content px-3 mb-5 pb-5">
        <ul class="nav nav-tabs nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                <div class="d-flex flex-column align-items-start" style="max-width: 100px">
                    <i class="fa-solid fa-clock mb-2"></i>
                    <p class="text-start">Riwayat Presensi</p>
                </div>
              </button>
            </li>
            <!-- <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" disabled>Disabled</button>
            </li> -->
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                <div>
					<?php
                    $query_presence = "SELECT * FROM presence_user INNER JOIN user ON presence_user.user_id = user.id  INNER JOIN teacher ON user.teacher_id = teacher.id ORDER BY presence_user.updated_at DESC LIMIT 25";
                    $stmt_presence = $db->prepare($query_presence);
                    $stmt_presence->execute();
                    $result_presence = $stmt_presence->fetchAll(PDO::FETCH_ASSOC);
                    $rowcount = $stmt_presence->rowCount();
                    
                    foreach ($result_presence as $value) { ?>
                        <div class="card border-0 bg-success p-3 mb-2">
                            <h5 class="mb-3 text-white fs-6"><?php echo date( 'l, d-F-Y', strtotime($value['timestart']) ); ?></h5>
                            <div class="card border-0 w-full mb-2 text-bg-green">
                                <div class="d-flex">
                                    <div class="d-flex align-items-center px-4 py-2">
                                        <p><?php echo date( 'H:m:s', strtotime($value['timestart'] . " +7 hours")); ?></p>
                                    </div>
                                    <div class="vr"></div>
                                    <div class="d-flex align-items-center px-4">
                                        <p class="mb-0">Presensi Hadir</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card border-0 w-full mb-2 text-bg-green">
                                <div class="d-flex">
                                    <div class="d-flex align-items-center px-4 py-2">
                                        <p><?php echo date( 'H:m:s', strtotime($value['timeend'] . " +7 hours")); ?></p>
                                    </div>
                                    <div class="vr"></div>
                                    <div class="d-flex align-items-center px-4">
                                        <p class="mb-0">Presensi Keluar</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include './components/footer.php' ?>