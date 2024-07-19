<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header('Location: connection.php');
    exit;
}
echo $_SESSION['userID'];
require_once '../../model/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['description'])) {

    $description = $_POST['description'];
    $rqt = 'INSERT INTO tasks(description) VALUES (:description) ';
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(':description', $description);
    $stmt->execute();


    // redirection vers la meme page afin d'eviter la duplication d'information
    header('Location: ../tasks/note.php');
    exit();
}
