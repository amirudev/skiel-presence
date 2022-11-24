<?php
require_once './config.php';

if(!isset($_POST['add_user'])) {
    $_SESSION['message']['danger'] = "Error: Request not allowed";
} else {
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
}

header("Location: ../admin/pages/subject.php");