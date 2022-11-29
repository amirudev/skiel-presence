<?php
require_once './config.php';

if(isset($_POST['add_user'])) {
    $username = htmlspecialchars($_POST['username']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $role = htmlspecialchars($_POST['role']);
    $phone = htmlspecialchars($_POST['phone']);

    if ($role == 'teacher') {
        $query_personal = "INSERT INTO teacher (name) VALUES (:name)";
    } else if ($role == 'admin') {
        $query_personal = "INSERT INTO admin (name) VALUES (:name)";
    } else {
        $query_personal = "INSERT INTO student (name) VALUES (:name)";
    }

    $params_personal = array(
        ":name" => $name,
    );

    $stmt_personal = $db->prepare($query_personal);
    $saved_personal = $stmt_personal->execute($params_personal);
    $inserted_id = $db->lastInsertId();

    if ($saved_personal) {
        if ($role == 'teacher') {
            $query_user = "INSERT INTO user (username, email, password, role, teacher_id) VALUES (:username, :email, :password, :role, :id)";
        } else if ($role == 'admin') {
            $query_user = "INSERT INTO user (username, email, password, role, admin_id) VALUES (:username, :email, :password, :role, :id)";
        } else {
            $query_user = "INSERT INTO user (username, email, password, role, student_id) VALUES (:username, :email, :password, :role, :id)";
        }

        $params_user = array(
            ':username' => $username,
            ':email' => $email,
            ':password' => $password_hash,
            ':role' => $role,
            ':id' => $inserted_id,
        );

        $stmt = $db->prepare($query_user);
        try {
            $saved = $stmt->execute($params_user);

            $inserted_id_user = $db->lastInsertId();

            if ($saved) {
                $_SESSION['special']['account-creation']['success'] = array(
                    'name' => $name,
                    'username' => $username,
                    'email' => $email,
                    'role' => $role,
                    'password' => $password,
                );
                
                $_SESSION['message']['success'] = "Berhasil menambahkan pengguna guru ke database, anda menjadi penanggungjawab pendaftaran ini";
            } else {
                if ($role == 'teacher') {
                    $query_emergency = "DELETE FROM teacher WHERE id = :inserted_id";
                } else if ($role == 'admin') {
                    $query_emergency = "DELETE FROM admin WHERE id = :inserted_id";
                } else {
                    $query_emergency = "DELETE FROM student WHERE id = :inserted_id";
                }

                $stmt_emergency = $db->prepare($query_emergency);
                $params_emergency = array(
                    ':id' => $inserted_id,
                );
                $saved = $stmt_emergency->execute($params_emergency);

                $_SESSION['message']['danger'] = "Error: Fail saving personal information, this might be internal error, please contact developer for further information";
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    } else {
        $_SESSION['message']['danger'] = "Error: Fail saving personal information, this might be internal error, please contact developer for further information";
    }
} else if (isset($_POST['add_subject'])) {
    $name = htmlspecialchars($_POST['name']);
    $query_subject = "INSERT INTO subjects (name) VALUES (:name)";
    $params_subject = array(
        ":name" => $name,
    );

    $stmt_subject = $db->prepare($query_subject);
    $saved_subject = $stmt_subject->execute($params_subject);

    if ($saved_subject) {
        $_SESSION['message']['success'] = "Berhasil menambahkan mata pelajaran $subject";
    } else {
        $_SESSION['message']['danger'] = "Gagal menambahkan mata pelajaran $subject";
    }
} else if (isset($_POST['add_teacher_subject'])) {
    $teacher = htmlspecialchars($_POST['teacher']);
    $subject = htmlspecialchars($_POST['subject']);

    $query_subject = "INSERT INTO teacher_subject (teacher_id, subject_id) VALUES (:teacher_id, :subject_id)";
    $params_subject = array(
        ":teacher_id" => $teacher,
        ":subject_id" => $subject,
    );

    $stmt_subject = $db->prepare($query_subject);
    $saved_subject = $stmt_subject->execute($params_subject);

    if ($saved_subject) {
        $_SESSION['message']['success'] = "Berhasil menambahkan relasi mata pelajaran dengan guru";
    } else {
        $_SESSION['message']['danger'] = "Gagal menambahkan mata pelajaran dengan guru";
    }
} else if (isset($_POST['add_class'])) {
    $name = htmlspecialchars($_POST['name']);
    $room = htmlspecialchars($_POST['room']);

    $query_subject = "INSERT INTO class (name, room) VALUES (:name, :room)";
    $params_subject = array(
        ":name" => $name,
        ":room" => $room,
    );

    $stmt_subject = $db->prepare($query_subject);
    $saved_subject = $stmt_subject->execute($params_subject);

    if ($saved_subject) {
        $_SESSION['message']['success'] = "Berhasil menambahkan kelas baru $name";
    } else {
        $_SESSION['message']['danger'] = "Gagal menambahkan kelas baru $name";
    }
} else if (isset($_POST['add_schedule'])) {
    $teacher_schedule = htmlspecialchars($_POST['teacher_subject']);
    $class = htmlspecialchars($_POST['class']);
    $day = htmlspecialchars($_POST['day']);
    $timestart = htmlspecialchars($_POST['timestart']);
    $timeend = htmlspecialchars($_POST['timeend']);

    $query_schedule = "INSERT INTO schedule (teacher_subject_id, class_id, day, timestart, timeend) VALUES (:teacher_subject_id, :class_id, :day, :timestart, :timeend)";
    $params_schedule = array(
        ":teacher_subject_id" => $teacher_schedule,
        ":class_id" => $class,
        ":day" => $day,
        ":timestart" => $timestart,
        ":timeend" => $timeend,
    );

    $stmt_schedule = $db->prepare($query_schedule);
    $saved_schedule = $stmt_schedule->execute($params_schedule);

    if ($saved_schedule) {
        $_SESSION['message']['success'] = "Berhasil menambahkan kelas baru $name";
    } else {
        $_SESSION['message']['danger'] = "Gagal menambahkan kelas baru $name";
    }
} else {
    $_SESSION['message']['danger'] = "Problem occured on backend handler";
}

header("Location: ../admin/pages/subject.php");