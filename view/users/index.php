<?php
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_users'])) {
    header('Location: connection.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>

<body>
    <div class="dashboard-container">
        <h2>Bienvenue sur votre tableau de bord id =<?= $_SESSION['userId'] ?></h2>
        <p>Vous pouvez maintenant accéder à toutes les fonctionnalités réservées à nos utilisateurs inscrits.</p>
        <a href="../traitementForm/logout.php">Se déconnecter</a>
    </div>
</body>

</html>