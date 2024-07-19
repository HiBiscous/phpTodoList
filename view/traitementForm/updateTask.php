<?php
session_start();
require_once '../../model/db_connect.php';

$response = [
    'message' => '',
    'success' => false
];

if (isset($_POST['description']) && isset($_POST['id_tasks'])) {
    $description = $_POST['description'];
    $id_tasks = $_POST['id_tasks'];

    $rqt = 'UPDATE tasks SET description = :description WHERE id_tasks = :id_tasks';
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id_tasks', $id_tasks);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'la mise a jour a ete faites';
    } else {
        $response['message'] = ' Redirection en cours ';
    }
} else {
    $response['message'] = 'Une erreur s\'est produite';
}

$query = "SELECT description FROM tasks";
$stmt = $pdo->prepare($query);
$stmt->execute();
$arr = $stmt->fetchAll();


header('Content-Type: application/json');
echo json_encode($response);
