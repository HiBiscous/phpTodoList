<?php
session_start();
require_once '../../model/db_connect.php';

$response = [
    'message' => '',
    'success' => false
];


if (isset($_POST['login']) && isset($_POST['passwd'])) {
    $login = $_POST['login'];
    $passwd = $_POST['passwd'];

    $rqt = "SELECT * FROM users WHERE login = :login";
    $stmt = $pdo->prepare($rqt);
    $stmt->execute([':login' => $login]);
    $arr = $stmt->fetch();

    if ($arr) {
        $_SESSION['userId'] = $arr['userId'];
        $response['message'] = 'Bravo vous etes connecte';
        $response['success'] = true;
    } else {
        $response['message'] = 'Un probleme est survenu';
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
