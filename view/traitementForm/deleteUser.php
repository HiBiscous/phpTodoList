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
    // $id_tasks = $_POST['id_tasks'];
    $rqt = 'DELETE FROM users WHERE id_users = :id_users ';
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(':id_users', $userId);
    $stmt->execute();

    session_destroy();
    unset($_SESSION['id_users']);
    header('Location: /phptodolist/view/authentification/createCompte.php');
    exit;
}
