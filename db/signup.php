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

            if ($saved) {
                $_SESSION['user'] = array(
                    'id' => $id,
                    'name' => $name,
                    'username' => $username,
                    'email' => $email,
                    'role' => $role,
                );
    
                header("Location: ../index.php");
            } else {
                $stmt_emergency = $db->prepare("DELETE FROM user WHERE id = :inserted_id");
                $params_emergency = array(
                    ':id' => $inserted_id,
                );
                $saved = $stmt_emergency->execute($params_emergency);
                $_SESSION['message']['danger'] = "Error: Fail saving personal information, this might be internal error, please call developer";
            }
        } catch (Exception $e) {
            var_dump($stmt);
            var_dump($e->getMessage());
        }
    } else {
        $_SESSION['message']['danger'] = "Error: Fail saving personal information, this might be internal error, please call developer";
    }
}

header("Location: ../signup.php");
