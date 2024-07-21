<?php
require_once '../../model/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $passwd = $_POST['passwd'] ?? '';

    if (($username) && ($email) && ($passwd)) {
        $rqt = 'SELECT username FROM users WHERE username = :username';
        $stmt = $pdo->prepare($rqt);
        $stmt->execute(
            array(':username' => $username)
        );


        if ($stmt->fetch()) {
        } else {
            $rqt = 'INSERT INTO users VALUES(DEFAULT, :username, :email, :passwd)';
            $stmt = $pdo->prepare($rqt);
            $stmt->execute(
                array(
                    'username' => $username,
                    'email' => $email,
                    'passwd' => password_hash($passwd, PASSWORD_DEFAULT)
                )
            );
        }
        header('Location: /phptodolist/view/authentification/connection.php');
    }
}
