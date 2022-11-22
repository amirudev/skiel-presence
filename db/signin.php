<?php
require_once './config.php';

if(!isset($_POST['signin'])) {
    $_SESSION['message']['danger'] = "Error: Request not allowed";
} else {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query_username = "SELECT * FROM user WHERE username = :username";
    $stmt_username = $db->prepare($query_username);

    $params_username = array(
        ":username" => $username
    );

    try {
        $saved = $stmt_username->execute($params_username);
    } catch (Exception $e) {
        var_dump($stmt_username);
        var_dump($e->getMessage());
        die();
    }

    if ($saved) {
        $user = $stmt_username->fetch(PDO::FETCH_ASSOC);
        $rowcount = $stmt_username->rowCount();

        if ($rowcount == 0) {
            $query_phone = "SELECT * FROM user WHERE phone = :phone";
            $stmt_phone = $db->prepare($query_phone);

            $params_phone = array(
                ":phone" => $username,
            );

            try {
                $saved = $stmt_phone->execute($params_phone);
            } catch (Exception $e) {
                var_dump($stmt_phone);
                var_dump($e->getMessage());
                die();
            }

            if ($saved) {
                $user = $stmt_phone->fetch(PDO::FETCH_ASSOC);
                $rowcount = $stmt_phone->rowCount();

                if ($rowcount == 0) {
                    $_SESSION['message']['danger'] = "Error: Username tidak ditemukan";
                    header("Location: ../signin.php");
                }

                if (!password_verify($password, $user['password'])) {
                    $_SESSION['message']['danger'] = "Error: Password salah";
                    header("Location: ../signin.php");
                }
            }
        }

        if ($user['role']) {
            if ($user['role'] == 'teacher') {
                $query_personal = "SELECT * FROM teacher WHERE id = :id";
            } else if ($user['role'] == 'admin') {
                $query_personal = "SELECT * FROM admin WHERE id = :id";
            } else {
                $query_personal = "SELECT * FROM student WHERE id = :id";
            }

            $stmt_personal = $db->prepare($query_personal);

            $params_personal = array(
                ":id" => $user['id'],
            );

            try {
                $saved = $stmt_personal->execute($params_personal);

            } catch (Exception $e) {
                var_dump($stmt_personal);
                var_dump($e->getMessage());
                die();
            }

            if ($saved) {
                $personal = $stmt_personal->fetch(PDO::FETCH_ASSOC);
                $rowcount = $stmt_personal->rowCount();

                if ($rowcount == 0) {
                    $_SESSION['message']['danger'] = "Error: Data tidak ditemukan";
                    header("Location: ../signin.php");
                } else {
                    $_SESSION['user'] = array(
                        'id' => $user['id'],
                        'name' => $personal['name'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                    );
            
                    header("Location: ../index.php");
                }
            }
        }
    } else {
        echo "Error: Gagal melakukan query";
        die;
    }
}