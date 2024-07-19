<?php
session_start();
if (!isset($_SESSION['users_id'])) {
    header('Location: connection.php');
    exit;
}
echo $_SESSION['users_id'];
require_once '../../model/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tasks_description'])) {

    $tasks_description = $_POST['tasks_description'];
    $rqt = 'INSERT INTO tasks(tasks_description) VALUES (:tasks_description) ';
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(':tasks_description', $tasks_description);
    $stmt->execute();


    // redirection vers la meme page afin d'eviter la duplication d'information
    header('Location: ../tasks/note.php');
    exit();
}
