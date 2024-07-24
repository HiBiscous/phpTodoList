<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/main.css">
    <title>ToDo List <?= $title ?></title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li class="li-logo li-header">
                    <a href="../tasks/note.php" class="logo"><img src="../../media/logo.png" alt="logo correspondant à une calligraphie du prénom hiba en arabe"></a>
                </li>
                <li class="li-title li-header">
                    <h1>Ma ToDo List</h1>
                </li>

                <li class="li-header">
                    <button class="btn btn-add ">Ajouter</button>
                </li>
                <li class="li-header"><a href=" ../users/profil.php" id="profil" class="link-account ">Mon compte</a>
                </li>
                <li class="li-header"><a href="../traitementForm/logout.php" id="logout" name="logout" class="link-logout ">Deconnexion</a></li>
            </ul>
        </nav>
    </header>