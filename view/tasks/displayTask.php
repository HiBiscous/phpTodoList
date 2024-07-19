<?php
session_start();
if (!isset($_SESSION['id_users'])) {
    header('Location: /phptodolist/view/authentification/connection.php');
    exit();
}

require_once '../../model/db_connect.php';

$rqt = 'SELECT title, description, id_tasks FROM tasks WHERE id_tasks = :id_tasks ';
$id_tasks = $_GET['id_tasks'];
var_dump($id_tasks);
$stmt = $pdo->prepare($rqt);
$stmt->bindParam(':id_tasks', $id_tasks);
$stmt->execute();
$arr = $stmt->fetchAll();
var_dump($arr);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/main.css">
    <title>ToDo List</title>
</head>

<body>

    <?php
    require_once '../templates/header.php';
    ?>
</body>