<?php
require_once '../../model/db_connect.php';

$rqt = 'SELECT description, id_tasks FROM tasks ORDER BY id_tasks DESC LIMIT 5';
$stmt = $pdo->prepare($rqt);
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

    <form action="../traitementForm/createTask.php" method="POST" class="add-note-form" id="taskForm">
        <input type="text" id="description" name="description" placeholder="Nouvelle tâche" required>
        <button type="submit" class="btn btn-add">Ajouter</button>
    </form>
    <h3 class="title todo-content">TO DO</h3>

    <table class="table">
        <?php
        if ($stmt) {
            foreach ($arr as $value) { ?>
                <tr class="table-tr" id="task_<?php echo $value['id_tasks'] ?>">
                    <td class="table-td">
                        <?php echo htmlspecialchars($value['description']) ?>
                    </td>
                    <td class="table-td table-td-width">
                        <button class="btn btn-edit" onclick="popup_open(<?php echo $value['id_tasks'] ?>, '<?php echo htmlspecialchars($value['description']) ?>')">EDIT</button>
                    </td>
                    <td class="table-td table-td-width">
                        <form action="/phpTodolist/view/traitementForm/deleteTask.php" method="POST">
                            <input type="hidden" name="id_tasks" value="<?php echo $value['id_tasks']; ?>">
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
    <script src="../../javascript/fetch_api/update.js"></script>
</body>

</html>