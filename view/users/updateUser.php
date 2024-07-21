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
                foreach ($arr as $value) {
            ?>
                    <input type="hidden" name="id_users" value="<?= $_SESSION['id_users'] ?>">
                    <label for="username">Pseudo :</label>
                    <input type="text" name="username" value="<?= ucfirst($value['username']) ?>"><br>

                    <label for="email">Email :</label>
                    <input type="email" name="email" value="<?= ucfirst($value['email']) ?>"><br>

                    <button type="submit" class="btn btn-submit">Enregistrer les modifications</button>
            <?php
                }
            }
            ?>
        </form>
    </div>
    <form action="../traitementForm/deleteUser.php" method="POST">
        <input type="hidden" name="id_users" value="<?= $_SESSION['id_users'] ?>">
        <button type="submit" name="delete" class="btn">Supprimer mon compte</button>
    </form>
</body>

</html>