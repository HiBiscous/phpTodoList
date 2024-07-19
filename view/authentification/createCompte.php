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
                <h1 class="content-h1">Créer mon compte</h1>

                <form action="/phpTodolist/view/traitementForm/traitementCreateCompte.php" method="POST" class="createCompteForm">
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
    <script src="../../javascript/fetch_api/createCompte.js"></script>

</body>

</html>