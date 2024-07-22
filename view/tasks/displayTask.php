<?php
session_start();
if (!isset($_SESSION['id_users'])) {
    header('Location: /phptodolist/view/authentification/connection.php');
    exit();
}

require_once '../../model/db_connect.php';

$rqt = 'SELECT title, description, id_tasks FROM tasks WHERE id_tasks = :id_tasks ';
$id_tasks = $_GET['id_tasks'];
$stmt = $pdo->prepare($rqt);
$stmt->bindParam(':id_tasks', $id_tasks);
$stmt->execute();
$arr = $stmt->fetchAll();



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/main.css">
    <?php
    foreach ($arr as $value) { ?>
        <title>ToDo List | <?= ucfirst($value['title']) ?></title>
    <?php } ?>
</head>

<body>
    <?php
    require_once '../templates/header.php';
    ?>
    <div class="">
        <?php

        if ($stmt) {
            foreach ($arr as $value) { ?>
                <h3 class="title title-text todo-content">Titre : <?= ucfirst($value['title']) ?></h3>
                <ul>
                    <li>
                        <label for="description"><?= nl2br($value['description']) ?></label>
                    </li>
                </ul>

        <?php
            }
        }
        ?>
    </div>
    <br>
    <div class="btn-update">
        <a href="/phpTodolist/view/tasks/updateTask.php?id_tasks=<?= $value['id_tasks']; ?>" class="btn btn-update">Modifier</a>
    </div>
</body>

</html>