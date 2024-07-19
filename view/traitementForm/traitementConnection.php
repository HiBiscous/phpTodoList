<?php
session_start();
require_once '../../model/db_connect.php';

if (isset($_POST['login']) && isset($_POST['passwd'])) {
    $login = $_POST['login'];
    $passwd = $_POST['passwd'];

    $rqt = "SELECT * FROM users WHERE login = :login";
    $stmt = $pdo->prepare($rqt);
    $stmt->execute([':login' => $login]);
    $arr = $stmt->fetch();

    if ($arr) {
        $_SESSION['id_users'] = $arr['id_users'];
        $_SESSION['login'] = $arr['login'];

        var_dump($_SESSION['id_users']);
        var_dump($_SESSION['login']);
        header('Location: /phptodolist/view/tasks/note.php');
        exit();
    } else {
        echo 'un probleme est survenue';
    }
}

// session_start();
// require_once '../../model/db_connect.php';

// $response = [
//     'message' => '',
//     'success' => false
// ];


// if (isset($_POST['login']) && isset($_POST['passwd'])) {
//     $login = $_POST['login'];
//     $passwd = $_POST['passwd'];

//     $rqt = "SELECT * FROM users WHERE login = :login";
//     $stmt = $pdo->prepare($rqt);
//     $stmt->execute([':login' => $login]);
//     $arr = $stmt->fetch();

//     if ($arr) {
//         $_SESSION['id_users'] = $arr['id_users'];
//         $response['message'] = 'Bravo vous etes connecte';
//         $response['success'] = true;
//     } else {
//         $response['message'] = 'Un probleme est survenu';
//     }
//     header('Content-Type: application/json');
//     echo json_encode($response);
// }
