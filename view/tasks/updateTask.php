<?php
session_start();
if (!isset($_SESSION['id_users'])) {
    header('Location: /phptodolist/view/authentification/connection.php');
    exit();
}
require_once '../../model/db_connect.php';
$userId = $_SESSION['id_users'];
$id_tasks = $_GET['id_tasks'];

$rqt = 'SELECT title, description, id_tasks FROM tasks WHERE id_tasks = :id_tasks ';

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
        <form action="../traitementForm/updateTask.php" method="POST">
            <?php if ($stmt) {
                foreach ($arr as $value) { ?>
                    <input type="hidden" name="id_tasks" value="<?= $value['id_tasks'] ?>">

                    <label for="title">Titre :</label>
                    <input type="text" name="title" value="<?= ucfirst($value['title']) ?>"><br>

                    <label for="description">Description :</label>
                    <textarea name="description" rows="10" cols="30"><?= ucfirst($value['description']) ?></textarea><br>

                    <button type="submit" class="btn btn-update">Enregistrer les modifications</button>
            <?php
                }
            }
            ?>
        </form>
    </div>

</body>

</html>