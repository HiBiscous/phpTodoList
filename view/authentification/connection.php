<?php
session_start();
require_once '../../model/db_connect.php';

if (isset($_POST['login']) && isset($_POST['passwd'])) {
    $login = $_POST['login'];
    $passwd = $_POST['passwd'];

    $rqt = "SELECT * FROM users WHERE login = :login";
    $stmt = $pdo->prepare($rqt);
    $stmt->execute([':login' => $login]);
    $arr = $stmt->fetch();

    if ($arr) {
        $_SESSION['id_users'] = $arr['id_users'];
        $_SESSION['login'] = $arr['login'];
        header('Location: /phptodolist/view/tasks/note.php');
        exit();
    } else {
        echo 'un probleme est survenue';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../style/main.css">
    <title>Todo list</title>
</head>

<body>
    <main>
        <section class="section-form">
            <div class="glass">
                <h1 class="content-h1">Connexion</h1>
                <br>
                <form action="#" method="POST" class="connectForm form">

                    <!--<form action="/phpTodolist/view/traitementForm/traitementConnection.php" method="POST" class="connectForm form">-->
                    <div class="div-input">
                        <label for="login" class="label-container"><img src="../../media/user-icon.svg" alt="icon d'un personnage"></label>
                        <input type="text" id="login" name="login" placeholder="nom d'utilisateur" class="input-container">
                    </div>
                    <br><br>

                    <div class="div-input">
                        <label for="passwd" class="label-container"><img src="../../media/lock-icon.svg" alt="icone d'un cadenas"></label>
                        <input type="password" id="passwd" name="passwd" placeholder="mot de passe" class="input-container">

                    </div>
                    <br><br>

                    <div class="div-submit">
                        <button type="submit" value="Valider" class="btn btn-submit">VALIDER</button>
                    </div>
                </form>
                <p>Pas encore de compte ? <a href="createCompte.php">Créer un compte</a></p>

            </div>
        </section>
    </main>

    <script src="../../javascript/alert.js"></script>
    <!--<script src="../../javascript/fetch_api/connect.js"></script> -->


</body>

</html>