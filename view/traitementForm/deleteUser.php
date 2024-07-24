<?php

session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_users'])) {
    header('Location: connection.php');
    exit;
}
require_once '../../model/db_connect.php';
$userId = $_SESSION['id_users'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_users'])) {
    $rqt = 'DELETE FROM users WHERE id_users = :id_users ';
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(':id_users', $userId);
    $stmt->execute();

    // Destroys all session variables   
    $_SESSION = [];

    // delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        var_dump($params);
        var_dump($_SESSION);
        setcookie('PHPSESSID');
    }

    session_destroy();
    unset($_SESSION['id_users']);

    header('Location: /phptodolist/view/authentification/createCompte.php');
    exit;
}
