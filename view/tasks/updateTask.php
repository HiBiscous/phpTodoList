<?php
session_start();
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

    <title>Edit note</title>
</head>

<body>
    <?php
    require_once '../templates/header.php';
    ?>
    <div class="table">
        <form action="/phptodolist/view/traitementForm/updateTask.php" method="POST">
            <?php if ($stmt) {
                foreach ($arr as $value) {
                    var_dump($value['id_tasks']) ?>
                    <input type="hidden" name="id_tasks" value="<?= $value['id_tasks'] ?>">

                    <label for="title">Titre :</label>
                    <input type="text" name="title" value="<?= ucfirst($value['title']) ?>"><br>

                    <label for="description">Description :</label>
                    <textarea name="description" rows="10" cols="30"><?= ucfirst($value['description']) ?></textarea><br>

                    <button type="submit" class="btn btn-submit">Enregistrer les modifications</button>

            <?php
                }
            }
            ?>
        </form>
    </div>

</body>

</html>