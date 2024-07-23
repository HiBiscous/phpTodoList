<?php
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_users'])) {
    header('Location: connection.php');
    exit;
}
require_once '../../model/db_connect.php';
$userId = $_SESSION['id_users'];

$rqt = 'SELECT username, email FROM users WHERE id_users = :id_users';
// $id_tasks = $_GET['id_tasks'];
$stmt = $pdo->prepare($rqt);
$stmt->bindParam(':id_users', $userId);
$stmt->execute();
$arr = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/main.css">

    <title>Modifier mon Profil</title>
</head>

<body>
    <?php
    require_once '../templates/header.php';
    ?>
    <div class="table">
        <form action="../traitementForm/updateUser.php" method="POST">
            <?php if ($stmt) {
                foreach ($arr as $value) { ?>
                    <div class="form-group">
                        <input type="hidden" name="id_users" value="<?= $_SESSION['id_users'] ?>">

                        <h3 for="username">Pseudo :</h3>
                        <input type="text" class="title-item" name="username" value="<?= ucfirst($value['username']) ?>"><br>
                    </div>
                    <div class="form-group description-group">
                        <h3 for="email">Email :</h3>
                        <input type="email" class="description-item" name="email" value="<?= ucfirst($value['email']) ?>"><br>
                    </div>
            <?php
                }
            }
            ?>
            <button type="submit" class="btn btn-submit">Enregistrer les modifications</button>
        </form>
    </div>
    <form action="../traitementForm/deleteUser.php" method="POST" onsubmit="return confirm('Delete This account?')">
        <input type="hidden" name="id_users" value="<?= $_SESSION['id_users'] ?>">
        <button type="submit" name="delete" class="btn btn-delete">Supprimer mon compte</button>
    </form>


    <script src="/phptodolist/javascript/confirmMessage.js"></script>
</body>

</html>