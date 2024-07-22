<?php
session_start();

require_once '../../model/db_connect.php';

$errors = [
    'exist' => '',
    'username' => '',
    'passwd' => '',
    'email' => ''
];

//error message
$message = '';

//set variable if exist while subit the form
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$passwd = $_POST['passwd'] ?? '';

//data treatment if  method='POST'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitForm'])) {
    $_POST = filter_input_array(INPUT_POST, [
        'username' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'email' => FILTER_SANITIZE_EMAIL,
        'passwd' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ]);
    //Variable initialization that will receive the input datas in the form


    //erros message if empty fields
    if (empty($username)) {
        $errors['username'] = '<p>Le nom d\'utilisateur est obligatoire</p>';
    }
    if (empty($email)) {
        $errors['email'] = '<p>L\'email est obligatoire</p>';
    }
    if (empty($passwd)) {
        $errors['passwd'] = '<p>Le mot est obligatoire</p>';
    }

    //execute INSERT INTO request
    if (($username) && ($email) && (mb_strlen($passwd) >= 10)) {

        //check if the users doesn't exists in database (avec SELECT)
        $rqt = 'SELECT username, email FROM users WHERE username = :username OR email = :email';
        $stmt = $pdo->prepare($rqt);
        $stmt->execute(
            array(
                ':username' => $username,
                ':email' => $email,
            )
        );
        $nb_row = $stmt->rowCount();
        if ($nb_row >= 1) {
            $message = '<span>Le nom d\'utilisateur ou l\'email existe déjà</span>';
        } else {
            $rqt = 'INSERT INTO users VALUES(DEFAULT, :username, :email, :passwd)';
            $stmt = $pdo->prepare($rqt);
            $stmt->execute(
                array(
                    ':username' => $username,
                    ':email' => $email,
                    ':passwd' => password_hash($passwd, PASSWORD_DEFAULT)
                )
            );

            //$message = '<span>Votre compte a bien été crée</span>';
            //create session variable to display the message on the redirect page
            $_SESSION['success'] = '<div class="alert">Votre compte a bien été crée. Veuillez vous connecter</div>';
        }
        header('Location: connection.php');
        exit();
    } else {
        $errors['passwd'] = "<span>Votre mot de passe doit contenir au moins 10 caractères</span>";
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
                <li><a href="connection.php" class="link-account">Connexion</a></li>
            </ul>
        </nav>
    </header>
    <main>

        <section class="section-form">
            <div class="glass">
                <h1 class="content-h1">Créer mon compte</h1>
                <?= $message ?>
                <form action="#" method="POST" class="createCompteForm">
                    <div class="div-input">
                        <label for="username" class="label-container"><img src="../../media/user-icon.svg" alt="icon d'un personnage"></label>
                        <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" class="input-container" value="<?php echo $username; ?>">
                    </div>
                    <?= $errors['username'] ?>
                    <?= $errors['exist'] ?>

                    <br><br>

                    <div class="div-input">
                        <label for="email" class="label-container"><img src="../../media/user-icon.svg" alt="icon d'un personnage"></label>
                        <input type="email" id="email" name="email" placeholder="nom@prenom.com" class="input-container" value="<?php echo $email ?>">
                    </div>
                    <?= $errors['email'] ?>
                    <br><br>

                    <div class="div-input">
                        <label for="passwd" class="label-container"><img src="../../media/lock-icon.svg" alt="icone d'un cadenas"></label>
                        <input type="password" id="passwd" name="passwd" placeholder="mot de passe" class="input-container">
                    </div>
                    <?= $errors['passwd'] ?>
                    <br><br>

                    <div class=" div-submit">
                        <button type="submit" name="submitForm" class="btn btn-submit">Valider</button>
                    </div>
                </form>
                <p>Déjà un compte ? <a href="connection.php">Connexion</a></p>
            </div>
        </section>
    </main>

    <script src="../../javascript/alert.js"></script>

</body>

</html>