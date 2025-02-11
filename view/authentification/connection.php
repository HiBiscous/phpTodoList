<?php
session_start();
require_once '../../model/db_connect.php';
$success = '';
if (isset($_SESSION['success'])) {
    $success =  $_SESSION['success'];

    //delete this session after refreshing the page
    unset($_SESSION['success']);
}


$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'username' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'passwd' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ]);
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    if (isset($_POST['username']) && isset($_POST['passwd']) && (mb_strlen($passwd) >= 10)) {

        $rqt = "SELECT id_users, username, passwd FROM users WHERE username = :username";
        $stmt = $pdo->prepare($rqt);
        $stmt->execute([':username' => $username]);
        $arr = $stmt->fetch();

        if (password_verify($passwd, $arr['passwd'])) {
            $_SESSION['id_users'] = $arr['id_users'];
            header('Location: /phptodolist/view/tasks/note.php');
            exit();
        } else {
            $message = '<div class="alert">Le mot de passe est erroné</div>';
        }
    } else {
        $message = "<span class='alert'>Veuillez remplir tous les champs avec un mot de passe valide</span>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../style/main.css">
    <title>Todo list | Connection</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li class="li-logo">
                    <a href="../tasks/note.php" class="logo"><img src="../../media/logo.png" alt="logo correspondant à une calligraphie du prénom hiba en arabe"></a>
                </li>
                <li class="li-title">
                    <h1>Ma ToDo List</h1>
                </li>

                <li><a href="/phptodolist/index.php" class="link-account">Retour</a></li>
                <li><a href="createCompte.php" class="link-account">Créer mon compte</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?= $success ?>
        <section class="section-form">
            <div class="glass">
                <?= $message ?>
                <h1 class="content-h1">Connexion</h1>
                <br>
                <form action="#" method="POST" class="connectForm form">

                    <!--<form action="/phpTodolist/view/traitementForm/traitementConnection.php" method="POST" class="connectForm form">-->
                    <div class="div-input">
                        <label for="username" class="label-container"><img src="../../media/user-icon.svg" alt="icon d'un personnage"></label>
                        <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" class="input-container">
                    </div>
                    <br><br>

                    <div class="div-input">
                        <label for="passwd" class="label-container"><img src="../../media/lock-icon.svg" alt="icone d'un cadenas"></label>
                        <input type="password" id="passwd" name="passwd" placeholder="Mot de passe" class="input-container">

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
</body>

</html>