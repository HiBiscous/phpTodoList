<?php
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_users'])) {
    header('Location: connection.php');
    exit;
}
require_once '../../model/db_connect.php';
$userId = $_SESSION['id_users'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['email'])) {

        $username = $_POST['username'];
        $email = $_POST['email'];

        $rqt = 'UPDATE users SET username = :username, email = :email WHERE id_users = :id_users';
        $stmt = $pdo->prepare($rqt);
        $stmt->bindParam('username', $username);
        $stmt->bindParam('email', $email);
        $stmt->bindParam('id_users', $userId);

        $stmt->execute();
        $arr = $stmt->fetchAll();

        header('Location: /phptodolist/view/users/index.php');
        exit();
    }
}
