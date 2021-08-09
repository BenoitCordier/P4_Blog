<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Projet 4</title>
    </head>

    <body>
        <p><a href='/P4_Blog/index.php'>Retour à la liste des billets</a></p>

        <div class="news">
            <h3>
                <?= htmlspecialchars($post['post_title']) ?>
                <em>le <?= $post['post_date_fr'] ?></em>
            </h3>
            
            <p>
                <?= nl2br(htmlspecialchars($post['post_content'])) ?>
            </p>
        </div>

        <h2>Commentaires</h2>

        <?php
        while ($comments_array = $comments->fetch())
        {
        ?>
        <p><strong><?= htmlspecialchars($comments_array['user_id']) ?></strong> le <?= $comments_array['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comments_array['comment_content'])) ?></p>
        <?php
        }
        $comments->closeCursor();
        ?>
    </body>
</html>