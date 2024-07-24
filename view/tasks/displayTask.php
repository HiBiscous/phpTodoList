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

//import header and doctype template and change the title variable
$title = '| ' . ucfirst($arr[0]['title']);
require_once '../templates/header.php';
?>
<main>
    <div class="show">
        <?php
        if ($stmt) {
            foreach ($arr as $value) { ?>
                <div class="form-group">
                    <h3 class="title-item">Titre : </h3>
                    <span><?= ucfirst($value['title']) ?></span>
                </div>
                <div class="form-group">
                    <h3 class="description-item">Description : </h3>
                    <span><?= nl2br($value['description']) ?></span>
                </div>
        <?php
            }
        }
        ?>

        <a href="/phpTodolist/view/tasks/updateTask.php?id_tasks=<?= $value['id_tasks']; ?>" class="btn btn-update">Modifier</a>

    </div>
</main>
</body>

</html>