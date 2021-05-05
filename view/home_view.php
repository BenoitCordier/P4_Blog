<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p>Derniers billets du blog :</p>


<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['article_name']) ?>
            <em>le <?= $data['post_date'] ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($data['article_content'])) ?>
            <br />
            <em><a href="post.php?id=<?= $data['id'] ?>">Commentaires</a></em>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template_user.php'); ?>