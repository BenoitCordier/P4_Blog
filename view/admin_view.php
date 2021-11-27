<?php
    if (session_status() == PHP_SESSION_ACTIVE && $_SESSION['function'] !== 'admin') {
        header('Location: index.php?action=listPosts');
    }
?>
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
    <title>Tableau de bord</title>
    <link href="public/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" media="(max-width: 768px)" href="public/css/mobres.css">
    <link rel="stylesheet" type="text/css" media="(min-width: 769px) and (max-width: 1024px)"
        href="public/css/lowres.css">
    <link rel="stylesheet" type="text/css" media="(min-width: 1025px) and (max-width: 1200px)"
        href="public/css/medres.css">

    <script src="https://cdn.tiny.cloud/1/g5suvpkd4ia0orxi5hyg7ykb4lhbo8ekfij53v9ejdf331m5/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '.tiny',
            menubar: '',
            toolbar: 'undo redo | fontselect fontsizeselect forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | blockquote | removeformat',
        });
    </script>
</head>

<body>
    <div id="admin">
        <a href="index.php?action=listPosts" class="homeButton">Retour à l'accueil
        </a>

        <div id="adminButtons">
            <ul>
                <li style="display:inline" id="checkPostJs" class="adminBtn">Gérer les
                    articles
                </li>
                <li style="display:inline" id="newPostJs" class="adminBtn">Poster un nouvel
                    article
                </li>
                <li style="display:inline" id="checkCommentJs" class="adminBtn">Modérer les
                    commentaires
                </li>
                <li style="display:inline" id="checkUserJs" class="adminBtn">Gérer les
                    utilisateurs
                </li>
            </ul>
        </div>
        <div id="checkPost" style="display: none;">
            <?php
                while ($postsAdminArray = $checkPost->fetch()) {
                    ?>

            <div class="checkPost">
                <h3 class="articleTitle"><a
                        href="index.php?action=post&id=<?= $postsAdminArray['id'] ?>">
                        <?= htmlspecialchars($postsAdminArray['postTitle']) ?>

                    </a></h3>
                <h4>
                    le <?= $postsAdminArray['postDateFr'] ?>
                </h4>
                <div class="chapterContent">
                    <?= nl2br(htmlspecialchars_decode($postsAdminArray['postContent'])) ?>
                </div>
                <div class="chapterBtn">
                    <button
                        onclick="showModificationForm(<?= $postsAdminArray['id'] ?>)"
                        class="modifyPostSignal">Modifier
                        l'article</button>
                    <a href="index.php?action=deletePost&id=<?= $postsAdminArray['id']?>"
                        id="deletePost" class="signal">Supprimer
                        l'article
                    </a>
                </div>
            </div>

            <div class="updatePost"
                id="updateForm<?= $postsAdminArray['id']?>"
                style="display: none;">
                <form
                    action="index.php?action=updatePost&id=<?= $postsAdminArray['id']?>"
                    method="post">
                    <h3 class="updateTitle">
                        <strong>Modifier un article</strong>
                    </h3>
                    <h4>Titre</h4>
                    <textarea id="newTitle" name="newTitle" rows="2"
                        cols="50"><?= htmlspecialchars($postsAdminArray['postTitle']) ?></textarea>
                    <h4>Article</h4>
                    <div class="newContent">
                        <textarea id="newContent" class="tiny" name="newContent" rows="8"
                            cols="80"><?= nl2br(htmlspecialchars_decode($postsAdminArray['postContent'])) ?></textarea>
                    </div>
                    <input type="submit" value="Modifier" />
                </form>
            </div>
            <?php
                }
                $checkPost->closeCursor();
                ?>
        </div>

        <div id="newPost" style="display: none;">
            <form action="index.php?action=newPost" method="post">
                <h3>
                    Ecrire un nouvel article
                </h3>
                <h4>Titre</h4>
                <textarea id="postTitle" name="postTitle" rows="2" cols="50"></textarea>
                <h4>Article</h4>
                <div class="newContent">
                    <textarea id="postContent" class="tiny" name="postContent" rows="8" cols="80"></textarea>
                </div>
                <input type="submit" />
            </form>
        </div>

        <div id="checkComment" style="display: none;">
            <h3>
                Commentaires signalés
            </h3>
            <?php
                while ($commentsAdminArray = $checkComment->fetch()) {
                    ?>
            <div class="checkComment">
                <h4 class="commentTitle">Commentaire n°<?= htmlspecialchars($commentsAdminArray['id'])?>
                </h4>
                <h4>Article : <?= htmlspecialchars($commentsAdminArray['postId'])?>
                </h4>
                <h4><?= htmlspecialchars($commentsAdminArray['userName']) ?>
                    le <?= $commentsAdminArray['commentDateFr'] ?>
                </h4>
                <div><?= nl2br(htmlspecialchars_decode($commentsAdminArray['commentContent'])) ?>
                </div>
                <div class="commentBtn">
                    <a href="index.php?action=deleteComment&id=<?= $commentsAdminArray['id']?>"
                        class="signal">Supprimer
                        le commentaire
                    </a>
                    <a href="index.php?action=clearComment&id=<?= $commentsAdminArray['id']?>"
                        class="signal">Rétablir
                        le commentaire
                    </a>
                </div>
            </div>
            <?php
                }
                $checkComment->closeCursor();
                ?>
            <h3>
                Tous les commentaires
            </h3>
            <?php
                while ($allCommentsAdminArray = $checkAllComment->fetch()) {
                    ?>
            <div class="checkComment">
                <h4 class="commentTitle">Commentaire n°<?= htmlspecialchars($allCommentsAdminArray['id'])?>
                </h4>
                <h4>Article : <?= htmlspecialchars($allCommentsAdminArray['postId'])?>
                </h4>
                <h4><?= htmlspecialchars($allCommentsAdminArray['userName']) ?>
                    le <?= $allCommentsAdminArray['commentDateFr'] ?>
                </h4>
                <div><?= nl2br(htmlspecialchars_decode($allCommentsAdminArray['commentContent'])) ?>
                </div>
                <div class="commentBtn">
                    <a href="index.php?action=deleteComment&id=<?= $allCommentsAdminArray['id']?>"
                        class="signal">Supprimer
                        le commentaire
                    </a>
                </div>
            </div>
            <?php
                }
                $checkAllComment->closeCursor();
                ?>
        </div>

        <div id="checkUser" style="display: none;">
            <?php
                while ($usersAdminArray = $checkUsers->fetch()) {
                    ?>
            <div class="checkUser">
                <p class="userName"><strong>Utilisateur n°<?= nl2br(htmlspecialchars($usersAdminArray['id'])) ?></strong>
                </p>
                <p><strong>Pseudo : </strong><?= nl2br(htmlspecialchars($usersAdminArray['userName'])) ?></br>
                    <strong>Statut : </strong><?= nl2br(htmlspecialchars($usersAdminArray['function'])) ?>
                </p>
                <div class="userBtn">
                    <a href="index.php?action=deleteUser&id=<?= $usersAdminArray['id']?>"
                        class="signal">Supprimer
                        l'utilisateur
                    </a>
                </div>
            </div>

            <?php
                }
                $checkUsers->closeCursor();
                ?>

        </div>
    </div>
    <script src="public/js/AdminControl.js"></script>
    <script src="public/js/mainAdmin.js"></script>
</body>

</html>