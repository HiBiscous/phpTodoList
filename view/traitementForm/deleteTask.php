<?php
session_start();
require_once '../../model/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tasks_id'])) {

    $tasks_id = $_POST['tasks_id'];
    $rqt = 'DELETE FROM tasks WHERE tasks_id = :tasks_id ';
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(':tasks_id', $tasks_id);
    $stmt->execute();


    header("Location: ../tasks/note.php");
    exit();
}
