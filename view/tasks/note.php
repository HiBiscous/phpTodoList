<?php
//session start, so the global variable $_SESSION is enable
session_start();

//if the user is not connected, this header will redirect him to the connection page
if (!isset($_SESSION['id_users'])) {
    header('Location: /phptodolist/view/authentification/connection.php');
    exit();
}

//$userId stock the id of the current connected user for future use
$userId = $_SESSION['id_users'];

//import the BDD connection config
require_once '../../model/db_connect.php';

//check if the method form request to access to the current page is POST, 
//if it the case it means that the form is submitted and the form data are available in the array $_POST 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$descriptoin stock the value entered by the user in the description field, for a future use
    $title = $_POST['title'];
    $description = $_POST['description'];

    if (!empty($title)) {
        $rqt = 'INSERT INTO tasks(userId, description, title) VALUES (:userId, :description, :title)';
        $stmt = $pdo->prepare($rqt);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':userId', $userId);


        if ($stmt->execute()) {
            // Rediriger pour éviter la soumission du formulaire en double
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            //display error 
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Task is empty";
    }
}

//
$rqt = 'SELECT title, id_tasks FROM tasks WHERE userId = :userId ';

$stmt = $pdo->prepare($rqt);
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$arr = $stmt->fetchAll();


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
    <?php require_once '../templates/header.php' ?>

    <form action="#" method="POST" class="add-note-form hidden" id="taskForm">
        <div class="form-group">
            <label for="title">Titre :</label>
            <input type="text" id="title" class="title-input" name="title" placeholder="Titre de la tâche" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea type="text" id="description" class="description-input" name="description" placeholder="Description de la tâche" required></textarea>
        </div>
        <button type="submit" class="btn btn-submit">Ajouter</button>
    </form>
    <h3 class="title todo-content">Mes Notes</h3>

    <table class="table">
        <?php

        if ($stmt) {
            foreach ($arr as $value) { ?>
                <tr class="table-tr" id="task_<?= $value['id_tasks'] ?>">
                    <td class="table-td">
                        <span class="title-text"><?= htmlspecialchars(ucfirst($value['title'])) ?></span>
                    </td>

                    <td class="table-td table-td-width">
                        <a href="/phpTodolist/view/tasks/displayTask.php?id_tasks=<?= $value['id_tasks']; ?>" class="link" value="">EDIT</a>
                        <!--<button class="btn btn-edit" onclick="popup_open(<?= $value['id_tasks'] ?>, '<?= htmlspecialchars($value['title']) ?>')">EDIT</button>-->
                    </td>
                    <td class="table-td table-td-width">
                        <form action="/phpTodolist/view/traitementForm/deleteTask.php" method="POST">
                            <input type="hidden" name="id_tasks" value="<?= $value['id_tasks']; ?>">
                            <button class="btn btn-delete" type="submit" name="delete" value="Delete">DELETE</button>
                        </form>
                </tr>
        <?php
            }
        }
        ?>
    </table>

    <!-- POPUP EDIT TASKS-->
    <?php
    require_once 'popup.php';
    ?>

    <script src="../../javascript/popup.js"></script>
    <script src="../../javascript/addNote.js"></script>

    <!-- <script src="../../javascript/fetch_api/update.js"></script> -->
</body>

</html>