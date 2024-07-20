    <?php
    session_start();
    if (!isset($_SESSION['id_users'])) {
        header('Location: /phptodolist/view/authentification/connection.php');
        exit();
    }
    $userId = $_SESSION['id_users'];
    require_once '../../model/db_connect.php';

    $rqt = 'SELECT title, description, id_tasks FROM tasks WHERE id_tasks = :id_tasks ';
    $id_tasks = $_GET['id_tasks'];
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(':id_tasks', $id_tasks);
    $stmt->execute();
    $arr = $stmt->fetchAll();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['description']) && isset($_POST['id_tasks'])) {
            $description = $_POST['description'];
            $title = $_POST['title'];
            $id_tasks = $_POST['id_tasks'];
            var_dump($_POST['description']);
            $rqt = 'UPDATE tasks SET description = :description, title = :title WHERE id_tasks = :id_tasks AND userId = :userId';
            $stmt = $pdo->prepare($rqt);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':id_tasks', $id_tasks);
            $stmt->bindParam(':userId', $userId);

            var_dump($stmt->execute());
            if ($stmt->execute()) {
                header('Location: /phptodolist/view/tasks/note.php');
                exit();
            }
        }
    }


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
            <form action="#" method="POST">
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