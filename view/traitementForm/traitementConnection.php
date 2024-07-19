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

    $sql = "SELECT * FROM users WHERE login = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':login' => $login]);
    $arr = $stmt->fetch();

    if ($arr) {
        $_SESSION['users_id'] = $arr['users_id'];
        $response['message'] = 'Bravo vous etes connecte';
        $response['success'] = true;
    } else {
        $response['message'] = 'Un probleme est survenu';
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
