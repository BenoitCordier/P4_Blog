<?php
    if (session_status() == PHP_SESSION_ACTIVE && $_SESSION['function'] !== 'admin') {
        header('Location: index.php?action=listPosts');
    }
?>
<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Projet 4</title>
    <link href="public/css/style_alt.css" rel="stylesheet" />

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
        <div id="homeButton">
            <a href="index.php?action=listPosts">
                <p class="homeButton">Retour à l'accueil</p>
            </a>
        </div>

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
        <div id="checkPost">
            <?php
                while ($postsAdminArray = $checkPost->fetch()) {
                    ?>

            <div class="checkPost" style="display: none;">
                <h3 class="articleTitle"><a
                        href="index.php?action=post&id=<?= $postsAdminArray['id'] ?>">
                        <?= htmlspecialchars($postsAdminArray['postTitle']) ?>

                    </a></h3>
                <h4>
                    le <?= $postsAdminArray['postDateFr'] ?>
                </h4>
                <p class="chapterContent">
                    <?= nl2br(htmlspecialchars($postsAdminArray['postContent'])) ?>
                    <br />
                </p>
                <div class="chapterBtn">
                    <a
                        href="index.php?action=modifyPost&id=<?= $postsAdminArray['id']?>">
                        <p class="modifyPost signal">Modifier
                            l'article</p>
                    </a>
                    <a
                        href="index.php?action=deletePost&id=<?= $postsAdminArray['id']?>">
                        <p id="deletePost" class="signal">Supprimer
                            l'article</p>
                    </a>
                </div>
            </div>

            <div class="updatePost" style="display: none;">
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
                            cols="80"><?= nl2br(htmlspecialchars($postsAdminArray['postContent'])) ?></textarea>
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
                <p><?= nl2br(htmlspecialchars($commentsAdminArray['commentContent'])) ?>
                </p>
                <div class="commentBtn">
                    <a
                        href="index.php?action=deleteComment&id=<?= $commentsAdminArray['id']?>">
                        <p class="signal">Supprimer
                            le commentaire</p>
                    </a>
                    <a
                        href="index.php?action=clearComment&id=<?= $commentsAdminArray['id']?>">
                        <p class="signal">Rétablir
                            le commentaire</p>
                    </a>
                </div>
            </div>
            <?php
                }
                $checkComment->closeCursor();
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
                    <a
                        href="index.php?action=deleteUser&id=<?= $usersAdminArray['id']?>">
                        <p class="signal">Supprimer
                            l'utilisateur</p>
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