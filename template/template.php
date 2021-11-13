<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Billet Simple pour l'Alaska">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta property="og:url" content="http://jeanforteroche.bcordier.fr/index.html" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Billet Simple pour l'Alaska" />
    <meta property="og:description" content="Billet Simple pour l'Alaska - Le nouveau livre de Jean Forteroche" />

    <title><?= $title ?>
    </title>
    <link href="public/css/style_alt.css" rel="stylesheet" />
    <script src="https://cdn.tiny.cloud/1/g5suvpkd4ia0orxi5hyg7ykb4lhbo8ekfij53v9ejdf331m5/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea#tiny',
            menubar: '',
            toolbar: 'undo redo | fontselect fontsizeselect forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | blockquote | removeformat',

        });
    </script>
</head>

<body>
    <header>
        <h1>Titre du blog</h1>
        <div id="control">
            <ul>
                <?php
                if (session_status() !== PHP_SESSION_ACTIVE || !isset($_SESSION['userName'])) {
                    ?>
                <li style="display:inline" id="connexion">
                    <button class="logBtn">Se connecter</button>
                </li>
                <li style="display:inline" id="registration">
                    <button class="logBtn">S'enregistrer</button>
                </li>
                <?php
                }
            if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['userName'])) {
                ?>
                <li style="display:inline"><a href="index.php?action=logOut">
                        <button class="logBtn">Déconnexion</button>
                    </a></li>
                <?php
            if ($_SESSION['function'] == 'admin' && (basename($_SERVER['PHP_SELF']) != 'admin.php')) {
                ?>
                <li style="display:inline"><a href="index.php?action=admin">
                        <button class="logBtn">Administration</button>
                    </a></li>
                <?php
            }
            }
            if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['userName']) && (basename($_SERVER['PHP_SELF']) === 'index.php')) {
                ?>
            </ul>
        </div>
        <?php
            }
            if (session_status() !== PHP_SESSION_ACTIVE || !isset($_SESSION['userName'])) {
                ?>
        <div id="logIn" style="display: none;">
            <h2>Se connecter</h2>
            <form method="POST" action="index.php?action=logIn">
                <div class="flexLogIn">
                    <label for="userLogin">Login</label>
                    <input id="userLogin" class="logField" type="text" name="userName" />
                </div>
                <div class="flexLogIn">
                    <label for="userPassword">Password</label>
                    <input id="userPassword" class="logField" type="text" name="password" />
                </div>
                <input type="submit" class="logBtn" value="Connexion" />
            </form>
        </div>
        <div id="signIn" style="display: none;">
            <h2>S'enregistrer</h2>
            <form method="POST" action="index.php?action=signIn">
                <div class="flexLogIn">
                    <label for="userName">Login</label>
                    <input id="userName" type="text" name="userName" />
                </div>
                <div class="flexLogIn">
                    <label for="firstName">Prénom</label>
                    <input id="firstName" type="text" name="firstName" />
                </div>
                <div class="flexLogIn">
                    <label for="lastName">Nom</label>
                    <input id="lastName" type="text" name="lastName" />
                </div>
                <div class="flexLogIn">
                    <label for="eMail">E-mail</label>
                    <input id="eMail" type="text" name="eMail" />
                </div>
                <div class="flexLogIn">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="text" name="password" />
                </div>
                <div class="flexLogIn">
                    <label for="confirmationPassword">Confirmez votre mot de passe</label>
                    <input id="confirmationPassword" type="text" name="confirmationPassword" />
                </div>
                <input type="submit" class="logBtn" value="S'enregistrer">
            </form>
        </div>
        <?php
            }
        ?>
    </header>

    <?= $content?>
    <?php
            if (session_status() !== PHP_SESSION_ACTIVE || !isset($_SESSION['userName'])) {
                ?>
    <script src="public/js/ConnexionControl.js"></script>
    <script src="public/js/mainConnexion.js"></script>
    <?php
            }
        ?>

    <footer>
        <div>
            Ceci est un footer vide.
        </div>
    </footer>
</body>

</html>