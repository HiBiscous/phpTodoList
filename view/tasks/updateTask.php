<?php

//session start, so the global variable $_SESSION is enable
session_start();

//if the user is not connected, this header will redirect him to the connection page
if (!isset($_SESSION['id_users'])) {
    header('Location: /phptodolist/view/authentification/connection.php');
    exit();
}
require_once '../../model/db_connect.php';

//$userId stock the id of the current connected user for future use
$userId = $_SESSION['id_users'];

//$id_tasks collect the value of the tasks fields 
$id_tasks = $_GET['id_tasks'];

//request to display tasks
$rqt = 'SELECT title, description, id_tasks FROM tasks WHERE id_tasks = :id_tasks ';
$stmt = $pdo->prepare($rqt);
$stmt->bindParam(':id_tasks', $id_tasks);
$stmt->execute();
$arr = $stmt->fetchAll();


//import header and doctype template and change the title variable
$title = '| Modifier Note';
require_once '../templates/header.php';
?>

<form action="../traitementForm/updateTask.php" id="taskFormUpdate" class="show" method="POST">

    <?php if ($stmt) {
        foreach ($arr as $value) { ?>
            <div class="form-group">
                <input type="hidden" name="id_tasks" value="<?= $value['id_tasks'] ?>">

                <h3 for="title">Titre :</h3>
                <input type="text" name="title" class="title-item" value="<?= ucfirst($value['title']) ?>"><br>
            </div>
            <div class="form-group description-group">
                <h3 for="description">Description :</h3>
                <textarea name="description" class="description-item"><?= ucfirst($value['description']) ?></textarea><br>
            </div>
    <?php
        }
    }
    ?>
    <button type="submit" class="btn btn-update btn-update-task ">Enregistrer les modifications</button>
</form>

<script src="../../javascript/main.js"></script>
</body>

</html>