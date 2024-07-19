<?php
session_start();
require_once '../../model/db_connect.php';

$response = [
    'message' => '',
    'success' => false
];

if (isset($_POST['tasks_description']) && isset($_POST['tasks_id'])) {
    $tasks_description = $_POST['tasks_description'];
    $tasks_id = $_POST['tasks_id'];

    $rqt = 'UPDATE tasks SET tasks_description = :tasks_description WHERE tasks_id = :tasks_id';
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(':tasks_description', $tasks_description);
    $stmt->bindParam(':tasks_id', $tasks_id);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'la mise a jour a ete faites';
    } else {
        $response['message'] = ' Redirection en cours ';
    }
} else {
    $response['message'] = 'Une erreur s\'est produite';
}

$query = "SELECT tasks_description FROM tasks";
$stmt = $pdo->prepare($query);
$stmt->execute();
$arr = $stmt->fetchAll();


header('Content-Type: application/json');
echo json_encode($response);
