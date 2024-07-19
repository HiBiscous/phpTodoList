<?php
require_once '../../model/db_connect.php';

$response = [
    'message' => '',
    'success' => false
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $passwd = $_POST['passwd'] ?? '';

    if (($login) && ($passwd)) {
        $rqt = 'SELECT login FROM users WHERE login = :login';
        $stmt = $pdo->prepare($rqt);
        $stmt->execute(
            array(':login' => $login)
        );


        if ($stmt->fetch()) {
            $response['message'] = 'Désolé ce login est déjà utilisé';
        } else {
            $rqt = 'INSERT INTO users VALUES(DEFAULT, :login, :passwd)';
            $stmt = $pdo->prepare($rqt);
            $stmt->execute(
                array(
                    'login' => $login,
                    'passwd' => password_hash($passwd, PASSWORD_DEFAULT)
                )
            );
            $response['message'] = 'Bravo vous avez cree votre compte';
            $response['success'] = true;
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}
