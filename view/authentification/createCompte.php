<?php
session_start();
require_once '../../model/db_connect.php';

//Creation d'un tableau qui recevra les erreurs possibles lors de la saisie
$errors = [
    'login' => '',
    'passwd' => ''
];

$message = '';

//data treatment if  method='POST'
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'login' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'passwd' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ]);
    //Variable initialization that will receive the input datas in the form
    $login = $_POST['login'] ?? '';
    $passwd = $_POST['passwd'] ?? '';

    //filling the error array 
    if (!$login && !$passwd) {
        $errors['login'] = 'Veuillez tous les chams*';
    }
    if (!$passwd) {
        $errors['passwd'] = 'Ce champs est obligatoire *';
    }


    //execute INSERT INTO request
    if (($login) && ($passwd)) {

        //check if the users doesn't exists in database (avec SELECT)
        $sql = 'SELECT login FROM users WHERE login = :login';
        var_dump($login);
        //prepare la requete sql
        if (isset($pdo)) {
            $stmt = $pdo->prepare($sql);
        };
        //execute la requete sql
        $stmt->execute(
            array(':login' => $login)
        );
        if ($stmt) {


            //the request execution will return a value. if this one is <= 0 then we treate the request (INSERT INTO)
            $rqt = 'INSERT INTO users VALUES (DEFAULT, :login, :passwd)';
            $stmt = $pdo->prepare($rqt);

            $stmt->execute(
                array(
                    ':login' => $login,
                    ':passwd' => password_hash($passwd, PASSWORD_DEFAULT)
                )
            );
            $message = 'Votre Compte a bien été crée, Veuillez vous connecter afin de commencer !';
        } else {
            // $message = "<span class='message'>Le login existe déjà</span>";
        }
    } else {

        // $message = "<span class='message'>Veuillez remplir tous les champs avec un mot de passe valide</span>";
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
        <div class="alert">
            <p><?= $message ?></p>
        </div>

        <section class="section-form">
            <div class="glass">
                <h1 class="content-h1">Créer mon compte</h1>

                <form action="#" method="POST" class="form">
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
                        <input type="submit" value="Valider" class="btn btn-submit">
                    </div>
                </form>
                <p>Déjà un compte ? <a href="connection.php">Connexion</a></p>
            </div>
        </section>
    </main>
    <script src="../../javascript/alert.js"></script>
</body>

</html>