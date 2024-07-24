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
    $rqt = "SELECT id_users, username, email FROM users WHERE id_users = :id_users";
    $stmt = $pdo->prepare($rqt);
    $stmt->execute([
        ':id_users' => $userId,
    ]);
    $arr = $stmt->fetch();
}

//import header and doctype template and change the title variable
$title = '| Mon Profil';
require_once '../templates/header.php'
?>

<div class="dashboard-container">
    <h2>Bienvenue sur votre tableau de bord <?= ucfirst($arr['username']) ?></h2>
    <p>Vous pouvez maintenant accéder à toutes les fonctionnalités réservées à nos utilisateurs inscrits.</p>

    <table>
        <tr>
            <td>
                <h3>Pseudo :</h3>
            </td>
            <td><?= $arr['username'] ?></td>
        </tr>
        <tr>
            <td>
                <h3>Email :</h3>
            </td>
            <td><?= $arr['email'] ?></td>
        </tr>

    </table>
</div>
<a href="updateUser.php" class="btn btn-update-user">Modifier mon profil</a>
</body>

</html>