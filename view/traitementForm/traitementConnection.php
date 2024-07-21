<?php
session_start();
require_once '../../model/db_connect.php';

if (isset($_POST['username']) && isset($_POST['passwd'])) {
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    $rqt = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($rqt);
    $stmt->execute([':username' => $username]);
    $arr = $stmt->fetch();

    if ($arr) {
        $_SESSION['id_users'] = $arr['id_users'];
        header('Location: /phptodolist/view/tasks/note.php');
        exit();
    } else {
        echo 'un probleme est survenue';
    }
}
