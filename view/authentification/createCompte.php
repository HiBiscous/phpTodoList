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
                        <label for="username" class="label-container"><img src="../../media/user-icon.svg" alt="icon d'un personnage"></label>
                        <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" class="input-container">
                    </div>
                    <br><br>

                    <div class="div-input">
                        <label for="email" class="label-container"><img src="../../media/user-icon.svg" alt="icon d'un personnage"></label>
                        <input type="email" id="email" name="email" placeholder="nom@prenom.com" class="input-container">
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