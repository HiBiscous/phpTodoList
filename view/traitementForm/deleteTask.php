<?php
session_start();
require_once '../../model/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_tasks'])) {

    $id_tasks = $_POST['id_tasks'];
    $rqt = 'DELETE FROM tasks WHERE id_tasks = :id_tasks ';
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(':id_tasks', $id_tasks);
    $stmt->execute();


    header("Location: ../tasks/note.php");
    exit();
}
