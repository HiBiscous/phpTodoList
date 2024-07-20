<?php
session_start();
if (!isset($_SESSION['id_users'])) {
    header('Location: /phptodolist/view/authentification/connection.php');
    exit();
}

require_once '../../model/db_connect.php';

if (isset($_POST['description']) && isset($_POST['id_tasks'])) {
    $description = $_POST['description'];
    $id_tasks = $_POST['id_tasks'];

    $rqt = 'UPDATE tasks SET description = :description WHERE id_tasks = :id_tasks';
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id_tasks', $id_tasks);

    $stmt->execute();
}

$query = "SELECT description FROM tasks";
$stmt = $pdo->prepare($query);
$stmt->execute();
$arr = $stmt->fetchAll();


header('Content-Type: application/json');
echo json_encode($response);
