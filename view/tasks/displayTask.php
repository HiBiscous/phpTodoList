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
    <title>ToDo List | note</title>
</head>

<body>
    <?php
    require_once '../templates/header.php';
    ?>
    <div class="table">
        <?php

        if ($stmt) {
            foreach ($arr as $value) { ?>
                <h3 class="title title-text todo-content"><?= ucfirst($value['title']) ?></h3>
                <ul id="task_<?= $value['id_tasks'] ?>">
                    <?php
                    $description = explode(' ', preg_replace('/\s+/', ' ', $value['description']));
                    foreach ($description as $i) {
                        echo '<li>' . ucfirst($i) . '</li>';
                    }
                    ?>
                </ul>

        <?php
            }
        }
        ?>
    </div>
    <br>
    <a href="/phpTodolist/view/tasks/updateTask.php?id_tasks=<?= $value['id_tasks']; ?>" class="btn btn-edit">Modifier</a>
</body>

</html>