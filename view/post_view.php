<?php $title = htmlspecialchars($post['postTitle']) ?>
<?php ob_start(); ?>
<div class="flexCenterBig1">
    <div id="flexPostView">
        <div id="homeButton">
            <a href="index.php?action=listPosts">
                <p class="homeButton">Retour à l'accueil</p>
            </a>
        </div>

        <div class="chapter chapterSolo">
            <h3>
                <?= htmlspecialchars($post['postTitle']) ?>
            </h3>
            <h4>
                le <?= $post['postDateFr'] ?>
            </h4>
            <div class="chapterContent">
                <?= nl2br(htmlspecialchars_decode($post['postContent'])) ?>
            </div>
        </div>

        <div class="commentSolo">
            <h3>Commentaires</h3>
            <?php
                while ($commentsArray = $comments->fetch()) {
                    ?>
            <div class="commentUnique">
                <h4><?= htmlspecialchars($commentsArray['userName']) ?>
                    le <?= $commentsArray['commentDateFr'] ?>
                </h4>
                <div class="commentUniqueContent"><?= nl2br(htmlspecialchars_decode($commentsArray['commentContent'])) ?>
                </div>
                <?php
                    if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['userName'])) {
                        ?>
                <a
                    href="index.php?action=alertComment&id=<?= $commentsArray['id']?>&postId=<?= $commentsArray['postId']?>">
                    <p class="signal">Signaler
                        le commentaire</p>
                </a>
                <?php
                    }; ?>
            </div>
            <?php
                }
                $comments->closeCursor();
            ?>
            <?php
    if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['userName'])) {
        ?>
            <form
                action="index.php?action=addComment&id=<?= $post['id'] ?>"
                method="post">
                <h4>
                    Ecrire un nouveau commentaire
                </h4>
                <div id="commentContent">
                    <textarea id="tiny" class="commentContent" name="commentContent" rows="4" cols="25"></textarea>
                </div>
                <input class="signal" type="submit" />
            </form>
        </div>
    </div>
</div>

<?php
    };
    ?>
<?php $content = ob_get_clean(); ?>
<?php require 'template/template.php';
