<?php
session_start();
if (!isset($_SESSION['id_users'])) {
    header('Location: /phptodolist/view/authentification/connection.php');
    exit();
}
require_once '../../model/db_connect.php';
$userId = $_SESSION['id_users'];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['description']) && isset($_POST['id_tasks'])) {
        $description = $_POST['description'];
        $title = $_POST['title'];
        $id_tasks = $_POST['id_tasks'];

        $rqt = 'UPDATE tasks SET description = :description, title = :title WHERE id_tasks = :id_tasks AND userId = :userId';
        $stmt = $pdo->prepare($rqt);
        $stmt->bindParam('description', $description);
        $stmt->bindParam('title', $title);
        $stmt->bindParam('id_tasks', $id_tasks);
        $stmt->bindParam('userId', $userId);

        if ($stmt->execute()) {
            header('Location: /phptodolist/view/tasks/note.php');
            exit();
        }
    }
}
