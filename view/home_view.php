<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Test</title>
</head>

<body>
    <h1>Page de connexion</h1>

    <div>
        <h2>Se connecter</h2>
        <form method="POST" action="index.php?action=logIn">
            <label for="user_login">Login :</label>
            <input id="user_login" type="text" name="user_name" />
            <label for="user_password">Password :</label>
            <input id="user_password" type="text" name="password" />
            <input type="submit" value="Connexion" />
        </form>
    </div>

    

    <div>
        <h2>S'enregistrer</h2>
        <form method="POST" action="index.php?action=signIn">
            <label for="user_name">Login :</label>
            <input id="user_name" type="text" name="user_name" />
            <label for="first_name">Prénom :</label>
            <input id="first_name" type="text" name="first_name" />
            <label for="last_name">Nom :</label>
            <input id="last_name" type="text" name="last_name" />
            <label for="e_mail">E-mail :</label>
            <input id="e_mail" type="text" name="e_mail" />
            <label for="password">Mot de passe :</label>
            <input id="password" type="text" name="password" />
            <label for="confirmation_password">Confirmez votre mot de passe :</label>
            <input id="confirmation_password" type="text" name="confirmation_password" />
            <input type="submit" value="S'enregistrer">
        </form>
    </div>
</body>

</html>