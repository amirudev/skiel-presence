<?php
require_once "./db/config.php";

if (!isset($_SESSION['user'])) {
    header("Location: ./signin.php");
    exit;
}

if (count($_SESSION['user']) == 0) {
    header("Location: ./signin.php");
    exit;
}

$user = $_SESSION['user'];

$query_presence = "SELECT * FROM presence_user WHERE user_id = :user_id AND timestart >= :this_day";
$stmt_presence = $db->prepare($query_presence);
$params_presence = array(
    ":user_id" => $user['id'],
    ":this_day" => date("Y-m-d 00:00:00"),
);


try {
    $saved = $stmt_presence->execute($params_presence);
} catch (Exception $e) {
    var_dump($e->getMessage());
    die();
}

if ($saved) {
    $presence = $stmt_presence->fetch(PDO::FETCH_ASSOC);
    $rowcount = $stmt_presence->rowCount();

    $currenthour = date("H");

    if ($rowcount == 0) {
        if (($currenthour >= 5 && $currenthour <= 8) || $isdev) {
            $query_presence = "INSERT INTO presence_user (user_id, timestart) VALUES (:user_id, :timestart)";
            $stmt_presence = $db->prepare($query_presence);
            $params_presence = array(
                ":user_id" => $user['id'],
                ":timestart" => date("Y-m-d H:i:s"),
            );

            try {
                $saved = $stmt_presence->execute($params_presence);

                if ($saved) {
                    $_SESSION['message']['user']['success']['presence-in'] = true;
                }
            } catch (Exception $e) {
                var_dump($e->getMessage());
                die();
            }
        }
    }
    
    if ($rowcount > 0 && $presence['timeend'] == null) {
        if (($currenthour >= 15 && $currenthour <= 24) || $isdev) {
            $query_presence = "UPDATE presence_user SET timeend = :timeend WHERE id = :id";
            $stmt_presence = $db->prepare($query_presence);
            $params_presence = array(
                ":id" => $presence['id'],
                ":timeend" => date("Y-m-d H:i:s"),
            );

            try {
                $saved = $stmt_presence->execute($params_presence);

                if ($saved) {
                    $_SESSION['message']['user']['success']['presence-out'] = true;
                }
            } catch (Exception $e) {
                var_dump($e->getMessage());
                die();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKIEL Presence</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>