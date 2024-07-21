<?php
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_users'])) {
    header('Location: connection.php');
    exit;
}
require_once '../../model/db_connect.php';
$userId = $_SESSION['id_users'];

if (isset($userId)) {
    $rqt = "SELECT username, email FROM users WHERE id_users = :id_users";
    $stmt = $pdo->prepare($rqt);
    $stmt->execute([
        ':id_users' => $userId,

    ]);
    $arr = $stmt->fetch();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/main.css">
    <title>Tableau de bord</title>
</head>

<body>
    <?php require_once '../templates/header.php' ?>
    <div class="dashboard-container">
        <h2>Bienvenue sur votre tableau de bord <?= ucfirst($arr['username']) ?></h2>
        <p>Vous pouvez maintenant accéder à toutes les fonctionnalités réservées à nos utilisateurs inscrits.</p>

        <table>
            <tr>
                <td>Pseudo :</td>
                <td><?= $arr['username'] ?></td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><?= $arr['email'] ?></td>
            </tr>
            <tr>
                <td><a href="updateUser.php">Modifier mon profil</a></td>
            </tr>

        </table>
    </div>
</body>

</html>